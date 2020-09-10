<?php require_once PROJECTEN_PLUGIN_MODEL_DIR . "/project.php"; ?>
<?php
$project = new Project;
// Get form vars
$post_inputs = $project->getPostValues();

?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<form method="post">
    <input type="text" name="voornaam" placeholder="voornaam">
    <input type="text" name="achternaam" placeholder="achternaam">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="telefoon_nr" placeholder="telefoon nr">
    <textarea name="project_omschrijving" cols="30" rows="10"></textarea>
    <input type="submit" name="verzenden">
</form>

<?php 
if(isset($_POST['verzenden'])){
    $project->save($post_inputs['voornaam'], $post_inputs['achternaam'], $post_inputs['email'], $post_inputs['telefoon_nr'], $post_inputs['project_omschrijving']);

}
        echo "</br>". "Query executed is".$wpdb->last_query;
        echo "</br>". "Last error".$wpdb->last_error;

?>