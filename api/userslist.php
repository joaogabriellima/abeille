<?php

include('permission_verify.php');
include_once('conexao.php');

$query = "SELECT u.id, u.full_name, u.login, u.cpf, u.phone, u.email, u.status, u.blocked, p.name 
FROM users u INNER JOIN permission p ON u.permission = p.id
WHERE u.id != 2";
$result = mysqli_query($conexao, $query);
echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

?>