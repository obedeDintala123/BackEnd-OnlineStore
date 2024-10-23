<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = json_decode(file_get_contents('php://input'), true);

        if (!empty($data['userLoginEmail']) || !empty($data['userSignUpEmail'])) {

            $userLoginEmail = trim(htmlspecialchars($data['userLoginEmail']));
            $userSignUpEmail = trim(htmlspecialchars($data['userSignUpEmail']));
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ex: smtp.gmail.com
            $mail->SMTPAuth = true;
            $mail->Username = 'dintalaobede@gmail.com';
            $mail->Password = 'mouq bglv vczz zjac';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptação TLS
            $mail->Port = 587;

            // Remetente e destinatário
            $mail->setFrom('dintalaobede@gmail.com', 'OnlineStore');

            if ($userLoginEmail && !$userSignUpEmail) {
                $mail->addAddress($userLoginEmail, 'User');
            } else if ($userSignUpEmail && !$userLoginEmail) {
                $mail->addAddress($userSignUpEmail, 'User');
            } else {
                echo json_encode(['status' => false, 'message' => 'No email address']);
            }
            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Entrega do Produto';
            $mail->Body    = 'Obrigado por escolher-nos como a sua loja Online. O seu produto chega em 12/12/2024';
            $mail->AltBody = 'Este é o corpo do e-mail em texto plano para clientes que não suportam HTML';

            $mail->send();
            echo json_encode(['status' => true, 'message' => 'success']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Preencha todos os campos']);
        }
    }
} catch (Exception $e) {
    echo json_encode(['Error: ' => $mail->ErrorInfo]);
}
