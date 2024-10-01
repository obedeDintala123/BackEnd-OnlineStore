<?php
//conexão com o banco de dados
$dsn = 'mysql:dbname=teste;dbhost=localhost';
$db_user = 'root';
$db_pass = '';

try {
    $conexao = new PDO($dsn, $db_user, $db_pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão bem sucedida";
} catch (\Throwable $e) {
    echo "Erro de conexão:" . $e->getMessage();
}
