<?php 
require('conexao.php');

$login = $_POST['login'];
$password = $_POST['password'];

$inactive = 600; 
ini_set('session.gc_maxlifetime', $inactive);
session_start();

if (isset($_SESSION['tries']) && (isset($_SESSION['expire'])) && (time() - $_SESSION['expire'] > $inactive)) {
    session_unset();
    session_destroy();
}
$_SESSION['expire'] = time();

$query = "SELECT * FROM users WHERE login = '$login' and password = '$password'";

try {
    if (!isset($_SESSION['tries']) || $_SESSION['tries'] < 3) {
        $result = mysqli_query($conexao, $query);
        
        $row = mysqli_num_rows($result);
        
        if ($row == 1){
            while($rowDTO = mysqli_fetch_array($result)) {
                CreateLoginSession($rowDTO);
                
                if ($rowDTO['first_access'] == 1) {
                    echo "success_first";
                    $_SESSION['first_access'] = 1;
                    $_SESSION['password'] = $rowDTO['password'];
                    return;
                }
                
                if ($rowDTO['permission'] == 0)
                echo "success_adm";

                
                if ($rowDTO['permission'] == 1)
                echo "success_atd";

                exit();
            }
        }
        else {
            echo "login error";
            if (isset($_SESSION['tries'])) {
                $_SESSION['tries']++; 
            } else { 
                $_SESSION['tries'] = 0;
            };
        }
    } else {
        $queryBlock = "UPDATE users SET blocked = 1 WHERE login = '$login'";
        mysqli_query($conexao, $queryBlock);
        echo "tries error";
    }
}
catch(Exception $e) {
    echo json_encode(
        array(
            'error' => array(
                'msg' => $e->getMessage(), 
                'code'=> $e->getCode())));
}
            
            
function CreateLoginSession($row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['full_name'] = $row['full_name'];
    $_SESSION['picture'] = $row['picture'] != null ? $row['picture'] : 'img/anon.jpg';
    $_SESSION['permission'] = $row['permission'];
}
            
?>