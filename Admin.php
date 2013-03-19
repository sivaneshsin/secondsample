
<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("location:Adminlogin.php");
}
?>

<?php require_once 'include/template/header.php'; ?>

<html>
    <head>      
        <script type="text/javascript" src="jqgrid/js/ui.datepicker.js"></script>


    </head>

    <body>
        <div id="sessionname">
              <b> <?php echo "welcome :" . " " . $_SESSION['name']; ?>
                &nbsp;&nbsp; 
                <a href="changepassword.php"> Changepassword </a>
                &nbsp;&nbsp;
                <a href="logout.php"> Logout </a>
        </div> 


    </body>
</html>

