<?php

$db = mysql_connect("localhost", "root", "root") or die("Connection Error: " . mysql_error());

mysql_select_db("quiz", $db) or die("Error connecting to db.");

$query = "SELECT * FROM questiondetails WHERE is_active=1";

$result = mysql_query($query) or die("Couldn't execute query." . mysql_error());

$count = mysql_num_rows($result);



header("Content-type:application/xml;charset=utf-8");

$s .="<?xml version='1.0'?>";

if ($count == 0) {
    $s.="<row>" . "</row>";
}
 else {
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        $s.="<root>";
        
        $s .= "<row>" . $row['id'] . "</row>";
       
        $s.="<quiz_id>" . $row['quiz_id'] . "</quiz_id>";

        $s .= "<option1>" . $row['option1'] . "</option1>";

        $s .= "<option2>" . $row['option2'] . "</option2>";

        $s .= "<option3>" . $row['option3'] . "</option3>";

        $s .= "<option4>" . $row['option4'] . "</option4>";
        
        $s.="</root>";
        

    }
}

echo $s;
?>
 