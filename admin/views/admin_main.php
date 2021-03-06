<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php require_once PROJECTEN_PLUGIN_MODEL_DIR . "/project.php";
?>
<?php
$project = new Project;
// Get form vars
$post_inputs = $project->getPostValues();
$get_inputs = $project->getGetValues();
//get current id 
$pp_id = $project->getId();
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
                    foreach($result_new as $each_row){
                            $pp_id = $each_row->getId();
                            echo "<tr><td>" . $each_row->getId() . "</td>";
                            echo "<td>" . $each_row->getVoornaam() . "</td>";
                            echo "<td>" .  $each_row->getAchternaam() . "</td>";
                            echo "<td>" .  $each_row->getEmail() . "</td>";
                            echo "<td>" .  $each_row->getTelNr() . "</td>";
                            echo "<td>" .  $each_row->getOmschrijving() . "</td>";
                            echo "<td>" .  $each_row->getStatus()  . "</td>";
                

                        if ($each_row->getStatus() ==  'In afwachting') {
                            echo "<td>" . "<a href='admin.php?page=projecten+plugin&approve&id={$pp_id}&new'> Approve </a>" . "</td>";
                            echo "<td>" . "<a href='admin.php?page=projecten+plugin&decline&id={$pp_id}&new'> Decline </a>" . "</td></tr>";
                        }
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Loops through $result_approved and outputs the rows from DB
                global $wpdb;
                $result_approved = $project->getApprovedRows();
                foreach ($result_approved as $each_row) {
                    $pp_id = $each_row->getApprovedId();
                    echo "<tr><td>" . $each_row->getApprovedId() . "</td>";
                    echo "<td>" . $each_row->getApprovedVoornaam() . "</td>";
                    echo "<td>" .  $each_row->getApprovedAchternaam() . "</td>";
                    echo "<td>" .  $each_row->getApprovedEmail() . "</td>";
                    echo "<td>" .  $each_row->getApprovedTelNr() . "</td>";
                    echo "<td>" .  $each_row->getApprovedOmschrijving() . "</td>";
                    echo "<td>" .  $each_row->getApprovedStatus()  . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&delete&id={$pp_id}'> Delete </a>" . "</td>";
                    echo "<td>" . "<a href='admin.php?page=projecten+plugin&update&id={$pp_id}'> Update </a>" . "</td></tr>";
                }

                $project->updateStatus();
                $project->delete();
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
                <input class="form-control" type="text" name="voornaam" value="<?php echo $project->getFirstName($pp_id); ?>" placeholder="voornaam">
                <input class="form-control" type="text" name="achternaam" value="<?php echo $project->getLastName($pp_id); ?>" placeholder="achternaam">
                <input class="form-control" type="text" name="email" value="<?php echo $project->getEmailValue($pp_id); ?>" placeholder="email">
                <input class="form-control" type="text" name="telefoon_nr" value="<?php echo $project->getTelNrValue($pp_id); ?>" placeholder="telefoon nr">
                <textarea name="project_omschrijving" cols="30" rows="10"></textarea>
                <input type="submit" name="updateValues">
            </form>
        <?php
        }
        //Whenever the admin clicks on update the values will be sent to updateProject();
        if (isset($_POST["updateValues"])) {
            $project->updateProject($post_inputs['voornaam'], $post_inputs['achternaam'], $post_inputs['email'], $post_inputs['telefoon_nr'], $post_inputs['project_omschrijving'], $pp_id);
        }

        ?>

        </tbody>

    </div>
</div>