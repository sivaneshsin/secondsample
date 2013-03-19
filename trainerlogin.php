<?php require_once 'include/template/header.php'; ?>

<html>
    <head>

    </head>
    <body>

        <br> <br>
    <center>
        <h2> Trainer Login </h2>

        <?php
        $msg = $_GET['msg'];

        if ($msg != '')
            echo "<p id='error'>" . $msg . "</p>";
        ?>

        <form action="trainerlogin_check.php" method="post" id="trainerlogin">

            <table bgcolor="skyblue" width="300" height="150">

                <tr> <td>Username</td><td> <input type="text" name="name" id="name"> </td> </tr>

                <tr> <td>Password</td><td> <input type="password" name="password" id="password"> </td> </tr>

                <tr> <td> </td><td> <input type="submit" value="Login">   <a href="register.php"> Register </a></td></tr>
                   <tr><td><a href="forgetpassword.php"> ForgotPassword? </td> </tr>
        </form>
    </table>
</center>  
    
</body>
</html>

