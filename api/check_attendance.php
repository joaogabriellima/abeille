<?php
if (isset($_SESSION['attendance_on_progress']) && $_SESSION['attendance_on_progress'] == true) {
    header('Location: ../../abeille/attendance.php');
}


?>