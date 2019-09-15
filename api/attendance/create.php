<?php

namespace Abeille;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../api/repository/attendanceRepository.php';

$attRepo = new AttendanceRepository();
$res = array(
    'Attendance' => $attRepo->create(),
    'Analytics' => $attRepo->getCurrentNumber()
);
echo json_encode($res);

?>