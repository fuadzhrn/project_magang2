<?php
$server   = "localhost";
$user     = "root";
$pass     = "";
$database = "pln_intership"; // misalnya pakai underscore

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
