<?php
session_start();

include('permission_verify.php');
include_once('conexao.php');o.php');

$id = $_POST['id'];
$login = $_POST['login'];
$pass = $_POST['password'];
$permission = isset($_POST['permission']) ? $_POST['permission'] : null;
$picture = $_POST['picture'];
$phone = $_POST['phone'];
$email = $_POST['email'];

try {
    $query = "UPDATE users SET login = '$login', password = '$pass',". ($permission != null ? " permission = '$permission'," : "") .
    " picture = '$picture', phone = '$phone', email = '$email' WHERE id = '$id'";
    
    mysqli_query($conexao, $query);

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