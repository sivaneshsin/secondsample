<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$copy_id = $_POST['copy_id'];
$date = $_POST['date'];
$q_date=strtotime($date);
$q_year_date=date('Y-m-d',$q_date);

$query = "SELECT * FROM quizdetails WHERE id='$copy_id'";
$result = $db->db_query($query);
$row = mysql_fetch_assoc($result);

{
    $q_name = $row['quiz_name'];
    $q_technology_id = $row['technology_id'];
    $q_subcategory_name = $row['subcategory_name'];

    $q_trainername = $row['trainername'];
    $q_quiz_topic = $row['quiz_topic'];

    $quiz_type = $row['quiz_type'];

    if ($quiz_type == "Technical") {

        $query = "INSERT INTO sample(id,quizdate,type) VALUES ('','$date','$type')";

        $db->db_query($query);

        $id = mysql_insert_id();

//        $query = "SELECT year(quizdate) AS year FROM sample WHERE id=$copy_id";
//
//        $result = $db->db_query($query);
//
//        $da = mysql_fetch_array($result);

        $re = substr($quiz_type, 0, 1);

//        $da_year = $da['year'];
        $year=date('y',$q_date);
//        $year = substr($da_year, 2, 4);
        $quiznumber = (string) $year . $re . "00" . $copy_id;
         $quiznumber;
    } else {

        $query = "INSERT INTO sample1(id,quizdate,type) VALUES ('','$date','$type')";

        $db->db_query($query);

        $id = mysql_insert_id();

//         $query = "SELECT year(quizdate) AS year FROM sample1 WHERE id=$copy_id";
//
//        $result = $db->db_query($query);
//
//        $da = mysql_fetch_array($result);

        $re = substr($quiz_type, 0, 1);
//        $da_year = $da['year'];
        $year=date('y',$q_date);
//        $year = substr($da_year, 2, 4);
        
        $quiznumber = (string) $year . $re . "00" . $id;

         $quiznumber;
    }
}

echo $query = "INSERT INTO quizdetails (quiz_date,quiz_name,quiz_number,quiz_type,technology_id,subcategory_name,quiz_topic,trainername,is_active) 
VALUES('$q_year_date','$q_name','$quiznumber','$quiz_type','$q_technology_id','$q_subcategory_name','$q_quiz_topic','$q_trainername',1)";


$db->db_query($query);

$q_quiz_id = $db->lastInsertId();

$query = "SELECT * FROM questiondetails WHERE quiz_id='$copy_id'";


$result = $db->db_query($query);

while ($row = mysql_fetch_assoc($result))
{
    var_dump($row);
    
    $q_question=$row['question'];
    $q_option1=$row['option1'];
    $q_option2=$row['option2'];
    $q_option3=$row['option3'];
    $q_option4=$row['option4'];
    $q_correctanswer=$row['correctanswer'];
    $q_quest_number=$row['question_number'];
    
    $query = "INSERT INTO questiondetails (question,option1,option2,option3,option4,correctanswer,quiz_id,is_active,question_number) 
VALUES('$q_question','$q_option1','$q_option2','$q_option3','$q_option4','$q_correctanswer','$q_quiz_id',1,'$q_quest_number')";

$db->db_query($query);
}


header("Location:quizdetailsgrid.php");
?>