<?php require_once 'include/template/header.php'; ?>
<html>
    <head>
        <script src="js/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $(function() {
                $("#forgetpassword").validationEngine();
            }); </script>

    </head>
    <body>

        <br> <br>
    <center>
        <h1> Forgot Password </h1>
        <form action="forgetpasswordbackend.php" method="post" id="forgetpassword">

            <table bgcolor="skyblue" width="300" height="150">

                <tr> <td>Username</td><td> <input type="text" name="username" id="username" class="validate[required]"> </td> </tr>

                <tr> <td>EmailId</td><td> <input type="text" name="email" id="email" class="validate[required,custom[email]"> </td> </tr>

                <tr> <td> </td><td> <input type="submit" value="Submit">  </td></tr>

        </form>
    </table>
</center>  
</body>
</html>
