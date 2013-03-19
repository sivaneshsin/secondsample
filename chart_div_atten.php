<?php
session_start();

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

//$query = "SELECT distinct name,count(name) as count from result Group by id";
//
//$query = "Select distinct name,count(name) as count from users where quiz_id_fk = '$_SESSION[quiz_id_users]'";
//
//    $result = $db->db_query($query);
//    
// $total=  mysql_num_rows($result);
// 

$query = "Select distinct name, (Select Count(*) from result B where B.quiz_id = A.quiz_id_fk and B.id = $_SESSION[question_id_users] and B.name=A.name) As value from users A where quiz_id_fk = $_SESSION[quiz_id_users]";

$result = $db->db_query($query) or die(mysql_error());
$data = array('cols' => array(array('label' => 'name', 'type' => 'string'),
        array('label' => 'id', 'type' => 'number'),
       ),
    'rows' => array());
//var_dump($data);
//echo '<pre>';
$attended = 0;
$notattended = 0;

while ($row = mysql_fetch_object($result))
    { 
if($row->value == 1)    
    $attended = $attended + 1;
else
    $notattended = $notattended + 1;
}
$data['rows'][] = array('c' => array(array('v' => "Attended"),array('v' => $attended)));
$data['rows'][] = array('c' => array(array('v' => "Not Attended"),array('v' => $notattended)));

echo json_encode($data);
?>
