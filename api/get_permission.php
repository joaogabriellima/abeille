<?php

include('login_verify.php');
include('permission_verify.php');
include_once('conexao.php');


$query = "SELECT * FROM permission";
$result = mysqli_query($conexao, $query);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

?>