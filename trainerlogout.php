<?php

session_start(); 
session_destroy(); 
header("location:trainerlogin.php?msg=Logged out")
?>
