<?php

include_once('login_verify.php');
include('permission_verify.php');
include_once('conexao.php');

$id = $_POST['id'];

try {
    $stmt = mysqli_prepare($conexao, "UPDATE users SET blocked = 0 WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    

    if ($id == $_SESSION['id'])
        include_once('refresh_session.php');

    $response_array['status'] = 'success';
    header('Content-type: application/json');
    echo json_encode($response_array);
}
catch(Exception $e) {
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