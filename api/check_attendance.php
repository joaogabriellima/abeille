<?php
include_once('login_verify.php');
include_once('conexao.php');

if (isset($_SESSION['attendance_on_progress']) && $_SESSION['attendance_on_progress'] == true) {
    header('Location: ../../abeille/attendance.php');
    return;
}

$userId = $_SESSION['id'];

$stmt = mysqli_prepare($conexao, "SELECT * FROM attendance WHERE id_user = ? AND status = 2");
$stmt->bind_param('s', $userId);
$stmt->execute();
$stmt->store_result();

$rows = $stmt->num_rows;

if ($rows > 0) {
    $_SESSION['attendance_on_progress'] = true;
    $_SESSION['attendance_id'] = $result_parse['id'];
    $_SESSION['attendance_start_time'] = $result_parse['attendance_start_time'];
    header('Location: ../../abeille/attendance.php');
}


?>