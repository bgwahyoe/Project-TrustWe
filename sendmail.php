<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/usr/share/php/libphp-phpmailer/autoload.php';

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    
    $mail->isSMTP();
    $mail->Host       = 'mail.trustwe.my.id';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'admin@trustwe.my.id';
    $mail->Password   = 'bismillah';
    $mail->SMTPSecure = 'tls';
    $mail->AuthType   = 'LOGIN';
    $mail->Port       = 587;
    $mail->SMTPAutoTLS = true;
    $mail->AuthType   = 'PLAIN';


    $mail->setFrom('admin@trustwe.my.id', 'TrustWe Website');
    $mail->addAddress('admin@trustwe.my.id');
    $mail->addReplyTo($_POST['Email'] ?? 'admin@trustwe.my.id');

    $mail->Subject = "Pesan dari Website TrustWe";

    $body  = "Nama   : " . $_POST['Nama'] . "\n";
    $body .= "Subjek : " . $_POST['Subjek'] . "\n\n";
    $body .= "Pesan  : \n" . $_POST['Pesan'];

    $mail->Body = $body;

    $mail->send();

    echo "Pesan berhasil dikirim 🙂";

} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
?>