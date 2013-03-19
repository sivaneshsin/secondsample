<?php

require_once 'include/config.php';

require_once 'Database.php';

$db=new Database();

$db->db_connection($config);

$query="SELECT * FROM questiondetails WHERE quiz_id='$_POST[quiz_id]' AND id='$_POST[id]'";

$result=$db->db_query($query);

$row=  mysql_fetch_row($result);


if($row[6]==$_POST['answer'])
{
    $correct=1;
    
}   

else
{
    $wrong=1;
}

$query="INSERT INTO result(name,id,quiz_id,correct,wrong)VALUES('$_POST[name]','$_POST[id]','$_POST[quiz_id]','$correct','$wrong')";

echo $query;

$db->db_query($query);

?>
