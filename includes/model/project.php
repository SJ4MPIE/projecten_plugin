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
            echo "<td>" . $row['e-mail'] . "</td>";
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
            echo "<td>" . $row['e-mail'] . "</td>";
            echo "<td>" . $row['telefoon_nr'] . "</td>";
            echo "<td>" . $row['project_omschrijving'] . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=delete'> Delete </a>" . "</td>";
            echo "<td>" . "<a href='admin.php?page=projecten+plugin?value=update'> Update </a>" . "</td>";
        }
    }

    /**      
     *getPostValues :      
     * Filter input and retrieve POST input params      
     * @return array containing known POST input fields     
     */
    public function save()
    {
        global $wpdb;
        if (isset($_POST['verzenden'])) {
        }
    }
}
