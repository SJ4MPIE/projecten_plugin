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
        $post_inputs = filter_input_array(INPUT_POST, $post_check_array);
        // RTS
        return $post_inputs;
    }

    public function getGetValues()
    {

        // Define the check for params
        $get_check_array = array(
            // submit action
            'id' => array('filter' => FILTER_SANITIZE_STRING),
            // List all update form fields !!!
            // event type name.
            'approve' => array('filter' => FILTER_SANITIZE_STRING),
            // Help text
            'decline' => array('filter' => FILTER_SANITIZE_STRING),

            'update' => array('filter' => FILTER_SANITIZE_STRING),

            'delete' => array('filter' => FILTER_SANITIZE_STRING),

            'updateValues' => array('filter' => FILTER_SANITIZE_STRING)
            // Id of current row
        );
        // Get filtered input:
        $get_inputs = filter_input_array(INPUT_GET, $get_check_array);
        // RTS
        return $get_inputs;
    }

    /**
     * createMainTable :
     * Creates pp_projects table in database
     * 
     * @return bool if query succeed or not 
     */
    public static function createMainTable()
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
    public static  function createStatusTable()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE `projecten_plugin`.`pp_status` ( `status_id_pk` INT NOT NULL AUTO_INCREMENT , `status` VARCHAR(255) NOT NULL , PRIMARY KEY (`status_id_pk`)) ENGINE = InnoDB; ");
    }

    /**
     * insertStatusTable :
     * insert values to pp_stauts
     * 
     * @return bool if query succeed or not 
     */
    public static function insertStatusTable()
    {
        global $wpdb;
        $wpdb->query("INSERT INTO `pp_status` (`status_id_pk`, `status`) VALUES (NULL, 'In afwachting'), (NULL, 'Goedgekeurd'), (NULL, 'Afgekeurd')");
    }


    /**      
     * save :      
     * Saves values from form to database       
     * @return bool if query succeed or not 
     */
    public function save($voornaam, $achternaam, $email, $telnr, $project_omschrijving)
    {
        if (current_user_can('pp_create')) {
            global $wpdb;
            if (isset($_POST['verzenden'])) {
                $sql = $wpdb->prepare("INSERT INTO pp_projects(`voornaam`, `achternaam`, `email`, `telefoon_nr`, `project_omschrijving`) VALUES ('$voornaam','$achternaam','$email','$telnr', '$project_omschrijving') ");
                $wpdb->query($sql);
            }
        }
    }

    /**      
     * delete :      
     * Delete values from database       
     * @return bool if query succeed or not 
     */
    public function delete()
    {
            $getValues =  $this->getGetValues();
            $getValues_id = $getValues['id'];
            if (isset($getValues['delete'])) {
                global $wpdb;
                $wpdb->query("DELETE FROM pp_projects WHERE ID = $getValues_id");
            }
    }


    /**      
     * updateStatus :      
     * Updates the status_id whenever user clicks on approve or decline      
     * @return bool if query succeed or not else return NULL
     */
    public function updateStatus()
    {
            $getValues = $this->getGetValues();
            $getValues_id = $getValues['id'];
            if (isset($getValues['approve'])) {
                global $wpdb;
                $wpdb->query("UPDATE pp_projects SET status_id = 2 WHERE id = '$getValues_id'");
            } elseif (isset($getValues['decline'])) {
                global $wpdb;
                $wpdb->query("UPDATE pp_projects SET status_id = 3 WHERE id = '$getValues_id'");
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
    public function getProjectRows()
    {
        $return_array = array();
            global $wpdb;
            $result_array = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk", ARRAY_A);
            // var_dump($result);

            foreach($result_array as $idx => $array){
                $schema = new Project;
                $schema->setId($array['id']);
                $schema->setVoornaam($array['voornaam']);
                $schema->setAchternaam($array['achternaam']);
                $schema->setEmail($array['email']);
                $schema->setTelNr($array['telefoon_nr']);
                $schema->setOmschrijving($array['project_omschrijving']);
                $schema->setStatus($array['status']);

                $return_array[] = $schema;

            }
            return $return_array;
    }

    /**      
     * setId :      
     * set id to variable      
     * @return $id
     */
    public function setId($id){
            $this->id = $id;
    }

    /**      
     * setVoornaam :      
     * set voornaam to variable      
     * @return $voornaam
     */
    public function setVoornaam($voornaam){
        if(is_string($voornaam)){
            $this->voornaam = trim($voornaam);
        }
    }

    /**      
     * setAchternaam :      
     * set achternaam to variable      
     * @return $achternaam
     */
    public function setAchternaam($achternaam){
        if(is_string($achternaam)){
            $this->achternaam = trim($achternaam);
        }
    }

    /**      
     * setEmail :      
     * set email to variable      
     * @return $email
     */
    public function setEmail($email){
        if(is_string($email)){
            $this->email = $email;
        }
    }

    /**      
     * setTelNr :      
     * set telefoon nr  to variable      
     * @return $telnr
     */
    public function setTelNr($telnr){
        $this->telnr = $telnr;
        }

    
    /**      
     * setOmschrijving :      
     * set project omschrijving  to variable      
     * @return $omschrijving
     */
    public function setOmschrijving($omschrijving){
        if(is_string($omschrijving)){
            $this->omschrijving = $omschrijving;
        }
    }

    /**      
     * setStatus :      
     * set status to variable      
     * @return $status
     */
    public function setStatus($status){
        if(is_string($status)){
            $this->status = $status;
        }
    }

    /**      
     * getId :      
     * get id       
     * @return $id
     */
    public function getId(){
        return $this->id;
    }

    /**      
     * getVoornaam :      
     * get voornaam       
     * @return $voornaam
     */
    public function getVoornaam(){
        return $this->voornaam;
    }

    /**      
     * getAchternaam :      
     * get achternaam       
     * @return $achternaam
     */
    public function getAchternaam(){
        return $this->achternaam;
    }

    /**      
     * getEmail :      
     * get email       
     * @return $email
     */
    public function getEmail(){
        return $this->email;
    }

    /**      
     * getTelNr :      
     * get telefoon nr       
     * @return $telnr
     */
    public function getTelNr(){
        return $this->telnr;
    }

    /**      
     * getOmschrijving :      
     * get project omschrijving       
     * @return $omschrijving
     */
    public function getOmschrijving(){
        return $this->omschrijving;
    }

    /**      
     * getStatus :      
     * get status       
     * @return $status
     */
    public function getStatus(){
        return $this->status;
    }

    /**      
     * getApprovedRows :      
     * get rows from table pp_projects where status_id = 2       
     * @return array
     */
    public function getApprovedRows()
    {       
            $return_array = array();
            global $wpdb;
            $result_array = $wpdb->get_results("SELECT *, pp_status.status FROM pp_projects INNER JOIN pp_status ON pp_projects.status_id = pp_status.status_id_pk WHERE pp_projects.status_id = 2 ", ARRAY_A);

            foreach($result_array as $idx => $array){
                $schema = new Project;
                $schema->setApprovedId($array['id']);
                $schema->setApprovedVoornaam($array['voornaam']);
                $schema->setApprovedAchternaam($array['achternaam']);
                $schema->setApprovedEmail($array['email']);
                $schema->setApprovedTelNr($array['telefoon_nr']);
                $schema->setApprovedOmschrijving($array['project_omschrijving']);
                $schema->setApprovedStatus($array['status']);

                $return_array[] = $schema;

            }
            return $return_array;
    }

    /**      
     * setApprovedId :      
     * set approved id to variable      
     * @return $id
     */
    public function setApprovedId($id){
        $this->id = $id;
    }

    /**      
     * setApprovedVoornaam :      
     * set approved voornaam to variable      
     * @return $voornaam
     */
    public function setApprovedVoornaam($voornaam){
        if(is_string($voornaam)){
            $this->voornaam = trim($voornaam);
        }
    }

    /**      
     * setApprovedAchternaam :      
     * set approved achternaam to variable      
     * @return $achternaam
     */
    public function setApprovedAchternaam($achternaam){
        if(is_string($achternaam)){
            $this->achternaam = trim($achternaam);
        }
    }

    /**      
     * setApprovedEmail :      
     * set approved email to variable      
     * @return $email
     */
    public function setApprovedEmail($email){
        if(is_string($email)){
            $this->email = $email;
        }

    }

    /**      
     * setApprovedTelNr :      
     * set approved telefoon nr to variable      
     * @return $telnr
     */
    public function setApprovedTelNr($telnr){
        $this->telnr = $telnr;
    }

    
    /**      
     * setApprovedOmschrijving :      
     * set approved project omschrijving to variable      
     * @return $omschrijving
     */
    public function setApprovedOmschrijving($omschrijving){
        if(is_string($omschrijving)){
            $this->omschrijving = $omschrijving;
        }
    }

    /**      
     * setApprovedStatus :      
     * set approved status to variable      
     * @return $status
     */
    public function setApprovedStatus($status){
        if(is_string($status)){
            $this->status = $status;
        }
    }

    /**      
     * getApprovedId :      
     * get approved id to variable      
     * @return $id
     */
    public function getApprovedId(){
        return $this->id;
    }

    /**      
     * getApprovedVoornaam :      
     * get approved voornaam to variable      
     * @return $id
     */
    public function getApprovedVoornaam(){
        return $this->voornaam;
    }

    /**      
     * getApprovedAchternaam :      
     * get approved achternaam to variable      
     * @return $achternaam
     */
    public function getApprovedAchternaam(){
        return $this->achternaam;
    }

    /**      
     * getApprovedEmail :      
     * get approved email to variable      
     * @return $email
     */
    public function getApprovedEmail(){
        return $this->email;


    }

    /**      
     * getApprovedTelNr :      
     * get approved telefoon nr to variable      
     * @return $telnr
     */
    public function getApprovedTelNr(){
        return $this->telnr;
    }

    /**      
     * getApprovedOmschrijving :      
     * get approved project omschrijving to variable      
     * @return $omschrijving
     */
    public function getApprovedOmschrijving(){
        return $this->omschrijving;

    }

    /**      
     * getApprovedStatus :      
     * get approved status to variable      
     * @return $status
     */
    public function getApprovedStatus(){
        return $this->status;
    }



    /**      
     * getFirstName :      
     * Get the firstname of the row that has been selected     
     * @return string returns the firstname 
     */
    public function getFirstName($id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT voornaam FROM pp_projects WHERE id = $id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['voornaam'];
        }
    }

    /**      
     * getLastName :      
     * Get the lastname of the row that has been selected     
     * @return string returns the lastname 
     */
    public function getLastName($id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT achternaam FROM pp_projects WHERE id = $id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['achternaam'];
        }
    }

    /**      
     * getEmail :      
     * Get the email of the row that has been selected     
     * @return string returns the email  
     */
    public function getEmailValue($id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT email FROM pp_projects WHERE id = $id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['email'];
        }
    }

    /**      
     * getTelNr :      
     * Get the phone number of the row that has been selected     
     * @return string returns the phone number.  
     */
    public function getTelNrValue($pp_id)
    {
        global $wpdb;
        $result_query = $wpdb->get_results("SELECT telefoon_nr FROM pp_projects WHERE id = $pp_id LIMIT 1", ARRAY_A);
        foreach ($result_query as $row) {
            return $row['telefoon_nr'];
        }
    }
}
