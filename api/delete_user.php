<?php 

include('login_verify.php');
include('permission_verify.php');
include_once('conexao.php');

try {
    $userId = $_POST['userid'];
    
    if ($userId == null) {
        echo "Erro ao coletar identificador";
        return;
    }
    
    $attendanceStmt = mysqli_prepare($conexao, "DELETE FROM attendance WHERE id_user = ?");
    $attendanceStmt->bind_param('s', $userId);
    $attendanceStmt->execute();

    $userStmt = mysqli_prepare($conexao, "DELETE FROM users WHERE id = ?");
    $userStmt->bind_param('s', $userId);
    $userStmt->execute();
    
    $response_array['status'] = 'success';
    http_response_code(200);
    header('Content-type: application/json');
    echo json_encode($response_array);
}
catch (Exception $e) {
    echo json_encode(
        array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
            )
        );
    }
    
    ?>