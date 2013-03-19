<?php require_once 'include/template/header.php'; ?>
<html>
    <head>
        <script src="js/validationEngine/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/validationEngine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $(function() {
                $("#trainerregistration").validationEngine();
            }); </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#addtech").click(function(){
                    $("#addtechnology").slideDown('slow'); 
                }); 
            });
        </script>
    </head>
    <body bgcolor="ghostwhite">

        <br> <br>
    <center>
        <h1> Trainer Registration </h1>
        <form action="registerbackend.php" method="post" id="trainerregistration">

            <table bgcolor="skyblue" width="300" height="150">

                <tr> <td>Trainer Name</td><td> <input type="text" name="name" id="name" class="validate[required]"> </td> </tr>

                <tr> <td>Password</td><td> <input type="password" name="password" id="password" class="validate[required]"> </td> </tr>

                <tr> <td>Email-Id</td><td> <input type="text" name="email" id="email" class="validate[required,custom[email]]"> </td> </tr>

                <tr> <td> </td><td> <input type="submit" value="Register">  </td></tr>

        </form>
    </table>
</center>  
</body>
</html>
