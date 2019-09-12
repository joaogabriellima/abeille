<?php 
require('conexao.php');
session_start();

$password = $_POST['oldpass'];
$new_password = $_POST['newpass'];
$repeat_password = $_POST['repeat_pass'];
$id = $_SESSION['id'];

if ($password != $_SESSION['password']) {
    echo "wrong_password";
    return;
}

unset($_SESSION['password']);
unset($_SESSION['first_access']);
$query = "UPDATE users SET password = '$new_password', first_access = 0 WHERE id = '$id'";
$result = mysqli_query($conexao, $query);
echo "success";
exit();


function CreateLoginSession($row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['permission'] = $row['permission'];
}
?>