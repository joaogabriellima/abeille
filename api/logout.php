<?php
include('api/login_verify.php');

session_start();
session_destroy();

header('Location: ../login.php');
?>