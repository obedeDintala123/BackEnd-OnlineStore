<?php
include 'index.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $search = trim(htmlspecialchars($_POST['search']));
        $sql = "SELECT * FROM produtos WHERE nome LIKE :s";
        $stmt = $conexao->prepare($sql);
        $stmt->execute(['s' => '%' . $search . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
