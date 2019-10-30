<?php 
    include('login_verify.php');
    include('check_attendance.php');
    require('conexao.php');

    try {
        UpdateAttendanceInformation();

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
        $attendanceId = $_SESSION['attendance_id'];
        $preDate = new DateTime();
        $end_date = $preDate->format('Y-m-d H:i:sP');
        $start_date = $_SESSION['attendance_start_time']
        $diff = $preDate->date_diff($start_date);
        
        // echo $diff;
        // $total_time = $diff->m;

        // $updateAttendanceQuery = "UPDATE attendance SET status = 3, end_time = '$end_date', total_time = $total_time WHERE id = $attendanceId";
        // $result = mysqli_query($conexao, $updateAttendanceQuery);

        // DestroyAttendanceSessions();
    }

    function DestroyAttendanceSessions() {
        unset($_SESSION['attendance_on_progress']);
        unset($_SESSION['attendance_id']);
        unset($_SESSION['attendance_start_time']);
    }

?>