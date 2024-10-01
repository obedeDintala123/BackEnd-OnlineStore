<?php
//conexão com o banco de dados
$dsn = 'mysql:host=autorack.proxy.rlwy.net;port=22243;dbname=railway';
$db_user = 'root';
$db_pass = 'PAENtdSOLYwfZhBfKQLBGByDldBuHhgJ';

try {
    $conexao = new PDO($dsn, $db_user, $db_pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão bem sucedida";
} catch (\Throwable $e) {
    echo "Erro de conexão:" . $e->getMessage();
}
