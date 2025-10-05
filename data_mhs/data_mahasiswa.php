
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
    <title>Data Mahasiswa</title>
    
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
                        <a href="data_mahasiswa.php" class="nav-link active">
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

    <!-- Compact Page Header -->
    <main>
        <section class="compact-header" style="padding-top: 120px; padding-bottom: 2rem; background: linear-gradient(135deg, rgba(0, 98, 122, 0.05) 0%, rgba(15, 178, 190, 0.05) 100%);">
            <div class="container">
                <div class="page-navigation" data-aos="fade-up">
                    <nav class="breadcrumb-modern">
                        <a href="../index.php"><i class="ri-home-3-line"></i> Beranda</a>
                        <span class="separator">/</span>
                        <span class="current">Data Mahasiswa</span>
                    </nav>
                    
                    <div class="page-header-content">
                        <div class="page-badge">
                            <i class="ri-database-2-line"></i>
                            <span>Portal Data</span>
                        </div>
                        <h1 class="page-title">Data Mahasiswa</h1>
                        <p class="page-subtitle">Akses cepat ke semua informasi program magang & PKL</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Access Section -->
        <section class="quick-access-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="quick-access-grid">
                    <div class="access-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="access-card-header">
                            <div class="access-icon">
                                <i class="ri-team-line"></i>
                            </div>
                            <div class="access-badge">
                                <span>50+ Peserta</span>
                            </div>
                        </div>
                        <div class="access-content">
                            <h3>Data Peserta Magang</h3>
                            <p>Lihat data lengkap peserta program magang dan PKL</p>
                        </div>
                        <a href="data_mhs_magang.php" class="access-button">
                            <span>Akses Data</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    
                    <div class="access-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="access-card-header">
                            <div class="access-icon">
                                <i class="ri-organization-chart"></i>
                            </div>
                            <div class="access-badge">
                                <span>11 Bidang</span>
                            </div>
                        </div>
                        <div class="access-content">
                            <h3>Sub Bidang Kerja</h3>
                            <p>Jelajahi sub bidang kerja yang tersedia</p>
                        </div>
                        <a href="../sub_bidang/sub-bidang.php" class="access-button">
                            <span>Lihat Bidang</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    
                    <div class="access-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="access-card-header">
                            <div class="access-icon">
                                <i class="ri-award-line"></i>
                            </div>
                            <div class="access-badge">
                                <span>Tersertifikasi</span>
                            </div>
                        </div>
                        <div class="access-content">
                            <h3>Sertifikat Digital</h3>
                            <p>Unduh sertifikat program magang Anda</p>
                        </div>
                        <a href="../sertifikat/sertifikat.php" class="access-button">
                            <span>Unduh Sertifikat</span>
                            <i class="ri-download-line"></i>
                        </a>
                    </div>
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
                            <span>Data Mahasiswa Portal</span>
                        </div>
                    </div>
                    
                    <div class="footer-nav">
                        <a href="../index.php" class="footer-nav-link">
                            <i class="ri-home-3-line"></i>
                            Beranda
                        </a>
                        <a href="data_mhs_magang.php" class="footer-nav-link">
                            <i class="ri-database-2-line"></i>
                            Data Magang
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
        // Simple initialization - main functionality is in ultra-modern.js
        console.log('🚀 PLN Data Mahasiswa Ultra Modern Website Loading...');
        
        // Page specific enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced keyboard shortcuts for data pages
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey) {
                    switch(e.key) {
                        case '1':
                            e.preventDefault();
                            window.location.href = 'data_mhs_magang.php';
                            break;
                        case '2':
                            e.preventDefault();
                            window.location.href = '../sub_bidang/sub-bidang.php';
                            break;
                        case '3':
                            e.preventDefault();
                            window.location.href = '../sertifikat/sertifikat.php';
                            break;
                    }
                }
            });
        });
    </script>

    
</body>
</html>
