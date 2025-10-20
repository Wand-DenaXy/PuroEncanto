<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username = 'pedrofp0711@gmail.com'; 
    $mail->Password = 'vpys iqom wmlv gigr';  
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

   
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('pedrofp0711@gmail.com'); 

    $mail->isHTML(true);
    $mail->Subject = 'Nova mensagem do site Puro Encanto';
    $mail->Body    = '
        <h3>Nova mensagem recebida</h3>
        <p><strong>Nome:</strong> ' . htmlspecialchars($_POST['name']) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($_POST['email']) . '</p>
        <p><strong>Telefone:</strong> ' . htmlspecialchars($_POST['phone']) . '</p>
        <p><strong>Mensagem:</strong><br>' . nl2br(htmlspecialchars($_POST['message'])) . '</p>
    ';

    $mail->send();
    echo '<script>alert("Mensagem enviada com sucesso!"); window.location.href="index.php#contact";</script>';
} catch (Exception $e) {
    echo '<script>alert("Erro ao enviar a mensagem: ' . $mail->ErrorInfo . '"); window.location.href="index.php#contact";</script>';
}
?>
