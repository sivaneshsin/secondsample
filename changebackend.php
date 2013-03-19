<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query = "UPDATE admin SET password='$_POST[npassword]' WHERE username='$_POST[name]'";

$db->db_query($query);

header("Location:Adminlogin.php?msg=Password changed,Please login with New Password");
?>
