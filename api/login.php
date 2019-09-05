<?php 
require('conexao.php');

$login = $_POST['login'];
$password = $_POST['password'];

$inactive = 30; 
ini_set('session.gc_maxlifetime', $inactive);
session_start();

// Quebro a sessão de tentativas após 10 minutos
if (isset($_SESSION['tries']) && (isset($_SESSION['expire'])) && (time() - $_SESSION['expire'] > $inactive)) {
    session_unset();
    session_destroy();
}
$_SESSION['expire'] = time();

$query = "SELECT * FROM users WHERE login = '$login' and password = '$password'";

if (!isset($_SESSION['tries']) || $_SESSION['tries'] < 3) {
    $result = mysqli_query($conexao, $query);
    
    $row = mysqli_num_rows($result);
    
    if ($row == 1){
        while($rowDTO = mysqli_fetch_array($result)) {
            CreateLoginSession($rowDTO);
            echo "success";

            if ($rowDTO['first_access'] == 1) {
                echo "_first";
                $_SESSION['password'] = $rowDTO['password'];
            }

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

function CreateLoginSession($row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['permission'] = $row['permission'];
}



?>