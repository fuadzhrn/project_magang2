<?php
// Test untuk URL bermasalah
echo "<h1>URL Decoding Test</h1>";

// URL asli
$original_url = "https://magangpln.id/permintaaan_srt/hasil-pengajuan.php?nomor_surat=387.3%2FK.7%2FIBKN%2FVIII%2F2025&nama_pengirim=%09Viona&asal_instansi=Institut+Bisnis+dan+Keuangan+Nitro";

echo "<h2>Original URL:</h2>";
echo "<p>" . htmlspecialchars($original_url) . "</p>";

echo "<h2>GET Parameters (if any):</h2>";
if (!empty($_GET)) {
    foreach ($_GET as $key => $value) {
        echo "<p><strong>$key:</strong> " . htmlspecialchars($value) . "</p>";
        echo "<p><strong>$key (decoded):</strong> " . htmlspecialchars(urldecode($value)) . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No GET parameters found</p>";
}

echo "<h2>Test Links:</h2>";
echo "<ul>";
echo "<li><a href='permintaaan_srt/hasil-pengajuan.php?nomor_surat=" . urlencode("387.3/K.7/IBKN/VIII/2025") . "&nama_pengirim=" . urlencode("Viona") . "&asal_instansi=" . urlencode("Institut Bisnis dan Keuangan Nitro") . "'>Test URL (properly encoded)</a></li>";
echo "<li><a href='permintaaan_srt/hasil-pengajuan.php?nomor_surat=25/05/8&nama_pengirim=MUH%20FUAD%20ZAHRAN&asal_instansi=UNIVERSITAS%20NEGERI%20MAKASSAR'>Test with known data</a></li>";
echo "</ul>";

// Test database connection
echo "<h2>Database Test:</h2>";
if (file_exists("admin/config/koneksi.php")) {
    include "admin/config/koneksi.php";
    if ($koneksi) {
        echo "<p style='color:green'>Database connected successfully</p>";
        
        // Check if table exists and has data
        $result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM balasan_surat");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo "<p>Total records in balasan_surat: " . $row['total'] . "</p>";
        }
    } else {
        echo "<p style='color:red'>Database connection failed</p>";
    }
} else {
    echo "<p style='color:red'>Config file not found</p>";
}
?>