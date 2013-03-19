<?php

require_once 'include/config.php';

require_once 'Database.php';

if($_POST['oper']=='add')
{   

$name = $_POST['subcategory_name'];

$id=$_GET['pid'];

$db = new Database();

$db->db_connection($config);

$query = "INSERT INTO subcategory(id,subcategory_name,technology_id) VALUES ('','$name',$id)";

$db->db_query($query);


}

if($_POST['oper']=='edit')
{
    
$row=$_POST['id'];    
    
$name = $_POST['subcategory_name'];

$id=$_GET['pid'];
    
$db = new Database();

$db->db_connection($config);

$query = "UPDATE subcategory SET subcategory_name='$name' WHERE id=$row";

echo $query;

$db->db_query($query);


    
}



if($_POST['oper']=='del')
{   
    
$row=$_POST['id'];    
    
$name = $_POST['subcategory_name'];

$db = new Database();

$db->db_connection($config);

$query = "DELETE FROM subcategory WHERE id=$row";

$db->db_query($query);

    
}

?>