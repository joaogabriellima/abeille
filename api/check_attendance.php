<?php
include_once('conexao.php');

if (isset($_SESSION['attendance_on_progress']) && $_SESSION['attendance_on_progress'] == true) {
    header('Location: ../../abeille/attendance.php');
    return;
}

$userId = $_SESSION['id'];

$query = "SELECT * FROM attendance WHERE id_user = $userId AND status = 2";
$result = mysqli_query($conexao, $query);
$result_parse = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

if ($rows > 0) {
    $_SESSION['attendance_on_progress'] = true;
    $_SESSION['attendance_id'] = $result_parse['id'];
    $_SESSION['attendance_start_time'] = $result_parse['attendance_start_time'];
    header('Location: ../../abeille/attendance.php');
}


?>