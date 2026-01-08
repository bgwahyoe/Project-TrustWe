<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/usr/share/php/libphp-phpmailer/autoload.php';

$mail = new PHPMailer(true);

try {
    // ⚠️ WAJIB - pastikan ini ada
    $mail->isMail();

    $mail->setFrom('no-reply@trustwe.my.id', 'TrustWe Website');
    $mail->addAddress('admin@trustwe.my.id', 'Admin TrustWe');

    $mail->Subject = 'Pesan baru dari website TrustWe';

    $body  = "Nama   : " . ($_POST['Nama'] ?? '') . "\n";
    $body .= "Subjek : " . ($_POST['Subjek'] ?? '') . "\n\n";
    $body .= "Pesan:\n" . ($_POST['Pesan'] ?? '') . "\n";

    $mail->Body = $body;

    $mail->send();

    echo "Pesan berhasil dikirim 🙂";
} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
