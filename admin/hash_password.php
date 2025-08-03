<?php
$password = "fuad"; // Ganti dengan password yang ingin di-hash
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password hash untuk 'fuad' adalah: <br>";
echo $hash;
?>
