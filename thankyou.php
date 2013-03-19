

<?php require_once 'include/template/header.php'; ?>

<?php 

$id=$_GET['id'];

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query="UPDATE quizdetails SET is_active=0 WHERE id='$id'";

$db->db_query($query);

?>

<html>
    <head>
        <link href="css/style.css" rel="stylesheet" media="all" type="text/css" />
    </head>

    <body>
        <div id="sessionname">

            <b> <?php session_start(); echo "welcome :" . " " . $_SESSION['name']; ?>

        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;

        <a href="trainerlogout.php"> Logout </a>

</div>
<br>
    <center>
        <br> 

        <img src="images/thankyou.jpeg" id="thankyou"/>

        <br>

         <a href="graph.php"> Quiz Performance </a> <br> <br>
        <a href="conductquizdetailsgrid.php"> Start New Quiz </a>
       

    </center>
    
</body>
</html>

