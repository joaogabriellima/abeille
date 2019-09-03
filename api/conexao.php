<?php 

define('HOST', 'localhost');
define('USUARIO', 'root');
define('SERVIDOR', '');
define('DB', 'abeille');


$conexao = mysqli_connect(HOST, USUARIO, SERVIDOR, DB) or die ('Unable to connect to server');

?>