<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/usr/share/php/libphp-phpmailer/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$nama   = $_POST['Nama']   ?? '';
$subjek = $_POST['Subjek'] ?? '';
$pesan  = $_POST['Pesan']  ?? '';
$email  = $_POST['Email']  ?? ''; // kalau nanti kamu tambah field email

// Validasi sederhana
if (trim($nama) === '' || trim($subjek) === '' || trim($pesan) === '') {
    exit('Form tidak lengkap.');
}

$mail = new PHPMailer(true);

try {
    // 🟢 PAKAI MAIL LOCAL, BUKAN SMTP
    $mail->isMail(); // atau: $mail->isSendmail();

    // From & Tujuan
    $mail->setFrom('no-reply@trustwe.my.id', 'TrustWe Website');
    $mail->addAddress('admin@trustwe.my.id', 'Admin TrustWe');

    // Kalau kamu punya field email visitor, bisa dipakai sebagai reply-to:
    if (!empty($email)) {
        $mail->addReplyTo($email, $nama);
    }

    // Subjek
    $mail->Subject = 'Pesan dari Website TrustWe: ' . $subjek;

    // Isi email (plain text saja sudah cukup)
    $body  = "Ada pesan baru dari website TrustWe:\n\n";
    $body .= "Nama   : " . $nama . "\n";
    if (!empty($email)) {
        $body .= "Email  : " . $email . "\n";
    }
    $body .= "Subjek : " . $subjek . "\n\n";
    $body .= "Pesan:\n" . $pesan . "\n";

    $mail->Body    = $body;
    $mail->AltBody = $body; // fallback

    $mail->send();

    echo "Pesan berhasil dikirim 🙂";

} catch (Exception $e) {
    echo "Gagal mengirim email. Error: {$mail->ErrorInfo}";
}
