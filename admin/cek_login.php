<?php
session_start();
include "config/koneksi.php";

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password']; // jangan di-hash langsung

$query = "SELECT * FROM tbl_user WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_array($result);

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    header('location: admin.php');
} else {
    echo "<script>
            alert('Maaf, Login GAGAL! Pastikan username dan password Anda benar.');
            document.location='login.php';
          </script>";
}
?>
