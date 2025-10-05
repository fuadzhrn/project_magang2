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
    <title>Sertifikat Digital - PLN UID Sulselrabar</title>
    <style>
        /* Ensure brand link has no underline and inherits color */
        .nav-brand-link { text-decoration: none !important; color: inherit !important; transition: color 0.2s ease; }
        .nav-brand-link:hover, .nav-brand-link:focus, .nav-brand-link:active, .nav-brand-link:visited { text-decoration: none !important; color: inherit !important; outline: none; }
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
                        <span class="current">Sertifikat Digital</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-award-line"></i>
                        <span>Sertifikat Digital</span>
                    </div>
                    
                    <h1 class="page-title">Sertifikat Digital</h1>
                    <p class="page-subtitle">
                        Periksa dan unduh sertifikat digital Anda setelah menyelesaikan program magang
                    </p>
                </div>
            </div>
        </section>

        <!-- Certificate Check Section -->
        <section class="services-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="certificate-container" data-aos="fade-up">
                    <div class="certificate-info-card">
                        <div class="certificate-icon">
                            <i class="ri-award-fill"></i>
                        </div>
                        <div class="certificate-info">
                            <h3>Informasi Sertifikat</h3>
                            <p>PT PLN (Persero) UID Sulselrabar memberikan sertifikat kepada mahasiswa magang yang telah menyelesaikan program dengan baik. Proses penerbitan sertifikat dilakukan maksimal 7 hari kerja setelah penarikan.</p>
                        </div>
                    </div>

                    <div class="certificate-form-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="form-header">
                            <h3>
                                <i class="ri-search-line"></i>
                                Periksa Status Sertifikat
                            </h3>
                            <p id="type">Masukkan informasi berikut untuk melihat status sertifikat magang.</p>
                        </div>

                        <?php include "../admin/config/koneksi.php"; ?>

                        <form method="get" action="../sertifikat/hasil-sertifikat.php" class="certificate-form">
                            <div class="form-grid">
                                <div class="form-group-modern">
                                    <label for="nama_lengkap">
                                        <i class="ri-user-line"></i>
                                        Nama Lengkap
                                    </label>
                                    <input 
                                        type="text" 
                                        id="nama_lengkap"
                                        name="nama_lengkap" 
                                        placeholder="Masukkan nama lengkap Anda" 
                                        class="modern-form-input" 
                                        required
                                        data-aos="fade-right"
                                        data-aos-delay="300"
                                    >
                                </div>

                                <div class="form-group-modern">
                                    <label for="asal_instansi">
                                        <i class="ri-building-line"></i>
                                        Asal Instansi
                                    </label>
                                    <input 
                                        type="text" 
                                        id="asal_instansi"
                                        name="asal_instansi" 
                                        placeholder="Universitas/Sekolah asal" 
                                        class="modern-form-input" 
                                        required
                                        data-aos="fade-left"
                                        data-aos-delay="400"
                                    >
                                </div>

                                <div class="form-group-modern form-group-full">
                                    <label for="id_bidang">
                                        <i class="ri-briefcase-line"></i>
                                        Bidang Magang
                                    </label>
                                    <select 
                                        id="id_bidang"
                                        name="id_bidang" 
                                        class="modern-form-select" 
                                        required
                                        data-aos="fade-up"
                                        data-aos-delay="500"
                                    >
                                        <option value="">Pilih bidang magang Anda</option>
                                        <?php
                                        $bidang = mysqli_query($koneksi, "SELECT * FROM sub_bidang ORDER BY nama_bidang ASC");
                                        while ($b = mysqli_fetch_array($bidang)) {
                                            echo "<option value='{$b['id_bidang']}'>" . htmlspecialchars($b['nama_bidang']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-check-certificate" data-aos="zoom-in" data-aos-delay="600">
                                    <i class="ri-search-2-line"></i>
                                    <span>Periksa Sertifikat</span>
                                    <div class="btn-ripple"></div>
                                </button>
                            </div>
                        </form>
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
                            <span>Sertifikat Digital</span>
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
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="../java_script/mobile-header.js"></script>
    <script src="../java_script/mobile-optimizations.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Modern TypeIt animation
            new TypeIt("#type", {
                strings: ["Masukkan informasi berikut untuk melihat status sertifikat magang."],
                speed: 60,
                nextStringDelay: 1500,
                cursor: {
                    color: 'var(--pln-accent)',
                    opacity: 0.8
                }
            }).go();

            // Form interactions
            const formInputs = document.querySelectorAll('.modern-form-input, .modern-form-select');
            
            formInputs.forEach(input => {
                // Focus effects
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('input-focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('input-focused');
                    if (this.value.trim() !== '') {
                        this.parentElement.classList.add('input-filled');
                    } else {
                        this.parentElement.classList.remove('input-filled');
                    }
                });
                
                // Check if already filled
                if (input.value.trim() !== '') {
                    input.parentElement.classList.add('input-filled');
                }
            });

            // Button ripple effect
            const checkButton = document.querySelector('.btn-check-certificate');
            if (checkButton) {
                checkButton.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = this.querySelector('.btn-ripple');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple-active');
                    
                    setTimeout(() => {
                        ripple.classList.remove('ripple-active');
                    }, 600);
                });
            }

            // Form validation feedback
            const certificateForm = document.querySelector('.certificate-form');
            if (certificateForm) {
                certificateForm.addEventListener('submit', function(e) {
                    const button = this.querySelector('.btn-check-certificate');
                    const buttonText = button.querySelector('span');
                    const buttonIcon = button.querySelector('i');
                    
                    // Loading state
                    button.classList.add('loading');
                    buttonIcon.className = 'ri-loader-4-line animate-spin';
                    buttonText.textContent = 'Memproses...';
                    
                    // Note: form will submit normally, this is just for UX feedback
                });
            }

            console.log('🚀 PLN Certificate Modern Page Loaded');
        });
    </script>
    </body>
    </html>