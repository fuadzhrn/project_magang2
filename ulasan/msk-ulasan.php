<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style-ultra-modern.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/msk-ulasan.css?v=<?php echo time(); ?>">
    
    <!-- PLN Favicon -->
    <link rel="icon" href="../img/favicon.png">
    
    <!-- Font Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../style/mobile-header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/mobile-optimizations.css?v=<?php echo time(); ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Tulis Ulasan - PT PLN UID Sulselrabar</title>
    
    <!-- PLN Theme Variables -->
    <style>
        :root {
            --pln-primary: #003f5c;
            --pln-secondary: #019AA5;
            --pln-accent: #00d9ff;
            --pln-gold: #FFD700;
            --pln-dark: #1a1a1a;
            --pln-light: #f8fafc;
            --gradient-primary: linear-gradient(135deg, var(--pln-primary) 0%, var(--pln-secondary) 100%);
            --gradient-accent: linear-gradient(135deg, var(--pln-secondary) 0%, var(--pln-accent) 100%);
            --shadow-soft: 0 10px 40px rgba(1, 154, 165, 0.15);
            --shadow-hover: 0 20px 60px rgba(1, 154, 165, 0.25);
        }
    </style>
    
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
<body class="pln-testimonial-body">
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
                        <a href="ulasan.php" class="nav-link active">
                            <i class="ri-chat-3-line"></i>
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

    <!-- Animated Background -->
    <div class="pln-bg-animated">
        <div class="pln-particle"></div>
        <div class="pln-particle"></div>
        <div class="pln-particle"></div>
        <div class="pln-particle"></div>
        <div class="pln-particle"></div>
    </div>
    <!-- Main Form Section -->
    <section class="form-section" style="padding: 8rem 0 4rem; position: relative; z-index: 2;">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav class="breadcrumb-modern" data-aos="fade-right" data-aos-delay="200" style="margin-bottom: 2rem;">
                <a href="../index.php" style="color: var(--pln-secondary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500;">
                    <i class="ri-home-3-line"></i>
                    Beranda
                </a>
                <span style="margin: 0 1rem; color: var(--pln-accent);">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <a href="ulasan.php" style="color: var(--pln-secondary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500;">
                    <i class="ri-chat-3-line"></i>
                    Ulasan
                </a>
                <span style="margin: 0 1rem; color: var(--pln-accent);">
                    <i class="ri-arrow-right-s-line"></i>
                </span>
                <span style="color: var(--pln-gold); font-weight: 600;">Tulis Ulasan</span>
            </nav>

            <div class="form-container" data-aos="fade-up">
                <div class="form-card">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="ri-pen-nib-line"></i>
                        </div>
                        <h1 id="isi-oval" class="form-title">
                            <!-- TypeIt akan mengisi ini -->
                        </h1>
                        <p id="teks-ulasan" class="form-description">
                            Ulasanmu akan membantu memperbaiki dan meningkatkan pengalaman magang bagi mahasiswa berikutnya.
                        </p>
                    </div>

               <?php
include "../admin/config/koneksi.php";

if (isset($_POST['submit'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
    $ulasan   = mysqli_real_escape_string($koneksi, $_POST['ulasan']);
    $rating   = (int) $_POST['rating'];

    // Cek jumlah ulasan
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM testimoni");
    $total = mysqli_fetch_assoc($cek)['total'];

    // Jika sudah 20, hapus ulasan paling lama
    if ($total >= 20) {
        mysqli_query($koneksi, "DELETE FROM testimoni ORDER BY id ASC LIMIT 1");
    }

    // Simpan ulasan baru
    $sql = "INSERT INTO testimoni (nama, instansi, rating, ulasan)
            VALUES ('$nama', '$instansi', '$rating', '$ulasan')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<p style='color:green;'>✅ Ulasan berhasil dikirim!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal menyimpan: " . mysqli_error($koneksi) . "</p>";
    }
}
?>

                    <!-- FORM dimulai di sini -->
                    <form method="POST" action="" class="modern-form">
                        <div class="form-grid">
                            <div class="input-group" data-aos="fade-up" data-aos-delay="300">
                                <label for="nama">
                                    <i class="ri-user-line"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       id="nama"
                                       name="nama" 
                                       placeholder="Masukkan nama lengkap Anda"
                                       class="modern-form-input" 
                                       required>
                            </div>
                            
                            <div class="input-group" data-aos="fade-up" data-aos-delay="400">
                                <label for="instansi">
                                    <i class="ri-building-line"></i>
                                    Asal Instansi
                                </label>
                                <input type="text" 
                                       id="instansi"
                                       name="instansi" 
                                       placeholder="Universitas/Sekolah asal Anda"
                                       class="modern-form-input" 
                                       required>
                            </div>
                            
                            <div class="input-group form-group-full" data-aos="fade-up" data-aos-delay="500">
                                <label for="rating">
                                    <i class="ri-star-line"></i>
                                    Rating Pengalaman
                                </label>
                                <select id="rating" name="rating" class="modern-form-select" required>
                                    <option value="">Pilih rating Anda</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5.0 - Sangat Puas</option>
                                    <option value="4">⭐⭐⭐⭐ 4.0 - Puas</option>
                                    <option value="3">⭐⭐⭐ 3.0 - Cukup</option>
                                    <option value="2">⭐⭐ 2.0 - Kurang</option>
                                    <option value="1">⭐ 1.0 - Tidak Puas</option>
                                </select>
                            </div>
                            
                            <div class="input-group form-group-full" data-aos="fade-up" data-aos-delay="600">
                                <label for="ulasan">
                                    <i class="ri-chat-3-line"></i>
                                    Ulasan & Pengalaman
                                </label>
                                <textarea id="ulasan"
                                         name="ulasan" 
                                         placeholder="Ceritakan pengalaman magang Anda... (maksimal 200 karakter)"
                                         class="modern-form-textarea" 
                                         maxlength="200" 
                                         rows="4"
                                         required></textarea>
                                <small class="char-counter">0/200 karakter</small>
                            </div>
                        </div>
                        
                        <div class="form-actions" data-aos="fade-up" data-aos-delay="700">
                            <button type="submit" name="submit" class="btn-submit-ulasan">
                                <i class="ri-send-plane-fill"></i>
                                <span>Kirim Ulasan</span>
                                <div class="btn-ripple"></div>
                            </button>
                            <a href="ulasan.php" class="btn-secondary">
                                <i class="ri-arrow-left-line"></i>
                                <span>Kembali ke Ulasan</span>
                            </a>
                        </div>
                    </form>
                    <!-- FORM selesai -->
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Footer -->
    <footer class="modern-footer">
        <div class="footer-content">
            <div class="container">
                <div class="footer-main">
                    <div class="footer-brand" data-aos="fade-up">
                        <div class="footer-logo">
                            <img src="../img/favicon.png" alt="PLN Logo">
                            <div class="brand-info">
                                <h3>PLN UID Sulselrabar</h3>
                                <p>Tulis Ulasan</p>
                            </div>
                        </div>
                        <p class="footer-description">
                            Membangun masa depan energi Indonesia dengan mengembangkan 
                            talenta-talenta muda melalui program magang berkualitas.
                        </p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/p/PLN-Wilayah-Sulawesi-Selatan-Tenggara-dan-Barat-100057654511878/" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <!-- Threads social link using provided logo -->
                            <a href="https://www.threads.net/@pln_sulselrabar" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                                <img src="../img/threads-seeklogo.png" alt="Threads logo">
                            </a>
                            <a href="https://www.instagram.com/pln_sulselrabar/" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <!-- Removed LinkedIn/Twitter -->
                        </div>
                    </div>
                    
                    <div class="footer-links" data-aos="fade-up" data-aos-delay="100">
                        <h4>Navigasi</h4>
                        <ul>
                            <li><a href="../index.php"><i class="ri-home-3-line"></i> Beranda</a></li>
                            <li><a href="../data_mhs/data_mahasiswa.php"><i class="ri-database-2-line"></i> Data Mahasiswa</a></li>
                            <li><a href="../permintaaan_srt/permintaan_srt.php"><i class="ri-mail-line"></i> Permintaan Surat</a></li>
                            <li><a href="../sertifikat/sertifikat.php"><i class="ri-award-line"></i> Sertifikat</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-contact" data-aos="fade-up" data-aos-delay="200">
                        <h4>Kontak Kami</h4>
                        <div class="contact-item">
                            <i class="ri-map-pin-line"></i>
                            <div>
                                <strong>Alamat</strong>
                                <p>Jl. Letjen Hertasning No.Blok B<br>90222 Makassar, Sulawesi Selatan</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="ri-mail-line"></i>
                            <div>
                                <strong>Email</strong>
                                <p>fachmadfahresi@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="ri-time-line"></i>
                            <div>
                                <strong>Jam Operasional</strong>
                                <p>Senin - Jumat: 09.00 - 15.00 WITA</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="footer-cta" data-aos="fade-up" data-aos-delay="300">
                        <h4>Lihat Ulasan Lainnya</h4>
                        <p>Baca pengalaman dan testimoni peserta magang lainnya di PLN UID Sulselrabar.</p>
                        <a href="ulasan.php" class="cta-button">
                            <i class="ri-chat-3-line"></i>
                            Lihat Semua Ulasan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 PT PLN (Persero) UID Sulselrabar. All Rights Reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
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

    <script src="../java_script/mobile-header.js"></script>
    <script src="../java_script/mobile-optimizations.js"></script>

    <!-- Page-scoped variable to use gold color for hamburger icon on this page -->
    <style>
        :root { --hamburger-color: var(--pln-gold); }
    </style>
    <!-- Footer mobile layout: left-aligned structure for readability -->
    <style>
        @media (max-width: 768px) {
            /* Stack sections with left-aligned content and headings */
            .modern-footer .footer-main {
                display: grid !important;
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
            }

            .modern-footer .footer-brand,
            .modern-footer .footer-links,
            .modern-footer .footer-contact,
            .modern-footer .footer-cta {
                text-align: left !important;
                margin-left: auto !important;
                margin-right: auto !important;
                padding: 0 1rem;
            }

            /* Brand block */
            .modern-footer .footer-logo {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 0.75rem;
            }

            .modern-footer .footer-description {
                max-width: 580px;
                margin: 0.75rem 0 0;
            }

            .modern-footer .social-links {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                gap: 0.75rem;
                flex-wrap: wrap;
                margin-top: 0.5rem;
            }

            /* Links block */
            .modern-footer .footer-links ul {
                list-style: none;
                padding: 0;
                margin: 0.5rem 0 0;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.5rem 0.75rem;
                max-width: 560px;
            }

            .modern-footer .footer-links li a {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                justify-content: flex-start;
                width: 100%;
            }

            /* Contact block */
            .modern-footer .contact-item {
                display: grid;
                grid-template-columns: 28px 1fr;
                gap: 0.75rem;
                justify-content: start;
                text-align: left;
                max-width: 560px;
                margin: 0;
            }

            /* CTA block */
            .modern-footer .footer-cta p {
                max-width: 560px;
                margin: 0.5rem 0 1rem;
                text-align: left;
            }

            /* Bottom bar: stack and align left */
            .modern-footer .footer-bottom .footer-bottom-content {
                display: grid;
                grid-template-columns: 1fr;
                gap: 0.5rem;
                text-align: left;
                justify-items: start;
                align-items: start;
            }

            .modern-footer .footer-bottom-links {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            /* Ultra-small: one-column nav */
            @media (max-width: 420px) {
                .modern-footer .footer-links ul { grid-template-columns: 1fr; }
            }
        }
    </style>
    
    <!-- Enhanced Interactive Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="../java_script/ultra-modern-simple.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize AOS with custom settings
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });

            // Enhanced TypeIt Animation
            new TypeIt("#isi-oval", {
                strings: ["Bagikan Pengalaman Magangmu!"],
                speed: 80,
                nextStringDelay: 1500,
                cursor: {
                    color: 'var(--pln-secondary)',
                    animation: {
                        frames: [0, 0, 1].map(n => ({ opacity: n })),
                        options: { duration: 1000, iterations: Infinity }
                    }
                }
            })
            .exec(() => {
                document.getElementById("teks-ulasan").classList.add("show");
            })
            .go();

            // Form enhancements
            const form = document.querySelector('.modern-form');
            const inputs = form.querySelectorAll('.modern-form-input, .modern-form-select, .modern-form-textarea');
            const submitBtn = form.querySelector('.btn-submit-ulasan');
            const textarea = document.getElementById('ulasan');
            const charCounter = document.querySelector('.char-counter');

            // Character counter for textarea
            if (textarea && charCounter) {
                textarea.addEventListener('input', function() {
                    const count = this.value.length;
                    charCounter.textContent = `${count}/200 karakter`;
                    
                    if (count > 180) {
                        charCounter.style.color = 'var(--pln-gold)';
                    } else {
                        charCounter.style.color = 'var(--text-muted)';
                    }
                });
            }

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
                
                // Add filled class if already has value
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });

            // Button ripple effect
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
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
                } else {
                    // Show loading state
                    submitBtn.classList.add('loading');
                    submitBtn.querySelector('span').textContent = 'Mengirim...';
                    submitBtn.querySelector('i').className = 'ri-loader-4-line animate-spin';
                }
            });

            // Mobile Navigation handled by ultra-modern-simple.js; removing duplicate inline handlers

            // Header scroll behavior is now centralized in mobile-header.js

            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            if (backToTop) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTop.classList.add('show');
                    } else {
                        backToTop.classList.remove('show');
                    }
                });
                
                backToTop.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>

    <!-- Enhanced CSS Styles -->
    <style>
        /* Footer social icons image normalization (Threads logo) */
        .social-links .social-link img {
            width: 22px;
            height: 22px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.9;
            transition: opacity 0.2s ease, transform 0.2s ease;
            vertical-align: middle;
        }
        .social-links .social-link:hover img {
            opacity: 1;
            transform: translateY(-1px);
        }

        /* Header Styling - Konsisten dengan ulasan.php */
        .modern-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.95) 0%, 
                rgba(1, 154, 165, 0.95) 50%,
                rgba(15, 178, 190, 0.95) 100%) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 212, 0, 0.2);
            z-index: 12001; /* Elevated above overlay */
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 63, 92, 0.1);
        }

        .modern-header.scrolled {
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.98) 0%, 
                rgba(1, 154, 165, 0.98) 50%,
                rgba(15, 178, 190, 0.98) 100%) !important;
            box-shadow: 0 4px 30px rgba(0, 63, 92, 0.2);
            border-bottom: 1px solid rgba(255, 212, 0, 0.3);
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: var(--pln-gold) !important;
            transform: translateY(-2px);
            text-shadow: 0 2px 8px rgba(255, 212, 0, 0.4);
            background: rgba(255, 212, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
        }

        .navbar .nav-link.active {
            color: var(--pln-gold) !important;
            font-weight: 600;
            background: rgba(255, 212, 0, 0.15);
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
            text-shadow: 0 2px 6px rgba(255, 212, 0, 0.3);
            box-shadow: 0 4px 12px rgba(255, 212, 0, 0.2);
        }

        .navbar .brand-text h3 {
            color: white !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar .brand-text span {
            color: rgba(255, 255, 255, 0.9) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .nav-toggle i {
            color: white !important;
        }

        /* Background */
        .pln-bg-animated {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.02) 0%, 
                rgba(1, 154, 165, 0.03) 50%,
                rgba(15, 178, 190, 0.02) 100%);
        }

        .pln-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: linear-gradient(45deg, var(--pln-secondary), var(--pln-accent));
            border-radius: 50%;
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Breadcrumb */
        .breadcrumb-modern {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.15) 0%, 
                rgba(1, 154, 165, 0.15) 100%);
            backdrop-filter: blur(15px);
            border-radius: 50px;
            border: 1px solid rgba(1, 154, 165, 0.3);
            box-shadow: 0 8px 25px rgba(0, 63, 92, 0.15);
            max-width: fit-content;
        }

        .breadcrumb-modern a {
            transition: all 0.3s ease;
            color: var(--pln-secondary) !important;
            font-weight: 500;
        }

        .breadcrumb-modern a:hover {
            color: var(--pln-gold) !important;
            transform: translateX(3px);
            text-shadow: 0 2px 4px rgba(255, 212, 0, 0.3);
        }

        /* Form Styling */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 63, 92, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .form-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
            box-shadow: var(--shadow-soft);
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--pln-primary);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .form-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .form-description.show {
            opacity: 1;
            transform: translateY(0);
        }

        .input-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .input-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .modern-form-input,
        .modern-form-select,
        .modern-form-textarea {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
        }

        .modern-form-input:focus,
        .modern-form-select:focus,
        .modern-form-textarea:focus {
            outline: none;
            border-color: var(--pln-secondary);
            background: white;
            box-shadow: 0 0 0 3px rgba(1, 154, 165, 0.1);
            transform: translateY(-2px);
        }

        .modern-form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .char-counter {
            position: absolute;
            bottom: -1.5rem;
            right: 0;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .btn-submit-ulasan {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 1rem;
        }

        .btn-submit-ulasan:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            pointer-events: none;
        }

        .btn-ripple.ripple-active {
            animation: ripple 0.6s linear;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 2px solid #e5e7eb;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            border-color: var(--pln-secondary);
            color: var(--pln-secondary);
            transform: translateY(-2px);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        /* Modern Footer Styles */
        .modern-footer {
            background: linear-gradient(135deg, 
                var(--pln-dark) 0%, 
                #2a3f5f 100%);
            color: white;
            margin-top: 5rem;
            position: relative;
            overflow: hidden;
        }

        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-accent);
        }

        .footer-content {
            padding: 4rem 0 2rem;
            position: relative;
        }

        .footer-main {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand .footer-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }


       

        .footer-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }


        .footer-links ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .footer-links ul li a:hover {
            color: var(--pln-gold);
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.05);
            padding-left: 1rem;
            border-radius: var(--border-radius);
        }

        .contact-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: flex-start;
        }

        .contact-item i {
            color: var(--pln-secondary);
            font-size: 1.25rem;
            margin-top: 0.25rem;
            min-width: 20px;
        }

        .contact-item strong {
            color: var(--text-white);
            font-weight: 700;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .contact-item p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.6;
        }

        .footer-cta p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.7;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--pln-secondary) 0%, var(--pln-accent) 100%);
            color: white;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 700;
            transition: var(--transition-normal);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl), 0 0 30px rgba(15, 178, 190, 0.5);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom-content p {
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            font-size: 0.85rem;
        }

        .footer-bottom-links {
            display: flex;
            gap: 2rem;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: var(--pln-gold);
        }

        /* Override any conflicting header styles */
        .modern-header,
        .modern-header.scrolled,
        header.modern-header,
        header.modern-header.scrolled {
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.95) 0%, 
                rgba(1, 154, 165, 0.95) 50%,
                rgba(15, 178, 190, 0.95) 100%) !important;
        }

        .modern-header.scrolled,
        header.modern-header.scrolled {
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.98) 0%, 
                rgba(1, 154, 165, 0.98) 50%,
                rgba(15, 178, 190, 0.98) 100%) !important;
            box-shadow: 0 4px 30px rgba(0, 63, 92, 0.2) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            /* Match desktop palette on mobile (dark base; form card stays light) */
            body.pln-testimonial-body { background: var(--pln-dark) !important; color: var(--pln-light) !important; }
            .pln-bg-animated { background: linear-gradient(135deg, rgba(0,63,92,0.02) 0%, rgba(1,154,165,0.03) 50%, rgba(15,178,190,0.02) 100%) !important; }
            .form-section { background: transparent !important; }
            .form-card { background: rgba(255, 255, 255, 0.95) !important; color: var(--pln-dark) !important; }
            .form-title { color: var(--pln-primary) !important; }
            .form-description { color: var(--text-secondary) !important; }

            .form-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .form-title {
                font-size: 2rem;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-submit-ulasan,
            .btn-secondary {
                width: 100%;
                justify-content: center;
            }

            .modern-header,
            .modern-header.scrolled {
                background: linear-gradient(135deg, 
                    rgba(0, 63, 92, 0.96) 0%, 
                    rgba(1, 154, 165, 0.96) 100%) !important;
            }

            /* Footer Responsive */
            .footer-main {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .footer-brand .footer-logo {
                justify-content: center;
            }

            .social-links {
                justify-content: center;
            }

            .footer-links ul li a,
            .contact-item {
                justify-content: center;
                text-align: center;
            }

            .footer-bottom-content {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .footer-bottom-links {
                justify-content: center;
                flex-wrap: wrap;
            }

            .back-to-top {
                bottom: 1rem;
                right: 1rem;
                width: 45px;
                height: 45px;
            }
        }

        /* Mobile Navigation Panel */
        /* Desktop behavior */
        @media (min-width: 993px) {
            .nav-toggle { display: none; }
            .nav-menu {
                display: flex;
                align-items: center;
                gap: 1.25rem;
                position: static;
                height: auto;
                width: auto;
                background: transparent;
                box-shadow: none;
                padding: 0;
            }
        }

        /* Mobile off-canvas */
        @media (max-width: 992px) {
            .nav-toggle { display: block; cursor: pointer; z-index: 12003; /* Above drawer */ }
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                max-width: 320px;
                height: 100vh;
                background: linear-gradient(135deg, rgba(0,63,92,0.98) 0%, rgba(1,154,165,0.98) 100%);
                box-shadow: -10px 0 30px rgba(0,0,0,0.2);
                transition: right 0.3s ease;
                padding: 6rem 1.25rem 2rem;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                z-index: 12002; /* Above header, below toggle */
            }
            .nav-menu.show-menu { right: 0; }
            body.no-scroll { overflow: hidden; }
            .nav-item { margin: 0; }
            .nav-link { padding: 0.75rem 1rem; border-radius: 8px; }
            .nav-link:hover { background: rgba(255,255,255,0.08); }
        }
    </style>
</html>