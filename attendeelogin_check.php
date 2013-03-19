<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$name = $_POST['name'];

$password = $_POST['password'];
            
if (isset($name, $password)) {

    $db->db_connection($config);

    $query = "SELECT * FROM attendeeregistration WHERE name='$name' and password='$password'";

    $result = $db->db_query($query);

    $count = mysql_num_rows($result);

    if ($count == 1) {

        session_start();

        $_SESSION['name'] = $name;

        header("Location:attendee.php");
        
    } else {

        header("Location:attendeelogin.php?msg=Invalid Username/Password");
    }
} else {
    header("Location:attendeelogin.php?msg=Enter Username and Password");
}
?>

