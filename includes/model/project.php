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
            $sql = $wpdb->prepare("INSERT INTO pp_projects(`voornaam`, `achternaam`, `email`, `telefoon_nr`, `project_omschrijving`) VALUES ('$voornaam','$achternaam','$email','$telnr', '$project_omschrijving') ");
            $wpdb->query($sql);
        }

        // echo "</br>". "Query executed is".$wpdb->last_query;
        // echo "</br>". "Last error".$wpdb->last_error;

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
        } elseif ($_GET['decline']) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("UPDATE pp_projects SET status_id = 2 WHERE id = '$project_id'");
        } else {
            return null;
        }

        echo "</br>" . "Query executed is" . $wpdb->last_query;
        echo "</br>" . "Last error" . $wpdb->last_error;
    }

    public function update($pp_id)
    {
        $pp_id;
    }

    public function getFirstName($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT voornaam FROM pp_projects WHERE id = $pp_id", ARRAY_A);
        var_dump($result_query);

        foreach($result_query as $row){
            r
        }
    }
}
