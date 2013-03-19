<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$admin = $_POST['admin'];

$password = ($_POST['password']);

echo $password;

if (isset($admin, $password)) {

    $db->db_connection($config);

    $query = "SELECT * FROM admin WHERE username='$admin' and password= '$password'";

    $result = $db->db_query($query);

    $count = mysql_num_rows($result);


    if ($count == 1) {

        session_start();

        $_SESSION['name'] = $admin;

        header("Location:quizdetailsgrid.php");
    } else {

        header("Location:Adminlogin.php?msg=Invalid Username/Password");
    }
} else {
    header("Location:Adminlogin.php?msg=Enter Username and Password");
}
?>
