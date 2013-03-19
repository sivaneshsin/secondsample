<?php

session_start();

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz", $db) or die("Error connecting to db.");

if ($_GET['id'] == 'Technical' || $_GET['id'] == 'Nontechnical') {

    $SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
    ON s.technology_id=t.id WHERE s.quiz_type='$_GET[id]' AND trainername='$_SESSION[name]'";

    $result = mysql_query($SQL);
    
} else {
    
//    $SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
   // ON s.technology_id=t.id WHERE trainername='$_SESSION[name]'";
//     $SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
//    ON s.technology_id=t.id WHERE trainername='$_SESSION[name]' AND is_active=1";
$SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
    ON s.technology_id=t.id WHERE trainername='$_SESSION[name]'";
    $result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());
}

if ($_GET['status'] == '1' || $_GET['status'] == '0') {

    $SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
    ON s.technology_id=t.id WHERE s.is_active='$_GET[status]' AND s.quiz_type= '$_GET[id]' AND trainername='$_SESSION[name]'";

    $result = mysql_query($SQL);
}


if (isset($_GET['search'])) {

    $SQL = "SELECT s.id,s.quiz_date,s.quiz_name,s.quiz_number,s.quiz_type,tname,subcategory_name,quiz_topic,s.trainername FROM quizdetails s JOIN technology t
    
ON s.technology_id=t.id  WHERE s.quiz_date LIKE '%$_GET[search]%' OR s.quiz_name LIKE '%$_GET[search]%' 
    
OR s.quiz_number LIKE '%$_GET[search]%' OR s.quiz_type LIKE '%$_GET[search]%' OR s.trainername LIKE '%$_GET[search]%' OR s.quiz_topic LIKE '%$_GET[search]%'";

    $result = mysql_query($SQL);
}

header("Content-type: text/xml;charset=utf-8");
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>" . $page . "</page>";
$s .= "<total>" . $total_pages . "</total>";
$s .= "<records>" . $count . "</records>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
     
    $noofrows=  mysql_query("select  count(*) as Noofquestions from questiondetails qu join quizdetails q on q.id=qu.quiz_id where q.id='$row[id]'");
 
    $questions=  mysql_fetch_array($noofrows);
    
    $s .= "<row id='" . $row['id'] . "'>";
    $s .= "<cell>" . $row['id'] . "</cell>";
    $s .= "<cell>" . $row['quiz_date'] . "</cell>";
    $s .= "<cell>" . $row['quiz_number'] . "</cell>";
    $s .= "<cell>" . $row['quiz_name'] . "</cell>";
    $s .= "<cell>" . $row['quiz_type'] . "</cell>";
    $s .= "<cell>" . $row['tname'] . "</cell>";
    $s .= "<cell>" . $row['subcategory_name'] . "</cell>";
    $s .= "<cell>" . $row['quiz_topic'] . "</cell>";
    $s .= "<cell>" . $row['trainername'] . "</cell>";
    $s .= "<cell>" . $questions['Noofquestions'] . "</cell>";
    $s .= "<cell>" . "Start Quiz" . "</cell>";
    $s .= "</row>";
}

$s .= "</rows>";

echo $s;

?>
