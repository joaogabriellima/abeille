<?php
include('api/permission_verify.php');
require('conexao.php');

$id = $_PODT['id'];
$nome = $_POST['full_name'];
$login = $_POST['login'];
$cpf = $_POST['cpf'];
$pass = $_POST['password'];
$permission = $_POST['permission'];
$picture = $_POST['picture'];
$phone = $_POST['phone'];
$email = $_POST['email'];

try {
    $query = "UPDATE users SET full_name = '$nome', login = '$login', cpf = '$cpf', password = '$pass', permission = '$permission',
    picture = '$picture', phone = '$phone', email = '$email' WHERE id = '$id'";
    
    mysqli_query($conexao, $query);

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