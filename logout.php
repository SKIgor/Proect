<?php
unset($_SESSION['session_username']);
session_destroy();
header("location:login.php");
?>