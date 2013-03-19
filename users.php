<?php
session_start();

require_once 'include/config.php';

require_once 'Database.php';

$db=new Database();

$db->db_connection($config);

$username=$_POST['username'];

$quiznumber=$_POST['quiznumber'];

$quiz_id= $_SESSION['quiz_id_users'];

$query="INSERT INTO users(name,quiznumber,quiz_id_fk ) VALUES('$username','$quiznumber','$quiz_id')";

//echo $query;

$db->db_query($query);

?>
