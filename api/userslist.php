<?php

include('api/permission_verify.php');

 $query = "SELECT u.id, u.full_name, u.login, u.cpf, u.phone, u.email, u.status, u.blocked, p.name 
 FROM users u INNER JOIN permission p ON u.permission = p.id
 WHERE u.id != 2";
 $result = mysqli_query($conexao, $query);
 
 while($row = mysqli_fetch_array($result))
 {
     if ($row['status'] == 1) {
         $status = "Ativo";
     }
     else {
         $status = "Inativo";
     }
     
     if ($row['blocked'] == 1) {
         $blocked = "Sim";
     }
     else {
         $blocked = "Não";
     }
     
     echo "<tr>";
     echo "<td>".$row['full_name']."</td>";
     echo "<td>".$row['login']."</td>";
     echo "<td>".$row['name']."</td>";
     echo "<td>".$row['cpf']."</td>";
     echo "<td>".$row['phone']."</td>";
     echo "<td>".$row['email']."</td>";
     echo "<td>".$blocked."</td>";
     echo "<td>".$status."</td>";
     echo "<td><a href='#' class='editUserButton' data-id='".$row['id']."'>Editar</a></td>";
     echo "<td><a href='#' class='deleteUserButton text-danger' data-id='".$row['id']."'><i class='fas fa-trash-alt'></i></a></td>";
     echo "</tr>";
 }

?>