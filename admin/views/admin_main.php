<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php require_once PROJECTEN_PLUGIN_MODEL_DIR . "/project.php";
?>
<?php
$project = new Project;
// Get form vars
$post_inputs = $project->getPostValues();
?>
<div class="row">
    <div class="col-lg-6">
        <h1> Nieuwe projecten</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>E-mail</th>
                    <th>Telefoon-nr</th>
                    <th>Project omschrijving</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                $result_new = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk", ARRAY_A);
                foreach ($result_new as $row) {
                    $pp_id = $row['id'];

                    echo "<tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['voornaam'] . "</td>";
                    echo "<td>" . $row['achternaam'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefoon_nr'] . "</td>";
                    echo "<td>" . $row['project_omschrijving'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";

                    if ($row['status'] ==  'Geen status') {
                        echo "<td>" . "<a href='admin.php?page=projecten+plugin&approve&id={$pp_id}&new'> Approve </a>" . "</td>";
                        echo "<td>" . "<a href='admin.php?page=projecten+plugin&decline&id={$pp_id}&new'> Decline </a>" . "</td>";
                    }
                }

                // var_dump($result_new);
                echo "</br>" . "Query executed is" . $wpdb->last_query;
                echo "</br>" . "Last error" . $wpdb->last_error;
                var_dump($result_new);
                ?>
            </tbody>
        </table>
        <h1>Goedgekeurde projecten</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>E-mail</th>
                    <th>Telefoon-nr</th>
                    <th>Project omschrijving</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                $result_approved = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk WHERE pp_projects.status_id = 1", ARRAY_A);
                foreach ($result_approved as $row) {
                    $pp_id = $row['id'];
                    echo "<tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['voornaam'] . "</td>";
                    echo "<td>" . $row['achternaam'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefoon_nr'] . "</td>";
                    echo "<td>" . $row['project_omschrijving'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&delete&id={$pp_id}'> Delete </a>" . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&update&id={$pp_id}'> Update </a>" . "</td>";
                }
                ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-2">
        <?php
        $project->delete();
        $project->updateStatus();
        if (isset($_GET['update'])) {
        ?>
            <h1>Update project</h1>
            <form method="post" class="form-group">
                <input class="form-control" type="text" name="voornaam" value="<?php echo $project->getFirstName($pp_id); ?>" placeholder="voornaam">
                <input class="form-control" type="text" name="achternaam" placeholder="achternaam">
                <input class="form-control" type="text" name="email" placeholder="email">
                <input class="form-control" type="text" name="telefoon_nr" placeholder="telefoon nr">
                <textarea name="project_omschrijving" cols="30" rows="10"></textarea>
                <input type="submit" name="verzenden">
            </form>
        <?php
            echo $project->getFirstName($pp_id);
            $project->update($post_inputs['voornaam'], $post_inputs['achternaam'], $post_inputs['email'], (string) $post_inputs['telefoon_nr'], $post_inputs['project_omschrijving']);
        }
        ?>
        </tbody>

    </div>
</div>