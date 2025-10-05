<?php
// Test file untuk debugging hasil-pengajuan.php
include "admin/config/koneksi.php";

echo "<h1>Test Database Connection & Search</h1>";

// Test koneksi
if (!$koneksi) {
    echo "<p style='color:red'>ERROR: Database connection failed: " . mysqli_connect_error() . "</p>";
    exit;
} else {
    echo "<p style='color:green'>SUCCESS: Database connected successfully</p>";
}

// Test data yang ada di database
echo "<h2>Sample Data in Database:</h2>";
$query = "SELECT id, nomor_surat, nama_pengirim, asal_instansi FROM balasan_surat LIMIT 5";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<table border='1' style='border-collapse:collapse; width:100%'>";
    echo "<tr><th>ID</th><th>Nomor Surat</th><th>Nama Pengirim</th><th>Asal Instansi</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nomor_surat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama_pengirim']) . "</td>";
        echo "<td>" . htmlspecialchars($row['asal_instansi']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:red'>ERROR: " . mysqli_error($koneksi) . "</p>";
}

// Test dengan data yang ada
echo "<h2>Test Search URLs:</h2>";
echo "<ul>";
echo "<li><a href='permintaaan_srt/hasil-pengajuan.php?nomor_surat=25/05/8&nama_pengirim=MUH FUAD ZAHRAN&asal_instansi=UNIVERSITAS NEGERI MAKASSAR'>Test 1: Fuad's data</a></li>";
echo "<li><a href='permintaaan_srt/hasil-pengajuan.php?nomor_surat=424123523532&nama_pengirim=HANUM&asal_instansi=UNIVERSITAS NEGERI MAKASSAR'>Test 2: Hanum's data</a></li>";
echo "<li><a href='permintaaan_srt/hasil-pengajuan.php?nomor_surat=342343525&nama_pengirim=fsafeesfs&asal_instansi=dfawfw'>Test 3: Original failing URL</a></li>";
echo "</ul>";

mysqli_close($koneksi);
?>