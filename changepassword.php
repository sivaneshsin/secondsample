<?php require_once 'include/template/header.php'; ?>
<html>
    <head>
        <script src="js/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $(function() {
                $("#changepassword").validationEngine();
            }); </script>

    </head>
    <body>

        <?php
        session_start();
        $a = $_SESSION['name'];
        ?>
        <br> <br>
    <center>
        <h1> Change Password </h1>
        <form action="changebackend.php" method="post" id="changepassword">

            <table bgcolor="skyblue" width="300" height="150">

                <tr> <td>Old Password</td><td> <input type="password" name="opassword" id="name" class="validate[required]"> </td> </tr>

                <tr> <td>New Password</td><td> <input type="password" name="npassword" id="password" class="validate[required]"> </td> </tr>

                <tr> <td></td><td> <input type="hidden" name="name" value="<?php echo $a; ?>" id="name" class="validate[required]"> </td> </tr>

                <tr> <td> </td><td> <input type="submit" value="Submit">  </td></tr>
</table>
        </form>
    
</center>  
</body>
</html>
