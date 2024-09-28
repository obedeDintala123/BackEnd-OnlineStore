<?php
ob_start();  // Inicia o buffer de saída
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'index.php' ; 

try {

    $sql = "SELECT * FROM produtos";
    $stmt = $conexao->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produtos);

} catch (PDOException $e) {

    echo json_encode(['error' => $e->getMessage()]);

}

ob_end_flush();  // Envia o buffer de saída e limpa
?>