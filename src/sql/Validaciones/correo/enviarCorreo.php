<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_email']) && isset($data['user_name'])) {
        $tokenGenerado = enviarCorreo($data);
        echo json_encode(array('token' => $tokenGenerado));
    }else {
        echo json_encode(array('message' => 'No se recibieron los datos correctamente'));
    }
}
function enviarCorreo($data) {
    $user_email = $data['user_email'];
    $user_name = $data['user_name'];

    $your_email = 'party_nation@outlook.com';
    $your_password = 'partynation123';

    $subject = 'Nuevo mensaje de ' . $user_name;
    $message = 'Hola, has recibido un nuevo mensaje de ' . $user_name . ' (' . $user_email . ').';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = $your_email; 
        $mail->Password = $your_password; 
    
        $mail->setFrom($your_email);
        $mail->addAddress($user_email);
    
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
    
        $mail->send();
        return array('message' => 'El correo ha sido enviado correctamente');
    } catch (Exception $e) {
        return array('message' => 'Hubo un error al enviar el correo e: ' . $mail->ErrorInfo);
    }
}
?>