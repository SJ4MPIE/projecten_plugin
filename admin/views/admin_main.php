<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php require_once PROJECTEN_PLUGIN_MODEL_DIR . "/project.php";
?>
<?php
$project = new Project;

?>
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
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $result_new = $wpdb->get_results("SELECT * FROM pp_new_projects", ARRAY_A);
            foreach ($result_new as $row) {
                $pp_new_id = $row['id'];
                echo "<tr><td>" . $row['id'] . "</td>";
                echo "<td>" . $row['voornaam'] . "</td>";
                echo "<td>" . $row['achternaam'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefoon_nr'] . "</td>";
                echo "<td>" . $row['project_omschrijving'] . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin&delete&id={$pp_new_id}&new'> Delete </a>" . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin&update&id={$pp_new_id}&new'> Update </a>" . "</td>";
            }
            // $project->
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
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $result_approved = $wpdb->get_results("SELECT * FROM pp_approved_projects", ARRAY_A);
            foreach ($result_approved as $row) {
                $pp_approved_id = $row['id'];
                echo "<tr><td>" . $row['id'] . "</td>";
                echo "<td>" . $row['voornaam'] . "</td>";
                echo "<td>" . $row['achternaam'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefoon_nr'] . "</td>";
                echo "<td>" . $row['project_omschrijving'] . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin&delete&id={$pp_approved_id}&approved'> Delete </a>" . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin&update&id={$pp_approved_id}&approved'> Update </a>" . "</td>";
            }

            $project->delete();
            ?>
        </tbody>
    </table>
</div>