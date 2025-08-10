<?php
// proses_reset.php (versi baru dengan OTP)
session_start();
require __DIR__ . '/config/koneksi.php'; // karena config ada di admin/config
require __DIR__ . '/otp_lib.php';        // karena otp_lib.php ada di folder yang sama (admin)

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: reset_password.php');
    exit;
}

// Pastikan sesi reset tersedia (ditetapkan saat kirim_otp.php)
if (!isset($_SESSION['reset_user_id'], $_SESSION['reset_username'])) {
    echo "<script>alert('Sesi reset tidak ditemukan. Minta OTP lagi.');window.location='reset_password.php';</script>";
    exit;
}

$userId   = (int)$_SESSION['reset_user_id'];
$username = $_SESSION['reset_username'];

$otpInput     = trim($_POST['otp'] ?? '');
$new_password = $_POST['new_password'] ?? '';

// Validasi dasar password baru
if (strlen($new_password) < 8) {
    echo "<script>alert('Password baru minimal 8 karakter.');window.location='reset_password.php?step=verify';</script>";
    exit;
}

// Verifikasi OTP
list($ok, $msg) = verifyResetOtp($koneksi, $userId, $otpInput, 5);
if (!$ok) {
    echo "<script>alert('".$msg."');window.location='reset_password.php?step=verify';</script>";
    exit;
}

// OTP valid → update password
$newHash = password_hash($new_password, PASSWORD_DEFAULT);
$stmt = $koneksi->prepare("UPDATE tbl_user SET password = ? WHERE id_user = ?");
$stmt->bind_param("si", $newHash, $userId);

if ($stmt->execute()) {
    // bersihkan sesi reset
    unset($_SESSION['reset_user_id'], $_SESSION['reset_username']);

    echo "<script>alert('Password berhasil direset! Silakan login.');window.location='login.php';</script>";
} else {
    echo "Update error: " . $koneksi->error;
}
