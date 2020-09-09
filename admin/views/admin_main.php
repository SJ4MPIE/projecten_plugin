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
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $result_new = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk" , ARRAY_A);
            foreach ($result_new as $row) {
                $pp_id = $row['id'];
        
                echo "<tr><td>" . $row['id'] . "</td>";
                echo "<td>" . $row['voornaam'] . "</td>";
                echo "<td>" . $row['achternaam'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefoon_nr'] . "</td>";
                echo "<td>" . $row['project_omschrijving'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
            
                if($row['status'] ==  'Geen status'){
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&approve&id={$pp_id}&new'> Approve </a>" . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&decline&id={$pp_id}&new'> Decline </a>" . "</td>";
                }
            }

            // var_dump($result_new);
            // echo "</br>". "Query executed is".$wpdb->last_query;
            // echo "</br>". "Last error".$wpdb->last_error;
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

            $project->delete();
            $project->updateStatus();
            ?>
        </tbody>
    </table>
</div>