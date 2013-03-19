<?php

require_once 'include/config.php';

require_once 'Database.php';

$db=new Database();

$db->db_connection($config);

if($_POST['oper']=='add')
{   
   
$quizdate=$_POST['quiz_date'];

$quizname=$_POST['quiz_name'];

$quiznumber=$_POST['quiz_number'];

$quiztype=$_POST['quiz_type'];

if($quiztype=="Technical")
    
{   
    
$query="INSERT INTO sample(id,quizdate,type)VALUES('','$quizdate','$quiztype')";

echo $query;

$db->db_query($query);

$pid=  mysql_insert_id();

$query="SELECT year(quizdate) AS year FROM sample WHERE id=$pid";

$result = $db->db_query($query);

$da= mysql_fetch_array($result);
   
$re=  substr($quiztype,0,1);

$quizreference = substr((string)$da['year'],2,2).$re."00".$pid;

}
if($quiztype=="Nontechnical")
{
    
$query="INSERT INTO sample1(id,quizdate,type)VALUES('','$quizdate','$quiztype')";

$db->db_query($query);

$pid=  mysql_insert_id();

$query="SELECT year(quizdate) AS year FROM sample1 WHERE id=$pid";

$result = $db->db_query($query);

$da= mysql_fetch_array($result);
   
$re=  substr($quiztype,0,1);
 
$quizreference = substr((string)$da['year'],2,2).$re."00".$pid;
      
}   
$technology=$_POST['technology_id'];
    
$subcategory=$_POST['subcategory_name'];

$quiztopic=$_POST['quiz_topic'];
    
$trainername=$_POST['trainername'];

$db->db_connection($config);

$query = "INSERT INTO quizdetails(id,quiz_date,quiz_name,quiz_number,quiz_type,technology_id,subcategory_name,quiz_topic,trainername) 

VALUES ('','$quizdate','$quizname','$quizreference','$quiztype','$technology','$subcategory','$quiztopic','$trainername')";


$result = $db->db_query($query);

}

if($_POST['oper']=='edit')
{   

 $id=$_POST['id'];
 
$quizdate=$_POST['quiz_date'];

$quizname=$_POST['quiz_name'];

$quiznumber=$_POST['quiz_number'];

$quiztype=$_POST['quiz_type'];

$technology=$_POST['technology_id'];

$quiztopic=$_POST['quiz_topic'];

$trainername=$_POST['trainername'];

$db->db_connection($config);

$query = "UPDATE quizdetails SET quiz_date='$quizdate',quiz_name='$quizname',quiz_type='$quiztype',

technology_id='$technology',quiz_topic='$quiztopic',trainername='$trainername' WHERE id=$id";

echo $query;

$result = $db->db_query($query);

}

if($_POST['oper']=='del')
{   

 $id=$_POST['id'];


$db->db_connection($config);


$query = "DELETE FROM quizdetails  WHERE id='$id'";


$result = $db->db_query($query);

}
?>
