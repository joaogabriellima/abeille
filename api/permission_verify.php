<?php
if (isset($_SESSION['permission']) && $_SESSION['permission'] != 0)
header('Location: ../../abeille/index.php');


?>