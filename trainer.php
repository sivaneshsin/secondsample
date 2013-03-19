<?php require_once 'include/template/header.php'; ?>

    <?php

session_start();

if(!isset($_SESSION['name']))
{
    header("location:trainerlogin.php");
}

?>
    
<?php
require_once 'Database.php';

require_once 'include/config.php';

$db = new Database();

$db->db_connection($config);

$query = "SELECT * FROM technology ORDER BY tname";

$result = $db->db_query($query);
?>

<html>
    <head>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>   
        <script type="text/javascript">
            $(function() {
                $("#conductquiz").validationEngine();
            }); </script>
    
    </head>
    <body>

        <div id="sessionname">

            <b> <?php echo "welcome :" . " " . $_SESSION['name']; ?>

                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;

                <a href="trainerlogout.php"> Logout </a>

        </div>
        <br>

        <div id="content">

            <table border="3" padding="10"> 

                <tr> <td> <h2>  <a id="quizlink" href="conductquizdetailsgrid.php">Conduct Quiz </a> </h2> </td>  

                </tr>
                
            </table>

        </div>
    </body>
</html>

