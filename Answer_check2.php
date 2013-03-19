<?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query = "SELECT name,id,quiz_id,SUM(correct) AS correct FROM result Group by id";

$result = $db->db_query($query) or die(mysql_error());
$data = array('cols' => array(array('label' => 'name', 'type' => 'string'),
        array('label' => 'id', 'type' => 'number'),
        array('label' => 'quiz_id', 'type' => 'number'),
        array('label' => 'correct', 'type' => 'number')),
    'rows' => array());
//var_dump($data);
//echo '<pre>';
$key = 1;
while ($row = mysql_fetch_row($result)) {

    
    $data['rows'][] = array('c' => array(array('v' => "Q-".$row[1]),array('v'=>$key),array('v' => $row[2]), array('v' => $row[3])));
    $key++;
}
echo json_encode($data);
?>
