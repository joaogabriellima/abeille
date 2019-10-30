<?php
session_start();

if (!$_SESSION['login'] && (!isset($_POST['id']) || $_POST['id'] != $_SESSION['id']))
    header('Location: ../../abeille/login.html');

?>