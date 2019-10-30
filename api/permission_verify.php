<?php

if (isset($_SESSION['permission']) && $_SESSION['permission'] != 1 && (!isset($_POST['id']) || $_POST['id'] != $_SESSION['id']))
    header('Location: ../../abeille/index.php');

?>