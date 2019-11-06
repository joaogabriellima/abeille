<?php 
include_once('conexao.php');
include('login_verify.php');
include('check_attendance.php');

$password = $_POST['oldpass'];
$new_password = $_POST['newpass'];
$repeat_password = $_POST['repeat_pass'];
$id = $_SESSION['id'];

if ($password != $_SESSION['password']) {
    echo "wrong_password";
    return;
}

try {
    unset($_SESSION['password']);
    unset($_SESSION['first_access']);
    $query = "UPDATE users SET password = '$new_password', first_access = 0 WHERE id = '$id'";
    $result = mysqli_query($conexao, $query);
    
    $permissionquery = "SELECT permission as permission FROM users WHERE id = {$id}";
    $permissionresult = mysqli_query($conexao, $permissionquery);
    $data = mysqli_fetch_assoc($permissionresult);
    
    echo $data['permission'];
    exit();
}
catch(Exception $e) {
    echo json_encode(array('error' => array('msg' => $e->getMessage(), 'code' => $e->getCode(),),));
}

function CreateLoginSession($row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['permission'] = $row['permission'];
}
?>