<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php require_once PROJECTEN_PLUGIN_MODEL_DIR . "/project.php";
?>
<?php
$project = new Project;
// Get form vars
$post_inputs = $project->getPostValues();
$get_inputs = $project->getGetValues();
//get current id 
$current_id = $get_inputs['id'];
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
                //Loops through $result_new and outputs the rows from DB
                global $wpdb;
                $result_new = $project->getProjectRows();
                foreach ($result_new as $row) {
                    $pp_id = $row['id'];

                    echo "<tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['voornaam'] . "</td>";
                    echo "<td>" . $row['achternaam'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefoon_nr'] . "</td>";
                    echo "<td>" . $row['project_omschrijving'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";

                    if ($row['status'] ==  'In afwachting') {
                        echo "<td>" . "<a href='admin.php?page=projecten+plugin&approve&id={$pp_id}&new'> Approve </a>" . "</td>";
                        echo "<td>" . "<a href='admin.php?page=projecten+plugin&decline&id={$pp_id}&new'> Decline </a>" . "</td>";
                    }
                }
                // var_dump($get_inputs);
                // if (!empty($get_inputs['decline'])) {
                //     $msg = "Je aanvraag voor project is afgewezen";
                //     mail("someone@example.com", "Projecten Plugin", $msg);
                // }
                // Print last SQL query string
                echo $wpdb->last_query;

                // Print last SQL query result
                echo $wpdb->last_result;

                // Print last SQL query Error
                echo $wpdb->last_error;
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
                //Loops through $result_approved and outputs the rows from DB
                global $wpdb;
                $result_approved = $project->getApprovedRows();
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
                $project->updateStatus();
                ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-2">
        <?php
        $project->delete();
        $project->updateStatus();
        //Whenever the admin clicks on update the update-form will be shown. 
        if (isset($get_inputs['update'])) {
        ?>
            <h1>Update project</h1>
            <form method="post" class="form-group">
                <input class="form-control" type="text" name="voornaam" value="<?php echo $project->getFirstName($current_id); ?>" placeholder="voornaam">
                <input class="form-control" type="text" name="achternaam" value="<?php echo $project->getLastName($current_id); ?>" placeholder="achternaam">
                <input class="form-control" type="text" name="email" value="<?php echo $project->getEmail($current_id); ?>" placeholder="email">
                <input class="form-control" type="text" name="telefoon_nr" value="<?php echo $project->getTelNr($current_id); ?>" placeholder="telefoon nr">
                <textarea name="project_omschrijving" cols="30" rows="10"></textarea>
                <input type="submit" name="Update">
            </form>
        <?php
        }
        //Whenever the admin clicks on update the values will be sent to updateProject();
        if (isset($_POST["Update"])) {
            $project->updateProject($post_inputs['voornaam'], $post_inputs['achternaam'], $post_inputs['email'], $post_inputs['telefoon_nr'], $post_inputs['project_omschrijving'], $current_id);

            echo "</br>" . "Query executed is" . $wpdb->last_query;
            echo "</br>" . "Last error" . $wpdb->last_error;
        }

        //whenever the admin clicks on decline the user receives a mail.
        if (isset($get_inputs['id'])) {
            $msg = "Je aanvraag voor project is afgewezen";
            mail($project->getEmail($current_id), "Projecten Plugin", $msg);
        }

        ?>

        </tbody>

    </div>
</div>