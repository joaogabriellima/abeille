<?php 
include('login_verify.php');
include('permission_verify.php');
require('conexao.php');

$id = $_POST['id'];
$query = "SELECT * FROM users WHERE id = '$id'";

try {
    $result = mysqli_query($conexao, $query);      
    $row = mysqli_num_rows($result);
    
    if ($row == 1){
        echo json_encode(mysqli_fetch_array($result));
        return;
    }
}
catch(Exception $e) {
    echo json_encode(
        array(
            'error' => array(
                'msg' => $e->getMessage(), 
                'code'=> $e->getCode())));
            }
?>