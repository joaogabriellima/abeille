<?php 
include('login_verify.php');
include('check_attendance.php');
include_once('conexao.php');

try {
    UpdateAttendanceInformation();
    DestroyAttendanceSessions();
    
    $response_array['status'] = 'success';
    http_response_code(200);
    header('Content-type: application/json');
    echo json_encode($response_array);
}
catch(Exception $e) {
    $response_array['status'] = 'error';
    $response_array['error'] = array('msg' => $e->getMessage(),'code' => $e->getCode());
    http_response_code(500);
    header('Content-type: application/json');
    
    echo json_encode($response_array);
}


function UpdateAttendanceInformation() {
    global $conexao;
    $attendanceId = isset($_SESSION['attendance_id']) ? $_SESSION['attendance_id'] : 0;
    
    $getDateQuery = "SELECT TIME_TO_SEC(TIMEDIFF(now(), start_time)) as total_time FROM attendance WHERE id = $attendanceId";
    $resultDate = mysqli_query($conexao, $getDateQuery);
    $dateObject = mysqli_fetch_assoc($resultDate);
    $total_time = round($dateObject["total_time"]);
    
    $updateAttendanceQuery = "UPDATE attendance SET status = 3, end_time = NOW(), total_time = $total_time WHERE id = $attendanceId";
    $result = mysqli_query($conexao, $updateAttendanceQuery);
}

function DestroyAttendanceSessions() {
    unset($_SESSION['attendance_on_progress']);
    unset($_SESSION['attendance_id']);
}

?>