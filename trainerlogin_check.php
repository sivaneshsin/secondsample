<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$name = $_POST['name'];

$password = $_POST['password'];

$pass=$_POST['password'];

if (isset($name, $password)) {

    $db->db_connection($config);

    $query = "SELECT * FROM trainerregistration WHERE username='$name' and password='$pass'";

    $result = $db->db_query($query);

    $count = mysql_num_rows($result);

    if ($count == 1) {

        session_start();

        $_SESSION['name'] = $name;

        header("Location:conductquizdetailsgrid.php");
        
    } else {

        header("Location:trainerlogin.php?msg=Invalid Username/Password");
    }
} else {
    header("Location:trainerlogin.php?msg=Enter Username and Password");
}
?>

