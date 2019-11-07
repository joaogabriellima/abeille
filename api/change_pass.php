<?php 
include_once('conexao.php');
include('login_verify.php');
include('check_attendance.php');

$password = $_POST['oldpass'];
$new_password = $_POST['newpass'];
$repeat_password = $_POST['repeat_pass'];
$first_access = 0;
$id = $_SESSION['id'];

if ($password != $_SESSION['password']) {
    echo "wrong_password";
    return;
}

try {
    unset($_SESSION['password']);
    unset($_SESSION['first_access']);

    $stmt = mysqli_prepare($conexao, "UPDATE users SET password = ?, first_access = ? WHERE id = ?");
    $stmt->bind_param('sss', $new_password, $first_access, $id);
    $stmt->execute();
    
    // $permissionquery = "SELECT permission as permission FROM users WHERE id = $id";
    // $permissionresult = mysqli_query($conexao, $permissionquery);
    // $data = mysqli_fetch_assoc($permissionresult);
    
    echo $data['permission'];
}
catch(Exception $e) {
    echo json_encode(array('error' => array('msg' => $e->getMessage(), 'code' => $e->getCode(),),));
}

?>