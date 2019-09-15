<?php

namespace Abeille;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../api/repository/attendanceRepository.php';

if (isset($_GET['id'])) {
    $attRepo = new AttendanceRepository();

    http_response_code(200);
    echo json_encode($attRepo->getStatus($_GET['id']));
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Id is a mandatory parameter.'));
}

?>