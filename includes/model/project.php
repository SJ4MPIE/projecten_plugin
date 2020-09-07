<?php
class Project
{







    public function getNewProjects()
    {
        global $wpdb;
        $result_new = $wpdb->get_results("SELECT * FROM pp_new_projects", ARRAY_A);


        foreach ($result_new as $row) {
            echo "<tr><td>" . $row['id'] . "</td>";
            echo "<td>" . $row['voornaam'] . "</td>";
            echo "<td>" . $row['achternaam'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telefoon_nr'] . "</td>";
            echo "<td>" . $row['project_omschrijving'] . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=decline'> Decline </a>" . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=approve'> Approve </a>" . "</td>";
        }
    }

    public function getApprovedProjects()
    {
        global $wpdb;
        $result_approved = $wpdb->get_results("SELECT * FROM pp_approved_projects", ARRAY_A);
        foreach ($result_approved as $row) {
            echo "<tr><td>" . $row['id'] . "</td>";
            echo "<td>" . $row['voornaam'] . "</td>";
            echo "<td>" . $row['achternaam'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['telefoon_nr'] . "</td>";
            echo "<td>" . $row['project_omschrijving'] . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=delete'> Delete </a>" . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=update'> Update </a>" . "</td>";
        }
    }

      /**
     * getPostValues :
     * Filter input and retrieve POST input params
     *
     * @return array containing known POST input fields
     */
    public function getPostValues() {

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
}
