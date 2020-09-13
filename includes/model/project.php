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
     * createMainTable :
     * Creates pp_projects table in database
     * 
     * @return bool if query succeed or not 
     */
    public function createMainTable()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE `projecten_plugin`. `pp_projects`( `id` INT NOT NULL AUTO_INCREMENT , `voornaam` VARCHAR(255) NOT NULL , `achternaam` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `telefoon_nr` VARCHAR(255) NOT NULL , `project_omschrijving` TEXT NOT NULL , `status_id` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    }

    /**
     * createStatusTable :
     * Creates pp_status table in database
     * 
     * @return bool if query succeed or not 
     */
    public function createStatusTable()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE `projecten_plugin`.`pp_status` ( `status_id_pk` INT NOT NULL AUTO_INCREMENT , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`status_id_pk`)) ENGINE = InnoDB; ");
    }


    /**      
     * save :      
     * Saves values from form to database       
     * @return bool if query succeed or not 
     */
    public function save($voornaam, $achternaam, $email, $telnr, $project_omschrijving)
    {
        global $wpdb;
        if (isset($_POST['verzenden'])) {
            $sql = $wpdb->prepare("INSERT INTO pp_projects(`voornaam`, `achternaam`, `email`, `telefoon_nr`, `project_omschrijving`) VALUES ('$voornaam','$achternaam','$email','$telnr', '$project_omschrijving') ");
            $wpdb->query($sql);
        }
    }

    /**      
     * delete :      
     * Delete values from database       
     * @return bool if query succeed or not 
     */
    public function delete()
    {
        if (isset($_GET['delete'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("DELETE FROM pp_projects WHERE ID = '$project_id'");
        }
    }

    /**      
     * updateStatus :      
     * Updates the status_id whenever user clicks on approve or decline      
     * @return bool if query succeed or not else return NULL
     */
    public function updateStatus()
    {
        if (isset($_GET['approve'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("UPDATE pp_projects SET status_id = 2 WHERE id = '$project_id'");
        } elseif (isset($_GET['decline'])) {
            global $wpdb;
            $project_id = $_GET['id'];
            $wpdb->query("UPDATE pp_projects SET status_id = 3 WHERE id = '$project_id'");
        } else {
            return null;
        }
    }

    /**      
     * updateProject :      
     * Updates values in DB      
     * @return bool if query succeed or not
     */
    public function updateProject($voornaam, $achternaam, $email, $telnr, $project_omschrijving, $id)
    {

        global $wpdb;
        $wpdb->query("UPDATE pp_projects SET voornaam = '$voornaam', achternaam = '$achternaam', email = '$email', telefoon_nr = '$telnr', project_omschrijving = '$project_omschrijving' WHERE id = $id");
    }

    /**      
     * getProjectRows :      
     * get rows from table pp_projects      
     * @return array
     */
    public function getProjectRows(){
        global $wpdb;
        $result = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk", ARRAY_A);
        return $result;
    }

   /**      
     * getApprovedRows :      
     * get rows from table pp_projects where status_id = 2       
     * @return array
     */
    public function getApprovedRows(){
        global $wpdb;
        $result = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk WHERE pp_projects.status_id = 2", ARRAY_A);
        return $result;
    }
    

    /**      
     * getFirstName :      
     * Get the firstname of the row that has been selected     
     * @return string returns the firstname 
     */
    public function getFirstName($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT voornaam FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['voornaam'];
        }
    }

    /**      
     * getLastName :      
     * Get the lastname of the row that has been selected     
     * @return string returns the lastname 
     */
    public function getLastName($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT achternaam FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['achternaam'];
        }
    }

    /**      
     * getEmail :      
     * Get the email of the row that has been selected     
     * @return string returns the email  
     */
    public function getEmail($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT email FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['email'];
        }
    }

    /**      
     * getTelNr :      
     * Get the phone number of the row that has been selected     
     * @return string returns the phone number.  
     */
    public function getTelNr($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT telefoon_nr FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['telefoon_nr'];
        }
    }
}
