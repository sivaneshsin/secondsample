<?php

$id= $_GET['id'];

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz") or die("Error connecting to db.");

if($id==0)
{
    $SQL = "SELECT id,subcategory_name,technology_id FROM subcategory";
}    

else
{
$SQL = "SELECT id,subcategory_name,technology_id FROM subcategory WHERE technology_id='$id'"; }

$result = mysql_query($SQL) or die("Couldn't execute query." . mysql_error());

echo "<select>";

 echo "<option value='0'> Select </option>";

while ($row = mysql_fetch_row($result,MYSQL_ASSOC))
                
{
    
    echo "<option value=$row[subcategory_name]> $row[subcategory_name] </option>";

  
}
echo "</select>";
?>
