<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test URL Problematic</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Test URL Decoding - PLN Magang</h1>
    
    <?php
    echo "<h2>Current GET Parameters:</h2>";
    if (!empty($_GET)) {
        echo "<pre>";
        foreach ($_GET as $key => $value) {
            echo "[$key] = " . htmlspecialchars($value) . "\n";
            echo "[$key] decoded = " . htmlspecialchars(urldecode($value)) . "\n\n";
        }
        echo "</pre>";
        
        // Test the same processing as hasil-pengajuan.php
        if (isset($_GET['nomor_surat']) && isset($_GET['nama_pengirim']) && isset($_GET['asal_instansi'])) {
            echo "<h2>Processed Parameters:</h2>";
            
            $nomor_surat = trim(urldecode($_GET['nomor_surat']));
            $nama_pengirim = trim(urldecode($_GET['nama_pengirim']));
            $asal_instansi = trim(urldecode($_GET['asal_instansi']));
            
            // Clean any extra whitespace characters
            $nomor_surat = preg_replace('/\s+/', ' ', $nomor_surat);
            $nama_pengirim = preg_replace('/\s+/', ' ', $nama_pengirim);
            $asal_instansi = preg_replace('/\s+/', ' ', $asal_instansi);
            
            echo "<pre>";
            echo "Nomor Surat: '" . htmlspecialchars($nomor_surat) . "'\n";
            echo "Nama Pengirim: '" . htmlspecialchars($nama_pengirim) . "'\n";
            echo "Asal Instansi: '" . htmlspecialchars($asal_instansi) . "'\n";
            echo "</pre>";
            
            // Check if empty after cleaning
            if (empty($nomor_surat) || empty($nama_pengirim) || empty($asal_instansi)) {
                echo "<p class='error'>❌ Some parameters are empty after cleaning!</p>";
            } else {
                echo "<p class='success'>✅ All parameters are valid after cleaning</p>";
                
                // Test database connection
                if (file_exists("admin/config/koneksi.php")) {
                    include "admin/config/koneksi.php";
                    if ($koneksi) {
                        echo "<p class='success'>✅ Database connected</p>";
                        
                        // Test query
                        $sql = "SELECT id, nomor_surat, nama_pengirim, asal_instansi FROM balasan_surat WHERE LOWER(TRIM(nomor_surat)) = LOWER(TRIM(?)) AND LOWER(TRIM(nama_pengirim)) = LOWER(TRIM(?)) AND LOWER(TRIM(asal_instansi)) = LOWER(TRIM(?)) LIMIT 1";
                        if ($stmt = mysqli_prepare($koneksi, $sql)) {
                            mysqli_stmt_bind_param($stmt, 'sss', $nomor_surat, $nama_pengirim, $asal_instansi);
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_bind_result($stmt, $id, $db_nomor, $db_nama, $db_instansi);
                                if (mysqli_stmt_fetch($stmt)) {
                                    echo "<p class='success'>✅ Data found in database!</p>";
                                    echo "<pre>";
                                    echo "ID: $id\n";
                                    echo "Nomor Surat: " . htmlspecialchars($db_nomor) . "\n";
                                    echo "Nama: " . htmlspecialchars($db_nama) . "\n";
                                    echo "Instansi: " . htmlspecialchars($db_instansi) . "\n";
                                    echo "</pre>";
                                } else {
                                    echo "<p class='error'>❌ No data found in database</p>";
                                }
                            } else {
                                echo "<p class='error'>❌ Query execution failed: " . mysqli_error($koneksi) . "</p>";
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "<p class='error'>❌ Query preparation failed: " . mysqli_error($koneksi) . "</p>";
                        }
                    } else {
                        echo "<p class='error'>❌ Database connection failed</p>";
                    }
                } else {
                    echo "<p class='error'>❌ Config file not found</p>";
                }
            }
        }
    } else {
        echo "<p class='info'>No GET parameters found. Try accessing with parameters:</p>";
        echo "<ul>";
        echo "<li><a href='?nomor_surat=387.3%2FK.7%2FIBKN%2FVIII%2F2025&nama_pengirim=%09Viona&asal_instansi=Institut+Bisnis+dan+Keuangan+Nitro'>Test problematic URL</a></li>";
        echo "<li><a href='?nomor_surat=25/05/8&nama_pengirim=MUH%20FUAD%20ZAHRAN&asal_instansi=UNIVERSITAS%20NEGERI%20MAKASSAR'>Test working URL</a></li>";
        echo "</ul>";
    }
    ?>
    
    <hr>
    <p><a href="permintaaan_srt/hasil-pengajuan.php<?php echo !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : ''; ?>">➡ Go to actual hasil-pengajuan.php</a></p>
</body>
</html>