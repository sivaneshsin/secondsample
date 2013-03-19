<?php

$page1 = $_GET['page'];

$limit1 = $_GET['rows']; 

$sidx1 = $_GET['sidx'];

$sord1= $_GET['sord'];

if(!$sidx1) $sidx1 =1; 

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz",$db) or die("Error connecting to db.");

$result = mysql_query("SELECT COUNT(*) AS count1 FROM trainerregistration");

$row = mysql_fetch_array($result,MYSQL_ASSOC); 

$count = $row['count1']; 
    
if( $count > 0 && $limit1 > 0) { 
              $total_pages = ceil($count/$limit1); 
} else { 
              $total_pages = 0; 
} 
 
if ($page1 > $total_pages) $page1=$total_pages;
 
 
$start1 = $limit1*$page1 - $limit1;

if($start1 <0) $start1 = 1; 

if(isset($_GET['sear']))
{
   
$SQL="SELECT id,username,email FROM trainerregistration WHERE username LIKE '%$_GET[sear]%' OR email LIKE '%$_GET[sear]%' ORDER BY $sidx1 $sord1 LIMIT $start1,$limit1";
    
 $result = mysql_query($SQL);
 
}    
else
{  
$SQL = "SELECT id,username,email FROM trainerregistration ORDER BY $sidx1 $sord1 LIMIT $start1 , $limit1";

$result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());
}
header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
$s .= "<page>" . $page1 . "</page>";
$s .= "<total>" . $total_pages . "</total>";
$s .= "<records>" . $count . "</records>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $s .= "<row id='" . $row['id'] . "'>";
    $s .= "<cell>" . $row['username'] . "</cell>";
    $s .= "<cell>" . $row['email'] . "</cell>";
    $s .= "</row>";
}
$s .= "</rows>";

echo $s;
?>
