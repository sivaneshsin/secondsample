<?php

require_once 'include/config.php';

require_once 'Database.php';
  
$db=new Database();

$db->db_connection($config);

if($_POST['oper']=='add')
    
{
 $query="SELECT MAX(question_number) FROM questiondetails WHERE quiz_id='$_GET[qid]'";
 
 $count=$db->db_query($query);
 
 $result=  mysql_fetch_row($count);

var_dump($result);

$questionnumber=$result[0]+1;

$query="INSERT INTO questiondetails(question,option1,option2,option3,option4,correctanswer,quiz_id,is_active,question_number) VALUES 

('$_POST[question]','$_POST[option1]','$_POST[option2]','$_POST[option3]','$_POST[option4]','$_POST[correctanswer]','$_GET[qid]','$_POST[is_active]','$questionnumber')";

$db->db_query($query);

}

if ($_POST['oper']=='edit')
{
    
    $query="UPDATE questiondetails SET question='$_POST[question]',option1='$_POST[option1]',
    
    option2='$_POST[option2]',option3='$_POST[option3]',option4='$_POST[option4]',correctanswer='$_POST[correctanswer]' WHERE id='$_POST[id]'"; 
    
    echo $query;
    $db->db_query($query);
    
}

if($_POST['oper']=='del')
{
    $query="DELETE FROM questiondetails WHERE id='$_POST[id]'";
   
    $db->db_query($query);
}
?>
