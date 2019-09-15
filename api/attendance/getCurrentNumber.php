<?php

namespace Abeille;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../api/repository/attendanceRepository.php';

$attRepo = new AttendanceRepository();

http_response_code(200);
echo json_encode($attRepo->getCurrentNumber());

?>