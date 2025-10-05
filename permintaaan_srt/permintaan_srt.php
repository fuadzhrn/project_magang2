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
    <title>Permintaan Surat - PLN UID Sulselrabar</title>
    
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
                        <span class="current">Permintaan Surat</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-mail-line"></i>
                        <span>Status Check</span>
                    </div>
                    
                    <h1 class="page-title">Cek Status Permintaan</h1>
                    <p class="page-subtitle" id="dynamic-subtitle">
                        Periksa status permohonan magang Anda dengan memasukkan data yang diperlukan
                    </p>
                </div>
            </div>
        </section>

        <!-- Request Form Section -->
        <section class="form-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="form-container" data-aos="fade-up">
                    <div class="form-card">
                        <div class="form-header">
                            <div class="form-icon">
                                <i class="ri-search-line"></i>
                            </div>
                            <h2>Status Permintaan Surat</h2>
                            <p>Masukkan informasi untuk mengecek status permohonan magang</p>
                        </div>
                        
                        <form action="hasil-pengajuan.php" method="get" class="modern-form">
                            <div class="form-grid">
                                <div class="input-group" data-aos="fade-up" data-aos-delay="100">
                                    <label for="nomor_surat">
                                        <i class="ri-file-text-line"></i>
                                        Nomor Surat
                                    </label>
                                    <input type="text" 
                                           id="nomor_surat"
                                           name="nomor_surat" 
                                           placeholder="Masukkan nomor surat"
                                           required>
                                </div>
                                
                                <div class="input-group" data-aos="fade-up" data-aos-delay="200">
                                    <label for="nama_pengirim">
                                        <i class="ri-user-line"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" 
                                           id="nama_pengirim"
                                           name="nama_pengirim" 
                                           placeholder="Masukkan nama lengkap"
                                           required>
                                </div>
                                
                                <div class="input-group" data-aos="fade-up" data-aos-delay="300">
                                    <label for="asal_instansi">
                                        <i class="ri-building-line"></i>
                                        Asal Instansi
                                    </label>
                                    <input type="text" 
                                           id="asal_instansi"
                                           name="asal_instansi" 
                                           placeholder="Masukkan asal instansi"
                                           required>
                                </div>
                            </div>
                            
                            <div class="form-actions" data-aos="fade-up" data-aos-delay="400">
                                <button type="submit" class="btn-primary">
                                    <i class="ri-search-2-line"></i>
                                    <span>Periksa Status</span>
                                </button>
                                <button type="reset" class="btn-secondary">
                                    <i class="ri-refresh-line"></i>
                                    <span>Reset Form</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Info Panel -->
                    <div class="info-panel" data-aos="fade-left" data-aos-delay="500">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="ri-information-line"></i>
                            </div>
                            <h3>Panduan Penggunaan</h3>
                            <ul class="info-list">
                                <li>
                                    <i class="ri-check-line"></i>
                                    <span>Pastikan nomor surat sesuai dengan yang tertera pada permohonan</span>
                                </li>
                                <li>
                                    <i class="ri-check-line"></i>
                                    <span>Gunakan nama lengkap sesuai identitas resmi</span>
                                </li>
                                <li>
                                    <i class="ri-check-line"></i>
                                    <span>Masukkan nama instansi atau universitas dengan benar</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="contact-card">
                            <div class="contact-icon">
                                <i class="ri-customer-service-2-line"></i>
                            </div>
                            <h3>Butuh Bantuan?</h3>
                            <p>Hubungi tim kami jika mengalami kesulitan dalam pengecekan status</p>
                            <a href="#" class="contact-btn">
                                <i class="ri-phone-line"></i>
                                <span>Hubungi Kami</span>
                            </a>
                        </div>
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
                            <span>Permintaan Surat</span>
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
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="../java_script/ultra-modern-simple.js"></script>
    <script src="../java_script/mobile-header.js"></script>
    <script src="../java_script/mobile-optimizations.js"></script>
    
    <script>
        console.log('🚀 PLN Permintaan Surat (Simple - No Loading Screen)');
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });
            
            // TypeIt for dynamic subtitle
            new TypeIt("#dynamic-subtitle", {
                strings: [
                    "Periksa status permohonan magang Anda dengan mudah",
                    "Masukkan data yang diperlukan untuk cek status",
                    "Sistem tracking otomatis untuk transparansi proses"
                ],
                speed: 50,
                loop: true,
                deleteSpeed: 30,
                nextStringDelay: 2000,
                breakLines: false
            }).go();
            
            // Form enhancements
            const form = document.querySelector('.modern-form');
            const inputs = form.querySelectorAll('input[required]');
            const submitBtn = form.querySelector('.btn-primary');
            
            // Input focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
                
                // Add ripple effect on input
                input.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    ripple.className = 'input-ripple';
                    this.parentElement.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Form validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.parentElement.classList.add('error');
                        isValid = false;
                    } else {
                        input.parentElement.classList.remove('error');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    submitBtn.classList.add('shake');
                    setTimeout(() => {
                        submitBtn.classList.remove('shake');
                    }, 500);
                }
            });
            
            // Button click effects
            submitBtn.addEventListener('click', function() {
                this.classList.add('loading');
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 2000);
            });
            
            console.log('🚀 PLN Permintaan Surat Page Loaded - Ultra Modern');
        });
    </script>

    
</body>
</html>