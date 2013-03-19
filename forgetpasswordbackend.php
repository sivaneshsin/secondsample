123
    <?php

require_once 'include/config.php';

require_once 'Database.php';

$db = new Database();

$db->db_connection($config);

$query = "SELECT username,email,password FROM trainerregistration WHERE username='$_POST[username]' AND email='$_POST[email]'";

$result=$db->db_query($query);

$row=mysql_fetch_array($result);

$to=$row['email'];

$subject="Your Password";

$message="Hi  " . $row['username'] . ",". "\n\n" ."Your Password:".$row['password'];

mail($to,$subject,$message);    

header("Location:trainerlogin.php?msg=Password sent to your Mail!check your mail");

?>
