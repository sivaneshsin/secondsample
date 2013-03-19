<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$password=($_POST[password]);

$query="SELECT * FROM trainerregistration";

$result=$db->db_query($query);

while($row = mysql_fetch_array($result,MYSQL_ASSOC))
{
   
   if($row['username']==$_POST['name'])
   {
       header("Location:trainerlogin.php?msg=Username already Exists");
       exit;
   }
}   

$query = "INSERT INTO trainerregistration(username,password,email) 

VALUES ('$_POST[name]','$password','$_POST[email]')";

$db->db_query($query);

header("Location:trainerlogin.php?msg=Registered,Please login here");
?>
