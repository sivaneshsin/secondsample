<?php

$id= $_GET['id'];

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz") or die("Error connecting to db.");


$SQL = "SELECT id,tname FROM technology WHERE type='$id'";


$result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());

echo "<select>";

echo "<option> Select </option>";

while ($row = mysql_fetch_row($result, MYSQL_ASSOC)) {
     
echo "<option value=$row[id] > $row[tname] </option>";
 }

 echo "</select>";

?>
