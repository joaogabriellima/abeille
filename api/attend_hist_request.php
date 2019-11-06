<?php

include('login_verify.php');
include('permission_verify.php');
include_once('conexao.php');


$query = "SELECT * FROM attendance a INNER JOIN users u ON a.id_user = u.id INNER JOIN status s ON s.id = a.status";
$result = mysqli_query($conexao, $query);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

?>