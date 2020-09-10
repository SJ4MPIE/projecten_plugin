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
            'email' => array('filter' => FILTER_SANITIZE_EMAIL),
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
            $sql = $wpdb->prepare("INSERT INTO pp_projects(`voornaam`, `achternaam`, `email`, `telefoon_nr`, `project_omschrijving`) VALUES ('$voornaam','$achternaam','$email','$telnr', '$project_omschrijving') ");
            $wpdb->query($sql);
        }


    }


    public function delete()
    {
        if (isset($_GET['delete'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("DELETE FROM pp_projects WHERE ID = '$project_id'");
        }
    }


    public function updateStatus()
    {
        if (isset($_GET['approve'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("UPDATE pp_projects SET status_id = 1 WHERE id = '$project_id'");
        } elseif (isset($_GET['decline'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("UPDATE pp_projects SET status_id = 2 WHERE id = '$project_id'");
        } else {
            return null;
        }
    }

    public function updateProject($voornaam, $achternaam, $email, $telnr, $project_omschrijving, $id){

        global $wpdb; 
        $wpdb->query("UPDATE pp_projects SET voornaam = '$voornaam', achternaam = '$achternaam', email = '$email', telefoon_nr = '$telnr', project_omschrijving = '$project_omschrijving' WHERE id = $id");
    }

    public function getFirstName($pp_id)
    {
            global $wpdb;
            $result_query = $wpdb->get_results("SELECT voornaam FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
            foreach($result_query as $row){
                return $row['voornaam'];
            }

    }

    public function getLastName($pp_id)
    {
            global $wpdb;
            $result_query = $wpdb->get_results("SELECT achternaam FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
            foreach($result_query as $row){
                return $row['achternaam'];
            }

    }

    public function getEmail($pp_id)
    {
            global $wpdb;
            $result_query = $wpdb->get_results("SELECT email FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
            foreach($result_query as $row){
                return $row['email'];
            }

    }

    
    public function getTelNr($pp_id)
    {
            global $wpdb;
            $result_query = $wpdb->get_results("SELECT telefoon_nr FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
            foreach($result_query as $row){
                return $row['telefoon_nr'];
            }

    }

    

}
