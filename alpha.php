<?php
require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$type = $_POST['type'];

if ($type == "Technical") {

    $query = "INSERT INTO sample(id,quizdate,type) VALUES ('','$_POST[date]','$_POST[type]')";

    $db->db_query($query);

    $id = mysql_insert_id();

    $query = "SELECT year(quizdate) AS year FROM sample WHERE id=$id";

    $result = $db->db_query($query);

    $da = mysql_fetch_array($result);

    $re = substr($type, 0, 1);

    $quiznumber = (string) $da['year'] . $re . "00" . $id;

    echo $quiznumber;
    exit;
} else {

    $query = "INSERT INTO sample1(id,quizdate,type) VALUES ('','$_POST[date]','$_POST[type]')";

    $db->db_query($query);

    $id = mysql_insert_id();

    $query = "SELECT year(quizdate) AS year FROM sample1 WHERE id=$id";

    $result = $db->db_query($query);

    $da = mysql_fetch_array($result);

    $re = substr($type, 0, 1);

    $quiznumber = (string) $da['year'] . $re . "00" . $id;

    echo $quiznumber;
    exit;
}
?>

"<label> Option2 </label> <input type='radio'name='option2' value='option2' id='option2'/>&nbsp;&nbsp;&nbsp;"+
"<label> Option3 </label> <input type='radio'name='option3' value='option3' id='option3'/>&nbsp;&nbsp;&nbsp;"+
"<label> Option4 </label> <input type='radio'name='option4' value='option4' id='option4'/>&nbsp;&nbsp;&nbsp;";


{custom_element:function(value,options)
{
alert(options.id);
var radiobutton = '<input type="radio",name="option1" value="option1" id="option"/>'+
'<input type="radio",name="option2" value="option2" id="option"/>';   
return radiobutton;
},custom_value: function(elem){

//var inputs=$("#input",elem[0]);
var $selRadio = $('input[name=option1]:checked'),$tr;

return elem.val();

}}