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
            $project->getNewProjects();
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
            $project->getApprovedProjects();
            ?>
        </tbody>
    </table>
</div>