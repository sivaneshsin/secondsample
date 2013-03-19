<?php

$id=$_GET['pid'];

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz") or die("Error connecting to db.");

$SQL = "SELECT id,subcategory_name FROM subcategory where technology_id=$id";

$result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());

header("Content-type: text/xml;charset=utf-8");

$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .= "<rows>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $s .= "<row id='" . $row['id'] . "'>";
   $s .= "<cell>" . $row['subcategory_name'] . "</cell>";
   $s .= "</row>";
}
$s .= "</rows>";

echo $s;
?>
