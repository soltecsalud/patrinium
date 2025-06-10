<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Si usas Composer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $para = $_POST['correo_destino'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.tu-servidor.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tu-correo@dominio.com';
        $mail->Password = 'tu-clave';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tu-correo@dominio.com', 'Tu Empresa');
        $mail->addAddress($para);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;

        $mail->send();
        echo json_encode(['ok' => true]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $mail->ErrorInfo]);
    }
}
?>