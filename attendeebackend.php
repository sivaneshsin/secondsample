<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query="SELECT * FROM attendeeregistration";

$result=$db->db_query($query);

while($row = mysql_fetch_array($result,MYSQL_ASSOC))
{
   
   if($row['name']==$_POST['name'])
   {
       header("Location:attendeelogin.php?msg=Username already Exists");
       exit;
   }
}   

$query = "INSERT INTO attendeeregistration(name,password,email) 

VALUES ('$_POST[name]','$_POST[password]','$_POST[email]')";

$db->db_query($query);

header("Location:attendeelogin.php?msg=Registered");
?>

