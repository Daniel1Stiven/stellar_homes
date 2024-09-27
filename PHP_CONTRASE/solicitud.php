<?php 

require ('./conectar.php');

require(__DIR__ . '/../PHPMailer/src/Exception.php');
require(__DIR__ . '/../PHPMailer/src/PHPMailer.php');
require(__DIR__ . '/../PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Email = $_POST['email'];

    $sql = "SELECT idCliente FROM clientes WHERE Email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email'=> $Email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $codigo = bin2hex(random_bytes(50));        
        
        $sql = "INSERT INTO password_resets (clientes_idCliente, CorreoElectronico, codigo) VALUES (:idCliente, :email, :codigo)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":idCliente", $result['idCliente']);
        $stmt->bindValue(":email", $Email);
        $stmt->bindValue(":codigo", $codigo);
        $stmt->execute();

        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'stellarhomes777@gmail.com'; 
        $mail->Password = 'tjyr fdsm ylep epuz'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $resetLink = "http://localhost/PRSH/PRSH/PHP_Contrase/restablecer_contra.php?codigo=" . $codigo;
        $subject = "Restablecer tu contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: " . $resetLink;

        $mail->setFrom('stellarhomes777@gmail.com', 'Stellar Homes');
        $mail->addAddress($Email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->CharSet = 'UTF-8';

        if ($mail->send()) {
            echo '<script> 
            alert("Hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.");
            window.location.href = "../iniciar Sesión.html";</script>';
        } else {
            echo "Hubo un error al enviar el correo. Inténtalo de nuevo.";
        }
    } else {
        echo "No se encontró ninguna cuenta con ese correo electrónico.";
    }
}
?>
