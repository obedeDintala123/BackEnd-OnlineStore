<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'index.php';

try {
    $sql = 'SELECT * FROM clientes';
    $stmt = $conexao->query($sql);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clientes);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
