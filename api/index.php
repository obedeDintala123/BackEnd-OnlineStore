<?php
//conexão com o banco de dados
$dsn = 'mysql:dbname=teste;dbhost=localhost';
$db_user = 'root';
$db_pass = '';

$conexao = new PDO($dsn, $db_user, $db_pass);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>