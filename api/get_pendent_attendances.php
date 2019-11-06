<?php

include('login_verify.php');
include_once('conexao.php');

$stmt = mysqli_prepare($conexao, "SELECT * FROM attendance WHERE status = 1");
$stmt->execute();
$stmt->store_result();
echo $stmt->num_rows;

?>