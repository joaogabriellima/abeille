<?php 

include('login_verify.php');
include('conexao.php');

$userLogin = $_SESSION['id'];

try {
    if (mysqli_num_rows(CheckAttendance()) == 0) {
        throw new Exception("Não existem atendimentos na fila nesse momento!");
    }
    
    if (VerifyDoubleAttendance() >= 1){
        throw new Exception("Não é permitido realizar dois atendimentos simultâneos");
    }
    
    if (!isset($_SESSION['id']) || $userLogin == null) {
        throw new Exception("Falha ao coletar dados do atendente");
    }
    
    StartAttendance();
    
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

function CheckAttendance() {
    global $conexao;
    $queryVerify = "SELECT id as id FROM attendance WHERE id_user IS null AND status = 1 order by created_at, queue_number LIMIT 1";
    return mysqli_query($conexao, $queryVerify);
}

function VerifyDoubleAttendance() {
    global $conexao;
    global $userLogin;
    $queryVerifyUser = "SELECT * FROM attendance WHERE id_user = $userLogin AND status = 2";
    $resultVerifyUser = mysqli_query($conexao, $queryVerifyUser);
    return mysqli_num_rows($resultVerifyUser);
}

function StartAttendance() {
    global $conexao;
    global $userLogin;
    $data = mysqli_fetch_assoc(CheckAttendance());
    $attendanceId = $data['id'];
    $preDate = new DateTime();
    $start_date = $preDate->format('Y-m-d H:i:sP');

    $_SESSION['attendance_on_progress'] = true;
    $_SESSION['attendance_start_time'] = $preDate;
    $_SESSION['attendance_id'] = $attendanceId;
    
    $updateQuery = "UPDATE attendance SET id_user = $userLogin, status = 2, start_time = '$start_date' WHERE id = $attendanceId";
    $result = mysqli_query($conexao, $updateQuery);
    
    CreateAttendanceSession($result);
}


?>