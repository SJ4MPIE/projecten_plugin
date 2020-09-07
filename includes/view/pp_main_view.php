<?php require_once "PROJECTEN_PLUGIN_MODEL_DIR" . "/project.php"; ?>
<?php
$project = new Project;

?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<form method="post">
    <input type="text" name="voornaam" placeholder="voornaam">
    <input type="text" name="achternaam" placeholder="achternaam">
    <input type="text" name="e-mail" placeholder="email">
    <input type="text" name="telefoon_nr" placeholder="telefoon nr">
    <input type="submit" value="verzenden">
</form>