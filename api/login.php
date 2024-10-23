<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'index.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data['email']) && !empty($data['password'])) {

            $email = trim(htmlspecialchars($data['email']));
            $password = trim(htmlspecialchars($data['password']));

            $sql = 'SELECT * FROM clientes WHERE email = :email';
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user){
                if ($user && password_verify($password, $user["senha"])) {
                    echo json_encode(["success" => true, "message" => "Login successful"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Email or password incorrect"]);
                }
            }else{
                echo json_encode(["success" => false, "message" => "User not found!"]);
            }
            
        } else {
            echo json_encode(["success" => false, "message" => "Email or password not filled in"]);
        }
    }
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
