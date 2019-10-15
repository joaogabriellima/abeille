<?php

namespace Abeille;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../api/repository/attendanceRepository.php';

if (isset($_POST['id']) && isset($_POST['rating'])) {
    $attRepo = new AttendanceRepository();

    http_response_code(200);
    echo json_encode($attRepo->rate($_POST['id'], $_POST['rating']));
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Id and Rating is a mandatory parameter.'));
}
?>