<?php
include "../admin/config/koneksi.php";

$data = null;
$not_found = false;

if (
    isset($_GET['nama_lengkap'], $_GET['asal_instansi'], $_GET['id_bidang']) &&
    !empty($_GET['nama_lengkap']) && !empty($_GET['asal_instansi']) && !empty($_GET['id_bidang'])
) {
    $nama = strtoupper(mysqli_real_escape_string($koneksi, $_GET['nama_lengkap']));
    $instansi = strtoupper(mysqli_real_escape_string($koneksi, $_GET['asal_instansi']));
    $id_bidang = (int) $_GET['id_bidang'];

    $query = mysqli_query($koneksi, "SELECT ds.*, sb.nama_bidang 
      FROM data_sertifikat ds
      JOIN sub_bidang sb ON ds.id_bidang = sb.id_bidang
      WHERE UPPER(ds.nama_lengkap) = '$nama'
        AND UPPER(ds.asal_instansi) = '$instansi'
        AND ds.id_bidang = $id_bidang");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        $not_found = true;
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Hasil Sertifikat - PLN UID Sulselrabar</title>
    
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
                        <a href="../permintaaan_srt/permintaan_srt.php" class="nav-link">
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
                        <a href="../sertifikat/sertifikat.php">
                            Sertifikat
                        </a>
                        <span class="separator">
                            <i class="ri-arrow-right-s-line"></i>
                        </span>
                        <span class="current">Hasil Sertifikat</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-award-line"></i>
                        <span>Certificate Status</span>
                    </div>
                    
                    <h1 class="page-title">Hasil Sertifikat Magang</h1>
                    <p class="page-subtitle">
                        Status dan unduh sertifikat hasil magang Anda
                    </p>
                </div>
            </div>
        </section>

        <!-- Result Section -->
        <section class="result-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="result-container" data-aos="fade-up">

                    <?php if ($data): ?>
                        <!-- Certificate Found -->
                        <div class="result-card success-card">
                            <div class="result-icon success-icon">
                                <i class="ri-award-line"></i>
                            </div>
                            <div class="result-content">
                                <h2>Sertifikat Ditemukan!</h2>
                                <p>🎉 Selamat! Sertifikat magang Anda telah tersedia dan siap untuk diunduh.</p>
                                
                                <div class="document-info">
                                    <div class="info-row">
                                        <span class="info-label">
                                            <i class="ri-user-line"></i>
                                            Nama Lengkap
                                        </span>
                                        <span class="info-value"><?= htmlspecialchars($_GET['nama_lengkap']) ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">
                                            <i class="ri-building-line"></i>
                                            Asal Instansi
                                        </span>
                                        <span class="info-value"><?= htmlspecialchars($_GET['asal_instansi']) ?></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">
                                            <i class="ri-briefcase-line"></i>
                                            Bidang Magang
                                        </span>
                                        <span class="info-value"><?= htmlspecialchars($data['nama_bidang']) ?></span>
                                    </div>
                                </div>
                                
                                <?php if (!empty($data['file_sertifikat'])): ?>
                                <div class="result-actions">
                                    <a href="../file_sertifikat/<?= urlencode($data['file_sertifikat']) ?>" 
                                       target="_blank" 
                                       class="btn-primary download-btn">
                                        <i class="ri-download-cloud-line"></i>
                                        <span>Unduh Sertifikat</span>
                                    </a>
                                    <a href="../sertifikat/sertifikat.php" class="btn-secondary">
                                        <i class="ri-search-line"></i>
                                        <span>Cek Sertifikat Lain</span>
                                    </a>
                                </div>
                                <?php else: ?>
                                <div class="result-actions">
                                    <div class="info-warning">
                                        <i class="ri-information-line"></i>
                                        <span>File sertifikat sedang dalam proses. Silakan coba lagi nanti.</span>
                                    </div>
                                    <a href="../sertifikat/sertifikat.php" class="btn-primary">
                                        <i class="ri-refresh-line"></i>
                                        <span>Coba Lagi</span>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php elseif ($not_found): ?>
                        <!-- Certificate Not Found -->
                        <div class="result-card not-found-card">
                            <div class="result-icon not-found-icon">
                                <i class="ri-file-search-line"></i>
                            </div>
                            <div class="result-content">
                                <h2>Sertifikat Tidak Ditemukan</h2>
                                <p>Maaf, kami tidak dapat menemukan sertifikat dengan data yang Anda masukkan.</p>
                                
                                <div class="search-info">
                                    <h3>Data yang dicari:</h3>
                                    <ul class="search-details">
                                        <li>
                                            <i class="ri-user-line"></i>
                                            <span>Nama: <strong><?= htmlspecialchars($_GET['nama_lengkap']) ?></strong></span>
                                        </li>
                                        <li>
                                            <i class="ri-building-line"></i>
                                            <span>Instansi: <strong><?= htmlspecialchars($_GET['asal_instansi']) ?></strong></span>
                                        </li>
                                        <li>
                                            <i class="ri-briefcase-line"></i>
                                            <span>ID Bidang: <strong><?= htmlspecialchars($_GET['id_bidang']) ?></strong></span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="help-info">
                                    <h3>Kemungkinan penyebab:</h3>
                                    <ul class="help-list">
                                        <li>
                                            <i class="ri-check-line"></i>
                                            <span>Pastikan nama lengkap sesuai identitas resmi</span>
                                        </li>
                                        <li>
                                            <i class="ri-check-line"></i>
                                            <span>Periksa nama instansi sudah benar</span>
                                        </li>
                                        <li>
                                            <i class="ri-check-line"></i>
                                            <span>Pastikan bidang magang sesuai program yang diikuti</span>
                                        </li>
                                        <li>
                                            <i class="ri-check-line"></i>
                                            <span>Sertifikat mungkin belum selesai diproses</span>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="result-actions">
                                    <a href="../sertifikat/sertifikat.php" class="btn-primary">
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

                    <?php else: ?>
                        <!-- No Search Performed -->
                        <div class="result-card info-card">
                            <div class="result-icon info-icon">
                                <i class="ri-information-line"></i>
                            </div>
                            <div class="result-content">
                                <h2>Tidak Ada Data Pencarian</h2>
                                <p>Silakan kembali ke halaman form untuk melakukan pencarian sertifikat.</p>
                                <div class="result-actions">
                                    <a href="../sertifikat/sertifikat.php" class="btn-primary">
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
                            <span>Hasil Sertifikat</span>
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
                        <a href="../permintaaan_srt/permintaan_srt.php" class="footer-nav-link">
                            <i class="ri-mail-line"></i>
                            Permintaan Surat
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
        console.log('🚀 PLN Hasil Sertifikat (Simple - No Loading Screen)');
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
                    feedback.innerHTML = '<i class="ri-check-line"></i> Mengunduh sertifikat...';
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
                    const message = encodeURIComponent('Halo, saya memerlukan bantuan terkait sertifikat magang.');
                    const whatsappUrl = `https://wa.me/6281234567890?text=${message}`;
                    window.open(whatsappUrl, '_blank');
                });
            }
            
            // Certificate celebration animation
            <?php if ($data && !empty($data['file_sertifikat'])): ?>
            setTimeout(() => {
                const successCard = document.querySelector('.success-card');
                if (successCard) {
                    successCard.classList.add('celebration');
                    
                    // Create confetti effect
                    for (let i = 0; i < 20; i++) {
                        const confetti = document.createElement('div');
                        confetti.className = 'confetti';
                        confetti.style.left = Math.random() * 100 + '%';
                        confetti.style.animationDelay = Math.random() * 2 + 's';
                        document.body.appendChild(confetti);
                        
                        setTimeout(() => {
                            confetti.remove();
                        }, 3000);
                    }
                }
            }, 1000);
            <?php endif; ?>
            
            console.log('🎓 PLN Hasil Sertifikat Page Loaded - Ultra Modern');
        });
    </script>

    
</body>
</html>