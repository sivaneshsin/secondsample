
<?php  require_once 'include/template/header.php'; ?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>      
    <body>
        <br><br>
    <center>    
        <h2> Admin Login </h2>
        <?php
        $msg = $_GET['msg'];
        if ($msg != '')
            echo "<p id='error'>" . $msg . "</p>";
        ?>
        <form method="post" action="Adminlogin_check.php">
            <table bgcolor="skyblue" width="300" height="150">
                <tr>
                    <td> Admin  </td>
                    <td> <input type="text" name="admin" id="name"> </td> 
                </tr>
                <tr>
                    <td> Password </td>
                    <td> <input type="password" name="password"  id="password"> </td> 
                </tr>
                <tr> <td> </td><td> <input type="submit" value="Login"> </td> </tr>
            </table>   
        </form>
    </center>

</body>    
</html>

