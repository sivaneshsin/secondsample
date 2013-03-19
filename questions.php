<?php
$page1 = $_GET['page'];

$limit1 = $_GET['rows']; 

$sidx1 = $_GET['sidx'];

$sord1= $_GET['sord'];

if(!$sidx1) $sidx1 =1; 

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz",$db) or die("Error connecting to db.");

$result = mysql_query("SELECT COUNT(*) AS count1 FROM questiondetails WHERE quiz_id='$_GET[id]'");

$row = mysql_fetch_array($result,MYSQL_ASSOC); 

$count = $row['count1']; 
    
if( $count > 0 && $limit1 > 0) { 
              $total_pages = ceil($count/$limit1); 
} else { 
              $total_pages = 0; 
} 
 
if ($page1 > $total_pages) $page1=$total_pages;
 
 
$start1 = $limit1*$page1 - $limit1;

$SQL = "SELECT id,question,option1,option2,option3,option4,correctanswer,quiz_id FROM questiondetails WHERE quiz_id='$_GET[id]' ORDER BY $sidx1 $sord1 LIMIT $start1 , $limit1";  

$result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());

$s = "<?xml version='1.0' encoding='utf-8'?>";

$s .= "<rows>"; 
$s .= "<page>" . $page1 . "</page>";
$s .= "<total>" . $total_pages . "</total>";
$s .= "<records>" . $count . "</records>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $s .= "<row id='" . $row['id'] . "'>";
    $s .= "<cell>" . $row['question'] . "</cell>";
    $s .= "<cell>" . $row['option1'] . "</cell>";
    $s .= "<cell>" . $row['option2'] . "</cell>";
    $s .= "<cell>" . $row['option3'] . "</cell>";
    $s .= "<cell>" . $row['option4'] . "</cell>";
    $s .= "<cell>" . $row['correctanswer'] . "</cell>";
    $s .= "</row>";
}
$s .= "</rows>";

echo $s;
?>
