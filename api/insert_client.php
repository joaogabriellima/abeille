<?php
require('conexao.php');


$nome = $_POST['full_name'];
$login = $_POST['login'];
$pass = $_POST['password'];
$permission = $_POST['permission'];
$picture = $_POST['picture'];
$cpf = $_POST['cpf'];
$phone = $_POST['phone'];
$email = $_POST['email'];




$query = "INSERT INTO users ('full_name', 'login', 'password', 'permission', 'first_access', 'picture', 'cpf', 'phone', 'email', 'blocked', 'status') 
VALUES ('$nome', '$login', '$pass', '$permission', 1, '$picture', '$cpf', '$phone', '$email', 0, 1)";

try {
    $result = mysqli_query($conexao, $query);
    echo "success";
}
catch(Exception $e) {

}

?>