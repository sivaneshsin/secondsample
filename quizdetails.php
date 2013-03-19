<?php

$page = $_GET['page'];

$limit = $_GET['rows'];

$sidx = $_GET['sidx'];

$sord = $_GET['sord'];

if (!$sidx)
    $sidx = 1;

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz", $db) or die("Error connecting to db.");

$result = mysql_query("SELECT COUNT(*) AS count FROM quizdetails");

$row = mysql_fetch_array($result, MYSQL_ASSOC);

$count = $row['count'];

if ($count > 0 && $limit > 0) {
    $total_pages = ceil($count / $limit);
} else {
    $total_pages = 0;
}

if ($page > $total_pages)
    $page = $total_pages;


$start = $limit * $page - $limit;

if ($start < 0)
    $start = 1;

$SQL = "SELECT s.id,quiz_date,quiz_name,quiz_number,quiz_type,tname,subcategory_name,quiz_topic,trainername FROM quizdetails s JOIN technology t
    
    WHERE s.technology_id=t.id";

if ($_GET['id'] == 'Technical' || $_GET['id'] == 'Nontechnical') {
    $SQL .= " AND s.quiz_type='$_GET[id]' ";
}

if (isset($_GET['status'])) {
    if($_GET['status'] != 2)
    $SQL .= " AND s.is_active='$_GET[status]' ";
}


if (isset($_GET['qsearch'])) {

    $SQL .=" AND s.quiz_date LIKE '%$_GET[qsearch]%' OR s.quiz_name LIKE '%$_GET[qsearch]%' 
    
   OR s.quiz_number LIKE '%$_GET[qsearch]%' OR s.quiz_type LIKE '%$_GET[qsearch]%' OR t.tname LIKE '%$_GET[qsearch]' OR s.trainername LIKE '%$_GET[qsearch]%' OR s.quiz_topic LIKE '%$_GET[qsearch]%' OR s.subcategory_name LIKE '%$_GET[qsearch]%' ";
}
$SQL .= " ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL);
//echo $SQL;
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>" . $page . "</page>";
$s .= "<total>" . $total_pages . "</total>";
$s .= "<records>" . $count . "</records>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

    $noofrows = mysql_query("select  count(*) as Noofquestions from questiondetails qu join quizdetails q on q.id=qu.quiz_id where q.id='$row[id]'");

    $questions = mysql_fetch_array($noofrows);

    $s .= "<row id='" . $row['id'] . "'>";
    $s .= "<cell>" . $row['id'] . "</cell>";
    $s .= "<cell>" . date('d-m-Y (D)', strtotime($row['quiz_date'])) . "</cell>";
    $s .= "<cell>" . $row['quiz_number'] . "</cell>";
    $s .= "<cell>" . $row['quiz_name'] . "</cell>";
    $s .= "<cell>" . $row['quiz_type'] . "</cell>";
    $s .= "<cell>" . $row['tname'] . "</cell>";
    $s .= "<cell>" . $row['subcategory_name'] . "</cell>";
    $s .= "<cell>" . $row['quiz_topic'] . "</cell>";
    $s .= "<cell>" . $row['trainername'] . "</cell>";
    $s .= "<cell>" . $questions['Noofquestions'] . "</cell>";
    $s .="<cell> Copyquiz</cell>";
    $s .= "</row>";
}
$s .= "</rows>";

echo $s;
?>
