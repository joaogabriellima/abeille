<?php 

include('login_verify.php');
include('permission_verify.php');
require('conexao.php');

try {
    $userId = $_POST['userid'];
    
    if ($userId == null) {
        echo "Erro ao coletar identificador";
        return;
    }
    
    $query = "DELETE FROM users WHERE id = '{$userId}'";
    
    mysqli_query($conexao, $query);
    
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