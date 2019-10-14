<?php
include('./permission_verify.php');
require('conexao.php');

$nome = $_POST['full_name'];
$login = $_POST['login'];
$cpf = $_POST['cpf'];
$pass = $_POST['password'];
$permission = $_POST['permission'];
$picture = $_POST['picture'];
$phone = $_POST['phone'];
$email = $_POST['email'];

try {
    $validationQuery = "SELECT * FROM users WHERE login = '$login' OR cpf = '$cpf'";
    $validationResult = mysqli_query($conexao, $validationQuery);
    $row = mysqli_num_rows($validationResult);
    
    if ($row != 0)
    throw new Exception("Já existe um usuário cadastrado com esses dados");
    
    $query = "INSERT INTO users ('full_name', 'login', 'password', 'permission', 'first_access', 'picture', 'cpf', 'phone', 'email', 'blocked', 'status') 
    VALUES ('$nome', '$login', '$pass', '$permission', 1, '$picture', '$cpf', '$phone', '$email', 0, 1)";
    
    mysqli_query($conexao, $query);

    $response_array['status'] = 'success';
    header('Content-type: application/json');
    // echo json_encode($response_array);
    echo "SUCESSO";
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