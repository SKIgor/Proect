<?php

session_start();
require_once("includes/connection.php");
require_once("model/User.php");
require_once("model/SQL.php");

if(isset($_SESSION["session_username"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: intropage.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Как с помощью PHP и MySQL создать систему регистрации и авторизации пользователей </title>
    <link href="style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.go-ogleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
</head>
<body>
