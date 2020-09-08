<?php
class Project
{

    /**
     * getPostValues :
     * Filter input and retrieve POST input params
     *
     * @return array containing known POST input fields
     */
    public function getPostValues()
    {

        // Define the check for params
        $post_check_array = array(
            // submit action
            'voornaam' => array('filter' => FILTER_SANITIZE_STRING),
            // List all update form fields !!!
            // event type name.
            'achternaam' => array('filter' => FILTER_SANITIZE_STRING),
            // Help text
            'email' => array('filter' => FILTER_SANITIZE_STRING),
            // Id of current row
            'telefoon_nr' => array('filter' => FILTER_SANITIZE_STRING),

            'project_omschrijving' => array('filter' => FILTER_SANITIZE_STRING)
        );
        // Get filtered input:
        $inputs = filter_input_array(INPUT_POST, $post_check_array);
        // RTS
        return $inputs;
    }


    /**      
     *getPostValues :      
     * Filter input and retrieve POST input params      
     * @return array containing known POST input fields     
     */
    public function save($voornaam, $achternaam, $email, $telnr, $project_omschrijving)
    {
        global $wpdb;
        if (isset($_POST['verzenden'])) {
            $sql = $wpdb->prepare("INSERT INTO pp_new_projects(`voornaam`, `achternaam`, `email`, `telefoon_nr`, `project_omschrijving`) VALUES ('$voornaam','$achternaam','$email','$telnr', '$project_omschrijving') ");
            $wpdb->query($sql);
        }

        // echo "</br>". "Query executed is".$wpdb->last_query;
        // echo "</br>". "Last error".$wpdb->last_error;

    }


    public function delete()
    {
        $tablename = null;
        if (isset($_GET['delete'])) {
            if (isset($_GET['new'])) {
                $tablename =  'pp_new_projects';
            } else {
                $tablename = 'pp_approved_projects';
            }
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("DELETE FROM $tablename WHERE ID = '$project_id'");
        }
    }
}
