<?php
include('./permission_verify.php');
include_once('conexao.php');

$nome = $_POST['full_name'];
$login = $_POST['login'];
$cpf = $_POST['cpf'];
$pass = $_POST['password'];
$permission = $_POST['permission'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$picture = $_POST['picture'];

$picture_format = str_replace('data:image/png;base64,', '', $picture);
$picture_format = str_replace(' ','+',$picture_format);

$first_access = 1;
$blocked = 0;
$status = 1;

try {
    $validationQuery = "SELECT * FROM users WHERE login = '$login' OR cpf = '$cpf'";
    $validationResult = mysqli_query($conexao, $validationQuery);
    $row = mysqli_num_rows($validationResult);
    
    if ($row != 0)
        throw new Exception("Já existe um usuário cadastrado com esses dados");
    
    $stmt = mysqli_prepare($conexao, "INSERT INTO users (full_name, login, password, permission, first_access, picture, cpf, phone, email, blocked, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('sssssssssss', $nome, $login, $pass, $permission, $first_access, $picture_format, $cpf, $phone, $email, $blocked, $status);
    $stmt->send_long_data(5, base64_decode($picture_format));

    mysqli_stmt_execute($stmt);

    $response_array['status'] = 'success';
    http_response_code(200);
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