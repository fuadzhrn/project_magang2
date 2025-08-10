<?php
// otp_lib.php
if (!function_exists('getUserByUsername')) {
    function getUserByUsername(mysqli $koneksi, string $username): ?array {
        $stmt = $koneksi->prepare("SELECT id_user, username, password FROM tbl_user WHERE username = ?");
        if (!$stmt) die("SQL Error: " . $koneksi->error);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    }
}

if (!function_exists('createResetOtp')) {
    function createResetOtp(mysqli $koneksi, string $username, int $ttlSeconds = 600) {
        $user = getUserByUsername($koneksi, $username);
        if (!$user) return [false, "Username tidak ditemukan", null];

        // hapus token lama user agar satu yang aktif
        $stmtDel = $koneksi->prepare("DELETE FROM password_reset_tokens WHERE user_id = ?");
        $stmtDel->bind_param("i", $user['id_user']);
        $stmtDel->execute();

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpHash = password_hash($otp, PASSWORD_DEFAULT);
        $expiresAt = date('Y-m-d H:i:s', time() + $ttlSeconds);

        $stmtIns = $koneksi->prepare("INSERT INTO password_reset_tokens (user_id, otp_hash, expires_at) VALUES (?, ?, ?)");
        $stmtIns->bind_param("iss", $user['id_user'], $otpHash, $expiresAt);
        if (!$stmtIns->execute()) return [false, "Gagal menyimpan OTP: " . $koneksi->error, null];

        return [true, "OK", ['otp' => $otp, 'user' => $user, 'expires_at' => $expiresAt]];
    }
}

if (!function_exists('verifyResetOtp')) {
    function verifyResetOtp(mysqli $koneksi, int $userId, string $otpInput, int $maxAttempts = 5) {
        $stmt = $koneksi->prepare("
            SELECT id, otp_hash, expires_at, attempts 
            FROM password_reset_tokens 
            WHERE user_id = ? 
            ORDER BY id DESC LIMIT 1
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $tok = $stmt->get_result()->fetch_assoc();
        if (!$tok) return [false, "OTP tidak ditemukan. Minta OTP baru."];

        if ((int)$tok['attempts'] >= $maxAttempts) return [false, "Percobaan OTP terlalu banyak. Minta OTP baru."];
        if (strtotime($tok['expires_at']) < time()) return [false, "OTP kadaluarsa. Minta OTP baru."];

        if (!password_verify($otpInput, $tok['otp_hash'])) {
            $up = $koneksi->prepare("UPDATE password_reset_tokens SET attempts = attempts + 1 WHERE id = ?");
            $up->bind_param("i", $tok['id']);
            $up->execute();
            return [false, "OTP salah."];
        }

        // hapus token agar one‑time
        $del = $koneksi->prepare("DELETE FROM password_reset_tokens WHERE id = ?");
        $del->bind_param("i", $tok['id']);
        $del->execute();

        return [true, "OK"];
    }
}
