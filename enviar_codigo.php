<?php
// ACTIVAR ERRORES DESDE EL INICIO
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CARGAR PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

echo "Iniciando envío de correo...<br>";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'a21100295@ceti.mx';
    $mail->Password = 'fpcbchvhktoivjwv'; // Asegúrate de que sea la contraseña generada en tu cuenta
    $mail->SMTPSecure = 'ssl'; // O 'tls' si cambias al puerto 587
    $mail->Port = 465;

    $mail->setFrom('a21100295@ceti.mx', 'Rodrigo');
    $mail->addAddress('rodrigoruiz241005@gmail.com', 'Destino');

    $mail->Subject = 'Código de Verificación';
    $mail->Body = 'Aquí va el contenido del correo';

    $mail->send();
    echo '✅ Correo enviado exitosamente';
} catch (Exception $e) {
    echo "❌ Error al enviar correo: {$mail->ErrorInfo}";
}


