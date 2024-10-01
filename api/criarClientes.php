<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
include 'index.php';

try {
   
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim(htmlspecialchars($_POST['nome']));
        $email = trim(htmlspecialchars($_POST['email']));
        $senha = trim(htmlspecialchars($_POST['senha']));
        $passwordHash = password_hash($senha, PASSWORD_DEFAULT);

        $checkEmail = "SELECT * FROM clientes WHERE email = :email";
        $emailColumn = $conexao->prepare($checkEmail);
        $emailColumn->bindParam(':email', $email);
        $emailColumn->execute();
        $emailExists = $emailColumn->fetchColumn();
        
        if($emailExists > 0) {
            echo json_encode(["message" => "Usuário já existente"]);
            exit;
        }
    
        $sql = "INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conexao->prepare($sql);
        $stmt -> bindParam(':nome', $nome);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':senha', $passwordHash);

        if($stmt -> execute()){
            echo json_encode(["message" => "Usuário adicionado com sucesso"]);
        }
        else{
            echo json_encode(["message" => "Erro ao adicionar usuários"]);
        }
   }
   
} catch (PDOException $e) {
    echo json_encode(["message" => "Erro SQL: " . $e->getMessage()]);
}

?>