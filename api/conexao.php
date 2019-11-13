<?php 

define('HOST', '185.201.10.52');
define('USUARIO', 'u230629828_adm');
define('SERVIDOR', 'abeille');
define('DB', 'u230629828_abeille');


$conexao = mysqli_connect(HOST, USUARIO, SERVIDOR, DB) or die ('Unable to connect to server');

?>