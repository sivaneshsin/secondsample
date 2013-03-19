<?php

session_start();
if ($_GET['id']) {
    $_SESSION['quiz_id_users'] = $_GET['id'];
}
require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query = "SELECT name,id,quiz_id,SUM(correct) AS correct, SUM(wrong) AS wrong FROM result Group by id HAVING quiz_id= '$_SESSION[quiz_id_users]' ";

$result = $db->db_query($query) or die(mysql_error());

$data = array('cols' => array(array('label' => 'quiz_id', 'type' => 'number'),
        array('label' => 'correct', 'type' => 'number'),
        array('label' => 'wrong', 'type' => 'number')),
    'rows' => array());
$key = 1;
while ($row = mysql_fetch_row($result)) {
    $data['rows'][] = array('c' => array(array('v' => $key), array('v' => $row[3]), array('v' => $row[4])));

    $key++;
}
echo json_encode($data);
?>
