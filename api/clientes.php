<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'index.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"), true);

        $email = trim(htmlspecialchars($data['email'] ?? ''));

        $password = trim(htmlspecialchars($data['password'] ?? ''));

        if (!empty($email) || !empty($password)) {
            $sql = 'SELECT * FROM clientes WHERE email = :codeOne';
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":codeOne", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["password"])) {
                echo json_encode(["sucess" => true]);
            } else {
                echo json_encode(["sucess" => false, "message" => "Email ou password incorrect"]);
            }
        } else {
            echo json_encode(["sucess" => false, "message" => "Email ou password não foram preenchidos"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
