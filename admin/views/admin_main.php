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
                $result_new = $wpdb->get_results("SELECT * FROM pp_new_projects", ARRAY_A);
        
        
                foreach ($result_new as $row) {
                    echo "<tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['voornaam'] . "</td>";
                    echo "<td>" . $row['achternaam'] . "</td>";
                    echo "<td>" . $row['e-mail'] . "</td>";
                    echo "<td>" . $row['telefoon_nr'] . "</td>";
                    echo "<td>" . $row['project_omschrijving'] . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=decline'> Decline </a>" . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=approve'> Approve </a>" . "</td>";
                }
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
            $result_approved = $wpdb->get_results("SELECT * FROM pp_approved_projects", ARRAY_A);
            foreach ($result_approved as $row) {
                echo "<tr><td>" . $row['id'] . "</td>";
                echo "<td>" . $row['voornaam'] . "</td>";
                echo "<td>" . $row['achternaam'] . "</td>";
                echo "<td>" . $row['e-mail'] . "</td>";
                echo "<td>" . $row['telefoon_nr'] . "</td>";
                echo "<td>" . $row['project_omschrijving'] . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=delete'> Delete </a>" . "</td>";
                echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=update'> Update </a>" . "</td>";
            }
            ?>
        </tbody>
    </table>
</div>