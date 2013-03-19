<?php

require_once 'include/config.php';

require_once 'Database.php';

$name = $_POST['tname'];

$id = $_POST['id'];

$type = $_POST['type'];

$db = new Database();

$db->db_connection($config);

if ($_POST['oper'] == "add") {

    $query = "INSERT INTO technology(id,tname,type) VALUES ('','$name','$type')";

    $db->db_query($query);
}

if ($_POST['oper'] == "edit") {


    $query = "UPDATE technology  SET tname='$name',type='$type' WHERE id=$id";

    $db->db_query($query);
}

if ($_POST['oper'] == "del") {


    $query = "DELETE FROM technology  WHERE id=$id";

    $db->db_query($query);
}
?>

