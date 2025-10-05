<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="            // 1) Try exact match first (case sensitive)evice-width, initial-scale=1.0">
    <!-- Ultra Modern Styling -->
    <link rel="stylesheet" href="../style/style-ultra-modern.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/data-modern-custom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/minimal-access.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/favicon.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../style/mobile-header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/mobile-optimizations.css?v=<?php echo time(); ?>">
    <title>Hasil Pengajuan - PLN UID Sulselrabar</title>
    
    <!-- Navigation Brand Link Fix -->
    <style>
        .nav-brand-link {
            text-decoration: none !important;
            color: inherit !important;
            transition: all 0.3s ease !important;
        }
        
        .nav-brand-link:hover {
            text-decoration: none !important;
            color: inherit !important;
        }
        
        .nav-brand-link:visited {
            text-decoration: none !important;
            color: inherit !important;
        }
        
        .nav-brand-link:focus {
            text-decoration: none !important;
            color: inherit !important;
            outline: none !important;
        }
    </style>
</head>
<body>
<?php
// Database connection and logic
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

include "../admin/config/koneksi.php";

// Initialize variables
$data = null;
$search_performed = false;
$error_message = "";
$suggestions = [];
$nomor_surat = "";
$nama_pengirim = "";
$asal_instansi = "";

// Helper: sanitize input
function sanitize_input($input) {
    return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
}

// Check database connection
if (!$koneksi) {
    $error_message = "Koneksi database gagal: " . mysqli_connect_error();
} else {
    
    // Check if form was submitted via GET
    if (isset($_GET['nomor_surat']) && isset($_GET['nama_pengirim']) && isset($_GET['asal_instansi']) &&
        trim($_GET['nomor_surat']) !== '' && trim($_GET['nama_pengirim']) !== '' && trim($_GET['asal_instansi']) !== '') {
        
        try {
            $search_performed = true;
            
            // Decode URL parameters properly and clean whitespace
            $nomor_surat = trim(urldecode($_GET['nomor_surat']));
            $nama_pengirim = trim(urldecode($_GET['nama_pengirim']));
            $asal_instansi = trim(urldecode($_GET['asal_instansi']));
            
            // Clean any extra whitespace characters (including tabs, newlines, etc)
            $nomor_surat = preg_replace('/\s+/', ' ', $nomor_surat);
            $nama_pengirim = preg_replace('/\s+/', ' ', $nama_pengirim);
            $asal_instansi = preg_replace('/\s+/', ' ', $asal_instansi);
            
            echo "<!-- Decoded Parameters: ";
            echo "nomor_surat: '" . $nomor_surat . "' | ";
            echo "nama_pengirim: '" . $nama_pengirim . "' | ";
            echo "asal_instansi: '" . $asal_instansi . "'";
            echo " -->";
        
        // 1) Try exact match first (case sensitive)
        $sqlExact = "SELECT id, nomor_surat, nama_pengirim, asal_instansi, file_pdf
                     FROM balasan_surat 
                     WHERE nomor_surat = ?
                     AND nama_pengirim = ?
                     AND asal_instansi = ?
                     LIMIT 1";
        
        if ($stmt = mysqli_prepare($koneksi, $sqlExact)) {
            mysqli_stmt_bind_param($stmt, 'sss', $nomor_surat, $nama_pengirim, $asal_instansi);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $r_id, $r_no, $r_nama, $r_instansi, $r_file);
                if (mysqli_stmt_fetch($stmt)) {
                    $data = [
                        'id' => $r_id,
                        'nomor_surat' => $r_no,
                        'nama_pengirim' => $r_nama,
                        'asal_instansi' => $r_instansi,
                        'file_pdf' => $r_file,
                    ];
                }
            } else {
                $error_message = "Error eksekusi query (exact): " . mysqli_error($koneksi);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Gagal menyiapkan query (exact): " . mysqli_error($koneksi);
        }
        
        // 1.5) If not found, try case-insensitive exact match
        if (!$data && empty($error_message)) {
            $sqlCaseInsensitive = "SELECT id, nomor_surat, nama_pengirim, asal_instansi, file_pdf
                                   FROM balasan_surat 
                                   WHERE LOWER(TRIM(nomor_surat)) = LOWER(TRIM(?))
                                   AND LOWER(TRIM(nama_pengirim)) = LOWER(TRIM(?))
                                   AND LOWER(TRIM(asal_instansi)) = LOWER(TRIM(?))
                                   LIMIT 1";
            
            if ($stmt = mysqli_prepare($koneksi, $sqlCaseInsensitive)) {
                mysqli_stmt_bind_param($stmt, 'sss', $nomor_surat, $nama_pengirim, $asal_instansi);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_bind_result($stmt, $r_id, $r_no, $r_nama, $r_instansi, $r_file);
                    if (mysqli_stmt_fetch($stmt)) {
                        $data = [
                            'id' => $r_id,
                            'nomor_surat' => $r_no,
                            'nama_pengirim' => $r_nama,
                            'asal_instansi' => $r_instansi,
                            'file_pdf' => $r_file,
                        ];
                    }
                } else {
                    $error_message = "Error eksekusi query (case insensitive): " . mysqli_error($koneksi);
                }
                mysqli_stmt_close($stmt);
            }
        }

        // 2) If not found, try LIKE matching for similar results
        if (!$data && empty($error_message)) {
            $sqlLike = "SELECT id, nomor_surat, nama_pengirim, asal_instansi, file_pdf
                        FROM balasan_surat
                        WHERE LOWER(nomor_surat) LIKE LOWER(CONCAT('%', ?, '%'))
                           OR LOWER(nama_pengirim) LIKE LOWER(CONCAT('%', ?, '%'))
                           OR LOWER(asal_instansi) LIKE LOWER(CONCAT('%', ?, '%'))
                        ORDER BY id DESC
                        LIMIT 5";
            
            if ($stmt2 = mysqli_prepare($koneksi, $sqlLike)) {
                mysqli_stmt_bind_param($stmt2, 'sss', $nomor_surat, $nama_pengirim, $asal_instansi);
                if (mysqli_stmt_execute($stmt2)) {
                    mysqli_stmt_bind_result($stmt2, $sid, $sno, $snama, $sinst, $sfile);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $suggestions[] = [
                            'id' => $sid,
                            'nomor_surat' => $sno,
                            'nama_pengirim' => $snama,
                            'asal_instansi' => $sinst,
                            'file_pdf' => $sfile
                        ];
                    }
                } else {
                    $error_message = "Error eksekusi query (like): " . mysqli_error($koneksi);
                }
                mysqli_stmt_close($stmt2);
            }
        }
        
        } catch (Exception $e) {
            $error_message = "Terjadi kesalahan dalam pencarian. Silakan coba lagi.";
        }
    }
}
?>

    <!-- Modern Navigation Header -->
    <header class="modern-header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="nav-brand-link">
                    <div class="nav-brand">
                        <img src="../img/favicon.png" alt="PLN Logo" class="nav-logo">
                        <div class="brand-text">
                            <h3>PLN UID</h3>
                            <span>Sulselrabar</span>
                        </div>
                    </div>
                </a>
                
                <ul class="nav-menu" id="nav-menu">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">
                            <i class="ri-home-3-line"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../data_mhs/data_mahasiswa.php" class="nav-link">
                            <i class="ri-database-2-line"></i>
                            <span>Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../permintaaan_srt/permintaan_srt.php" class="nav-link active">
                            <i class="ri-mail-line"></i>
                            <span>Permintaan Surat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../ulasan/ulasan.php" class="nav-link">
                            <i class="ri-information-2-line"></i>
                            <span>Ulasan</span>
                        </a>
                    </li>
                </ul>
                
                <div class="nav-toggle" id="nav-toggle">
                    <i class="ri-menu-3-line"></i>
                </div>
            </nav>
        </div>
    </header>
    <!-- Compact Header -->
    <main>
        <section class="compact-header" style="padding: 8rem 0 3rem;">
            <div class="container">
                <div class="page-header-content" data-aos="fade-up">
                    <!-- Breadcrumb -->
                    <nav class="breadcrumb-modern">
                        <a href="../index.php">
                            <i class="ri-home-3-line"></i>
                            Beranda
                        </a>
                        <span class="separator">
                            <i class="ri-arrow-right-s-line"></i>
                        </span>
                        <a href="../permintaaan_srt/permintaan_srt.php">
                            Permintaan Surat
                        </a>
                        <span class="separator">
                            <i class="ri-arrow-right-s-line"></i>
                        </span>
                        <span class="current">Hasil Pengajuan</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-file-check-line"></i>
                        <span>Hasil Status</span>
                    </div>
                    
                    <h1 class="page-title">Hasil Pengajuan Permohonan</h1>
                    <p class="page-subtitle">
                        Status dan hasil dari permintaan surat permohonan magang Anda
                    </p>
                </div>
            </div>
        </section>

        <!-- Result Section -->
        <section class="result-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="result-container" data-aos="fade-up">
                    <?php if (!empty($error_message)): ?>
                        <!-- Database Error -->
                        <div class="result-card error-card">
                            <div class="result-icon error-icon">
                                <i class="ri-error-warning-line"></i>
                            </div>
                            <div class="result-content">
                                <h2>Terjadi Kesalahan Sistem</h2>
                                <p><?= htmlspecialchars($error_message) ?></p>
                                <div class="result-actions">
                                    <a href="../permintaaan_srt/permintaan_srt.php" class="btn-primary">
                                        <i class="ri-arrow-left-line"></i>
                                        <span>Kembali ke Form</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($search_performed): ?>
                        <?php if ($data): ?>
                            <!-- Document Found -->
                            <div class="result-card success-card">
                                <div class="result-icon success-icon">
                                    <i class="ri-check-double-line"></i>
                                </div>
                                <div class="result-content">
                                    <h2>Dokumen Ditemukan!</h2>
                                    <p>Selamat! Dokumen hasil pengajuan permohonan magang Anda telah tersedia dan siap untuk diunduh.</p>
                                    
                                    <div class="document-info">
                                        <div class="info-row">
                                            <span class="info-label">
                                                <i class="ri-file-text-line"></i>
                                                Nomor Surat
                                            </span>
                                            <span class="info-value"><?= htmlspecialchars($nomor_surat) ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">
                                                <i class="ri-user-line"></i>
                                                Nama Pemohon
                                            </span>
                                            <span class="info-value"><?= htmlspecialchars($nama_pengirim) ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">
                                                <i class="ri-building-line"></i>
                                                Asal Instansi
                                            </span>
                                            <span class="info-value"><?= htmlspecialchars($asal_instansi) ?></span>
                                        </div>
                                        <?php if (isset($data['tanggal_balasan'])): ?>
                                        <div class="info-row">
                                            <span class="info-label">
                                                <i class="ri-calendar-line"></i>
                                                Tanggal Balasan
                                            </span>
                                            <span class="info-value"><?= date('d F Y', strtotime($data['tanggal_balasan'])) ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="result-actions">
                                        <a href="../file_balasan/<?= urlencode($data['file_pdf']) ?>" 
                                           target="_blank" 
                                           class="btn-primary download-btn">
                                            <i class="ri-download-cloud-line"></i>
                                            <span>Unduh Dokumen</span>
                                        </a>
                                        <a href="../permintaaan_srt/permintaan_srt.php" class="btn-secondary">
                                            <i class="ri-search-line"></i>
                                            <span>Cek Surat Lain</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Document Not Found -->
                            <div class="result-card not-found-card">
                                <div class="result-icon not-found-icon">
                                    <i class="ri-file-search-line"></i>
                                </div>
                                <div class="result-content">
                                    <h2>Dokumen Tidak Ditemukan</h2>
                                    <p>Maaf, kami tidak dapat menemukan dokumen dengan data yang Anda masukkan.</p>
                                    
                                    <div class="search-info">
                                        <h3>Data yang dicari:</h3>
                                        <ul class="search-details">
                                            <li>
                                                <i class="ri-file-text-line"></i>
                                                <span>Nomor Surat: <strong><?= htmlspecialchars($nomor_surat) ?></strong></span>
                                            </li>
                                            <li>
                                                <i class="ri-user-line"></i>
                                                <span>Nama: <strong><?= htmlspecialchars($nama_pengirim) ?></strong></span>
                                            </li>
                                            <li>
                                                <i class="ri-building-line"></i>
                                                <span>Instansi: <strong><?= htmlspecialchars($asal_instansi) ?></strong></span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="help-info">
                                        <h3>Kemungkinan penyebab:</h3>
                                        <ul class="help-list">
                                            <li>
                                                <i class="ri-check-line"></i>
                                                <span>Pastikan nomor surat sesuai dengan dokumen asli</span>
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                <span>Gunakan nama lengkap sesuai identitas resmi</span>
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                <span>Periksa nama instansi sudah benar</span>
                                            </li>
                                            <li>
                                                <i class="ri-check-line"></i>
                                                <span>Dokumen mungkin belum selesai diproses</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <?php if (!empty($suggestions)): ?>
                                    <div class="search-info" style="margin-top:1rem;">
                                        <h3>Mungkin yang Anda maksud:</h3>
                                        <ul class="search-details">
                                            <?php foreach ($suggestions as $s): ?>
                                            <li>
                                                <i class="ri-external-link-line"></i>
                                                <span>
                                                    <a href="hasil-pengajuan.php?nomor_surat=<?= urlencode($s['nomor_surat']) ?>&nama_pengirim=<?= urlencode($s['nama_pengirim']) ?>&asal_instansi=<?= urlencode($s['asal_instansi']) ?>" class="suggestion-link">
                                                        <?= htmlspecialchars($s['nomor_surat']) ?> — <?= htmlspecialchars($s['nama_pengirim']) ?> (<?= htmlspecialchars($s['asal_instansi']) ?>)
                                                    </a>
                                                </span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>

                                    <div class="result-actions">
                                        <a href="../permintaaan_srt/permintaan_srt.php" class="btn-primary">
                                            <i class="ri-search-2-line"></i>
                                            <span>Coba Lagi</span>
                                        </a>
                                        <a href="#" class="btn-secondary contact-btn">
                                            <i class="ri-customer-service-2-line"></i>
                                            <span>Hubungi Admin</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- No Search Performed -->
                        <div class="result-card info-card">
                            <div class="result-icon info-icon">
                                <i class="ri-information-line"></i>
                            </div>
                            <div class="result-content">
                                <h2>Tidak Ada Data Pencarian</h2>
                                <p>Silakan kembali ke halaman form untuk melakukan pencarian dokumen.</p>
                                <div class="result-actions">
                                    <a href="../permintaaan_srt/permintaan_srt.php" class="btn-primary">
                                        <i class="ri-arrow-left-line"></i>
                                        <span>Kembali ke Form</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Minimal Footer -->
    <footer class="minimal-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-main">
                    <div class="footer-brand">
                        <img src="../img/favicon.png" alt="PLN Logo">
                        <div class="brand-info">
                            <h3>PLN UID Sulselrabar</h3>
                            <span>Hasil Pengajuan</span>
                        </div>
                    </div>
                    
                    <div class="footer-nav">
                        <a href="../index.php" class="footer-nav-link">
                            <i class="ri-home-3-line"></i>
                            Beranda
                        </a>
                        <a href="../data_mhs/data_mahasiswa.php" class="footer-nav-link">
                            <i class="ri-database-2-line"></i>
                            Data Mahasiswa
                        </a>
                        <a href="../sub_bidang/sub-bidang.php" class="footer-nav-link">
                            <i class="ri-building-2-line"></i>
                            Sub Bidang
                        </a>
                        <a href="../sertifikat/sertifikat.php" class="footer-nav-link">
                            <i class="ri-award-line"></i>
                            Sertifikat
                        </a>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; 2025 PT PLN (Persero) UID Sulselrabar. All Rights Reserved.</p>
                    <div class="footer-links">
                        <a href="#">Privacy</a>
                        <a href="#">Terms</a>
                        <a href="#">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="ri-arrow-up-line"></i>
    </button>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../java_script/ultra-modern-simple.js"></script>
    <script src="../java_script/mobile-header.js"></script>
    <script src="../java_script/mobile-optimizations.js"></script>
    
    <script>
        console.log('🚀 PLN Hasil Pengajuan (Simple - No Loading Screen)');
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });
            
            // Download button enhancement
            const downloadBtn = document.querySelector('.download-btn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function() {
                    this.classList.add('downloading');
                    
                    // Create download feedback
                    const feedback = document.createElement('div');
                    feedback.className = 'download-feedback';
                    feedback.innerHTML = '<i class="ri-check-line"></i> Mengunduh...';
                    this.parentElement.appendChild(feedback);
                    
                    setTimeout(() => {
                        this.classList.remove('downloading');
                        feedback.innerHTML = '<i class="ri-check-double-line"></i> Download dimulai!';
                        
                        setTimeout(() => {
                            feedback.remove();
                        }, 3000);
                    }, 1500);
                });
            }
            
            // Contact button enhancement
            const contactBtn = document.querySelector('.contact-btn');
            if (contactBtn) {
                contactBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Show contact modal or redirect to WhatsApp
                    const message = encodeURIComponent('Halo, saya memerlukan bantuan terkait pencarian dokumen permohonan magang.');
                    const whatsappUrl = `https://wa.me/6281234567890?text=${message}`;
                    window.open(whatsappUrl, '_blank');
                });
            }
            
            // Auto-refresh suggestion for not found results
            <?php if ($search_performed && !$data && empty($error_message)): ?>
            let refreshSuggestionShown = false;
            setTimeout(() => {
                if (!refreshSuggestionShown) {
                    const suggestion = document.createElement('div');
                    suggestion.className = 'refresh-suggestion';
                    suggestion.innerHTML = `
                        <div class="suggestion-content">
                            <i class="ri-refresh-line"></i>
                            <p>Dokumen belum ditemukan? Coba periksa kembali dalam beberapa menit.</p>
                            <button onclick="location.reload()" class="btn-refresh">
                                <i class="ri-refresh-line"></i>
                                Refresh Halaman
                            </button>
                        </div>
                    `;
                    document.querySelector('.result-container').appendChild(suggestion);
                    refreshSuggestionShown = true;
                }
            }, 10000); // Show after 10 seconds
            <?php endif; ?>
            
            console.log('🚀 PLN Hasil Pengajuan Page Loaded - Ultra Modern');
        });
    </script>

    
</body>
</html>