<?php
if (isset($_SESSION['permission']) && $_SESSION['permission'] != 1)
    header('Location: ../../abeille/index.php');


?>