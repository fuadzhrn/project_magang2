<?php
// kirim_otp.php (FINAL: kirim OTP hanya ke email admin)
session_start();
require __DIR__ . '/config/koneksi.php';
require __DIR__ . '/otp_lib.php';

// ================== KONFIGURASI ==================
const ADMIN_EMAIL        = 'plnintership@gmail.com';   // Email admin penerima OTP
const GMAIL_USERNAME     = 'plnintership@gmail.com'; // GANTI: akun Gmail pengirim
const GMAIL_APP_PASSWORD = 'jespxlszwpqiitpn'; // GANTI: App Password Gmail
// ================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: reset_password.php');
    exit;
}

$username = trim($_POST['username'] ?? '');

// Anti-spam sederhana: jeda 60 detik
if (isset($_SESSION['last_send_otp']) && time() - $_SESSION['last_send_otp'] < 60) {
    echo "<script>alert('Tunggu 1 menit sebelum meminta OTP lagi');window.location='reset_password.php';</script>";
    exit;
}

// 1) Generate & simpan OTP
list($ok, $msg, $data) = createResetOtp($koneksi, $username, 600); // berlaku 10 menit
if (!$ok) {
    echo "<script>alert('".$msg."');window.location='reset_password.php';</script>";
    exit;
}

$otp       = $data['otp'];
$user      = $data['user'];      // {id_user, username}
$expiresAt = $data['expires_at'];

// 2) KIRIM EMAIL ke ADMIN_EMAIL via PHPMailer + Gmail SMTP
// --- Autoload PHPMailer ---
// (a) Composer (jika ada di D:\xammpp\htdocs\PLN\vendor)
$autoloadOk = false;
$composerAutoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($composerAutoload)) {
    require $composerAutoload;
    $autoloadOk = true;
} else {
    // (b) Manual include: sesuai struktur kamu -> admin/vendor/src/
    $base = __DIR__ . '/vendor/src';
    if (file_exists($base . '/PHPMailer.php') && file_exists($base . '/SMTP.php') && file_exists($base . '/Exception.php')) {
        require $base . '/PHPMailer.php';
        require $base . '/SMTP.php';
        require $base . '/Exception.php';
        $autoloadOk = true;
    }
}
if (!$autoloadOk) {
    echo "<script>
        alert('PHPMailer belum ditemukan. Letakkan file PHPMailer.php, SMTP.php, Exception.php di admin/vendor/src/');
        window.location='reset_password.php';
    </script>";
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = GMAIL_USERNAME;
    $mail->Password   = GMAIL_APP_PASSWORD; // APP PASSWORD Gmail (bukan password biasa)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // atau ENCRYPTION_SMTPS + Port 465
    $mail->Port       = 587;

    $mail->setFrom(GMAIL_USERNAME, 'PLN App (OTP)');
    $mail->addAddress(ADMIN_EMAIL); // hanya kirim ke email admin

    $mail->isHTML(false);
    $mail->Subject = 'OTP Reset Password (Approval Admin)';
    $mail->Body =
"Permintaan reset password terdeteksi.

User   : {$user['username']}
OTP    : {$otp}
Berlaku: {$expiresAt}

Jika Anda menyetujui, berikan OTP ini kepada user tersebut untuk melanjutkan reset password.";

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('Gagal mengirim email OTP ke admin: ".htmlspecialchars($e->getMessage(), ENT_QUOTES)."');window.location='reset_password.php';</script>";
    exit;
}

// 3) Simpan sesi untuk langkah verifikasi
$_SESSION['last_send_otp'] = time();
$_SESSION['reset_username'] = $user['username'];
$_SESSION['reset_user_id']  = (int)$user['id_user'];

// 4) Selesai → ke halaman input OTP + password baru
echo "<script>
alert('OTP telah dikirim ke administrator. Hubungi admin untuk mendapatkan kode OTP.');
window.location='reset_password.php?step=verify';
</script>";
