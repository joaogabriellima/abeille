<?php 
session_start();
require('conexao.php');

$login = $_POST['login'];
$password = $_POST['password'];

$query = "SELECT * FROM attendant WHERE login = '$login' and password = '$password'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1){
    $_SESSION['login'] = $login;
    echo "success";
    exit();
} else {
    throw new Exception('Deu xabu nessa caraia!');
}

?>