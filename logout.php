<?php

session_start();
session_destroy();
header("location:Adminlogin.php?msg=Logged out")
?>
