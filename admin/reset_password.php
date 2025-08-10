<!-- reset_password.php -->
<?php
session_start();
$step = ($_GET['step'] ?? '') === 'verify' && isset($_SESSION['reset_username'], $_SESSION['reset_user_id'])
    ? 'verify'
    : 'request';
$resetUsername = $_SESSION['reset_username'] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Reset Password</title>
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { display:flex; align-items:center; padding-top:40px; padding-bottom:40px; background:#f7f7f7; }
    .form-box { width:100%; max-width:420px; padding:15px; margin:auto; }
  </style>
</head>
<body>
  <div class="form-box bg-white p-4 rounded shadow-sm">
    <?php if ($step === 'request'): ?>
      <h3 class="mb-3 text-center">Reset Password</h3>
      <p class="text-muted text-center">Masukkan username untuk menerima OTP</p>
      <form method="post" action="kirim_otp.php">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <button class="btn btn-primary w-100" type="submit">Kirim OTP</button>
        <p class="mt-3 text-center"><a href="login.php">Kembali ke Login</a></p>
      </form>
    <?php else: ?>
      <h3 class="mb-3 text-center">Verifikasi OTP</h3>
      <p class="text-muted text-center">Masukkan OTP & password baru</p>
      <form method="post" action="proses_reset.php">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" value="<?php echo htmlspecialchars($resetUsername); ?>" disabled>
        </div>
        <div class="mb-3">
          <label class="form-label">Kode OTP</label>
          <input type="text" name="otp" class="form-control" placeholder="6 digit" minlength="6" maxlength="6" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Password Baru</label>
          <input type="password" id="new_password" name="new_password" class="form-control" required>
          <div class="form-text">Minimal 8 karakter (disarankan kombinasi huruf, angka, simbol)</div>
        </div>
        <button class="btn btn-success w-100" type="submit">Ubah Password</button>
        <p class="mt-3 text-center"><a href="reset_password.php">Kirim ulang OTP</a></p>
      </form>
    <?php endif; ?>
    <p class="mt-4 mb-0 text-muted text-center">&copy; 2025 | Fuad | UNM</p>
  </div>
</body>
</html>
