<?php 
include('login_verify.php');
include('permission_verify.php');
include_once('conexao.php');

$id = $_POST['id'];
$query = "SELECT * FROM users WHERE id = '$id'";

try {
    $result = mysqli_query($conexao, $query);      
    $row = mysqli_num_rows($result);
    
    if ($row == 1){
        $resArray = mysqli_fetch_array($result);
        $resArray['picture'] = $resArray['picture'] != null ? str_replace(' ', '+', $resArray['picture']) : null;
        echo json_encode($resArray);
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