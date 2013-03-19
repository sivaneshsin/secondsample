<?php

session_start();
require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query = "SELECT distinct name,SUM(correct) AS correct,SUM(wrong) as wrong FROM result WHERE id = $_SESSION[question_id_users] AND quiz_id = $_SESSION[quiz_id_users] Group by id";

$result = $db->db_query($query) or die(mysql_error());
//$data = array('cols' => array(array('label' => 'name', 'type' => 'string'),
//        array('label' => 'id', 'type' => 'number'),
//    ),
//    'rows' => array());

$data = array('cols' => array(array('label' => 'name', 'type' => 'string'),
        array('label' => 'id', 'type' => 'number'),
       ),
    'rows' => array());
$Correct_quiz = 0;
$Wrong_quiz = 0;

while ($row = mysql_fetch_array($result)) {
    $Correct_quiz = $row[correct] ;
    $Wrong_quiz = $row[wrong] ;
}

$data['rows'][] = array('c' => array(array('v' => "Correct"),array('v' => intval($Correct_quiz))));
$data['rows'][] = array('c' => array(array('v' => "Wrong"),array('v' => intval($Wrong_quiz))));

echo json_encode($data);
?>
