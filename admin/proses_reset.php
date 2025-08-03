<?php
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $old_password = $_POST['old_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Ambil user dari database
    $query = "SELECT * FROM tbl_user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        // Verifikasi password lama
        if (password_verify($old_password, $data['password'])) {
            // Jika cocok, update password
            $update = "UPDATE tbl_user SET password = '$new_password' WHERE username = '$username'";
            if (mysqli_query($koneksi, $update)) {
                echo "<script>alert('Password berhasil direset!'); window.location='login.php';</script>";
            } else {
                echo "Update error: " . mysqli_error($koneksi);
            }
        } else {
            echo "<script>alert('Password lama salah!'); window.location='reset_password.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan'); window.location='reset_password.php';</script>";
    }
}
?>
