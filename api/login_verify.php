<?php
session_start();

if (!$_SESSION['login'])
header('Location: ../../abeille/login.html');


?>