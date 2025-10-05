<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style-ultra-modern.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/ulasan1.css?v=<?php echo time(); ?>">
    
    <!-- PLN Favicon -->
    <link rel="icon" href="../img/favicon.png">
    
    <!-- Font Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../style/mobile-header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/mobile-optimizations.css?v=<?php echo time(); ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <title>Ulasan Peserta Magang - PT PLN UID Sulselrabar</title>
    
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
    
    <!-- Main Testimonial Section -->
    <section class="pln-testimonial-section">
        <div class="pln-container">
            <!-- PLN Header Section -->
            <div class="pln-header-section" data-aos="fade-up" data-aos-duration="1000" style="padding-top: 120px;">
                <!-- Breadcrumb Navigation -->
                <nav class="breadcrumb-modern" data-aos="fade-right" data-aos-delay="200" style="margin-bottom: 2rem;">
                    <a href="../index.php" style="color: var(--pln-secondary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500;">
                        <i class="ri-home-3-line"></i>
                        Beranda
                    </a>
                    <span style="margin: 0 1rem; color: var(--pln-accent);">
                        <i class="ri-arrow-right-s-line"></i>
                    </span>
                    <span style="color: var(--pln-gold); font-weight: 600;">Ulasan & Testimoni</span>
                </nav>
                
                <div class="pln-logo-wrapper">
                    <img src="../admin/asset/LOGO PLN.png" alt="PLN Logo" class="pln-logo" 
                         onerror="this.onerror=null; this.src='../img/favicon.png'; this.style.width='80px';">
                    <div class="pln-logo-glow"></div>
                </div>
                <div class="pln-header-content">
                    <div class="pln-label-container">
                        <span class="pln-label-icon"><i class="fas fa-bolt"></i></span>
                        <p class="pln-label"></p>
                    </div>
                    <h1 class="pln-main-title">
                        <span class="pln-title-highlight">Apa Kata</span>
                        <span class="pln-title-main">Peserta Magang</span>
                        <span class="pln-title-accent">PLN UID Sulselrabar?</span>
                    </h1>
                    <p class="pln-description">
                        <i class="fas fa-quote-left pln-quote-icon"></i>
                        Dengarkan pengalaman nyata dan inspiratif dari para peserta magang yang telah bergabung dengan keluarga besar PT PLN UID Sulselrabar
                        <i class="fas fa-quote-right pln-quote-icon"></i>
                    </p>
                    <div class="pln-cta-section">
                        <a href="msk-ulasan.php" class="pln-cta-button" data-aos="zoom-in" data-aos-delay="500">
                            <span class="pln-button-icon"><i class="fas fa-pen-fancy"></i></span>
                            <span class="pln-button-text">Bagikan Ceritamu</span>
                            <div class="pln-button-glow"></div>
                        </a>
                        
                        <?php
                        // Include database connection at the top
                        include "../admin/config/koneksi.php";
                        
                        // Check if connection is successful
                        if (!$koneksi) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        ?>
                        
                        <div class="pln-stats" data-aos="fade-up" data-aos-delay="700">
                            <div class="pln-stat-item">
                                <span class="pln-stat-number">
                                    <?php 
                                    $count_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM testimoni");
                                    $count_result = mysqli_fetch_assoc($count_query);
                                    echo $count_result['total'] ?? 0;
                                    ?>
                                </span>
                                <span class="pln-stat-label">Ulasan</span>
                            </div>
                            <div class="pln-stat-divider"></div>
                            <div class="pln-stat-item">
                                <span class="pln-stat-number">
                                    <?php 
                                    $avg_query = mysqli_query($koneksi, "SELECT AVG(rating) as avg_rating FROM testimoni");
                                    $avg_result = mysqli_fetch_assoc($avg_query);
                                    echo number_format($avg_result['avg_rating'] ?? 0, 1);
                                    ?>
                                </span>
                                <span class="pln-stat-label">Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
// Database connection already included above

// Ambil semua data ulasan
$query = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY tanggal DESC");

$kolomTengah = [];
$kolomKanan = [];
$i = 0;

// Bagi jadi dua kolom
while ($row = mysqli_fetch_assoc($query)) {
    if ($i % 2 == 0) {
        $kolomTengah[] = $row;
    } else {
        $kolomKanan[] = $row;
    }
    $i++;
}

// Deteksi mobile
$is_mobile = preg_match('/(android|iphone|ipad)/i', $_SERVER['HTTP_USER_AGENT']);
?>

            <!-- Enhanced Testimonial Columns -->
            <div class="pln-testimonials-wrapper" data-aos="fade-up" data-aos-delay="300">
                <!-- Column 1 - Scroll Up -->
                <div class="pln-testimonial-column">
                    <div class="pln-scroll-wrapper">
                        <div class="pln-scroll-up <?= $is_mobile ? 'no-scroll' : '' ?>">
                            <?php foreach ($kolomTengah as $row): ?>
                                <div class="pln-testimonial-card" data-rating="<?= $row['rating'] ?>">
                                    <div class="pln-card-header">
                                        <div class="pln-rating-wrapper">
                                            <div class="pln-stars">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star <?= $i <= $row['rating'] ? 'pln-star-filled' : 'pln-star-empty' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="pln-rating-number"><?= number_format($row['rating'], 1) ?></span>
                                        </div>
                                        <div class="pln-card-pattern"></div>
                                    </div>
                                    <div class="pln-card-content">
                                        <p class="pln-testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
                                        <div class="pln-author-section">
                                            <div class="pln-author-avatar">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                            <div class="pln-author-info">
                                                <h4 class="pln-author-name"><?= htmlspecialchars($row['nama']) ?></h4>
                                                <p class="pln-author-role"><?= htmlspecialchars($row['instansi']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pln-card-glow"></div>
                                </div>
                            <?php endforeach; ?>

                            <?php if (!$is_mobile): ?>
                                <!-- Duplicate for seamless loop -->
                                <?php foreach ($kolomTengah as $row): ?>
                                    <div class="pln-testimonial-card" data-rating="<?= $row['rating'] ?>">
                                        <div class="pln-card-header">
                                            <div class="pln-rating-wrapper">
                                                <div class="pln-stars">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star <?= $i <= $row['rating'] ? 'pln-star-filled' : 'pln-star-empty' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="pln-rating-number"><?= number_format($row['rating'], 1) ?></span>
                                            </div>
                                            <div class="pln-card-pattern"></div>
                                        </div>
                                        <div class="pln-card-content">
                                            <p class="pln-testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
                                            <div class="pln-author-section">
                                                <div class="pln-author-avatar">
                                                    <i class="fas fa-user-graduate"></i>
                                                </div>
                                                <div class="pln-author-info">
                                                    <h4 class="pln-author-name"><?= htmlspecialchars($row['nama']) ?></h4>
                                                    <p class="pln-author-role"><?= htmlspecialchars($row['instansi']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pln-card-glow"></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Column 2 - Scroll Down -->
                <div class="pln-testimonial-column">
                    <div class="pln-scroll-wrapper">
                        <div class="pln-scroll-down <?= $is_mobile ? 'no-scroll' : '' ?>">
                            <?php foreach ($kolomKanan as $row): ?>
                                <div class="pln-testimonial-card" data-rating="<?= $row['rating'] ?>">
                                    <div class="pln-card-header">
                                        <div class="pln-rating-wrapper">
                                            <div class="pln-stars">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star <?= $i <= $row['rating'] ? 'pln-star-filled' : 'pln-star-empty' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="pln-rating-number"><?= number_format($row['rating'], 1) ?></span>
                                        </div>
                                        <div class="pln-card-pattern"></div>
                                    </div>
                                    <div class="pln-card-content">
                                        <p class="pln-testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
                                        <div class="pln-author-section">
                                            <div class="pln-author-avatar">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                            <div class="pln-author-info">
                                                <h4 class="pln-author-name"><?= htmlspecialchars($row['nama']) ?></h4>
                                                <p class="pln-author-role"><?= htmlspecialchars($row['instansi']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pln-card-glow"></div>
                                </div>
                            <?php endforeach; ?>

                            <?php if (!$is_mobile): ?>
                                <!-- Duplicate for seamless loop -->
                                <?php foreach ($kolomKanan as $row): ?>
                                    <div class="pln-testimonial-card" data-rating="<?= $row['rating'] ?>">
                                        <div class="pln-card-header">
                                            <div class="pln-rating-wrapper">
                                                <div class="pln-stars">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star <?= $i <= $row['rating'] ? 'pln-star-filled' : 'pln-star-empty' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <span class="pln-rating-number"><?= number_format($row['rating'], 1) ?></span>
                                            </div>
                                            <div class="pln-card-pattern"></div>
                                        </div>
                                        <div class="pln-card-content">
                                            <p class="pln-testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
                                            <div class="pln-author-section">
                                                <div class="pln-author-avatar">
                                                    <i class="fas fa-user-graduate"></i>
                                                </div>
                                                <div class="pln-author-info">
                                                    <h4 class="pln-author-name"><?= htmlspecialchars($row['nama']) ?></h4>
                                                    <p class="pln-author-role"><?= htmlspecialchars($row['instansi']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pln-card-glow"></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
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
                                <p>Ulasan & Testimoni</p>
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
                            <!-- Removed LinkedIn as requested -->
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
                        <h4>Bagikan Pengalaman</h4>
                        <p>Ceritakan pengalaman magang Anda dan inspirasi untuk yang akan datang.</p>
                        <a href="msk-ulasan.php" class="cta-button">
                            <i class="ri-pen-nib-line"></i>
                            Tulis Ulasan
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
    
    <!-- Enhanced Interactive Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
    <script src="../java_script/ultra-modern.js"></script>
    <script src="../java_script/mobile-header.js"></script>
    <script src="../java_script/mobile-optimizations.js"></script>
    
    <script>
        // Enhanced DOM Ready Function
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize AOS with custom settings
            AOS.init({
                duration: 1000,
                once: false,
                offset: 100,
                easing: 'ease-out-cubic'
            });

            // Enhanced TypeIt Animation
            new TypeIt(".pln-label", {
                strings: ["✨ Cerita Mereka", "⚡ Pengalaman Nyata", "🌟 Inspirasi Masa Depan"],
                speed: 80,
                loop: true,
                deleteSpeed: 60,
                nextStringDelay: 2000,
                breakLines: false,
                cursor: {
                    color: 'var(--pln-secondary)',
                    animation: {
                        frames: [0, 0, 1].map(n => ({ opacity: n })),
                        options: { duration: 1000, iterations: Infinity }
                    }
                }
            }).go();

            // Interactive Card Hover Effects
            const testimonialCards = document.querySelectorAll('.pln-testimonial-card');
            testimonialCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = 'var(--shadow-hover)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = 'var(--shadow-soft)';
                });
            });

            // Enhanced Particle Animation
            createAdvancedParticles();
            
            // Scroll Progress Indicator
            createScrollProgress();
            
            // Rating Stars Animation
            animateStarsOnScroll();
            
            // PLN Button Interactive Effects
            enhancePLNButton();
        });

        // Advanced Particle System
        function createAdvancedParticles() {
            const particleContainer = document.querySelector('.pln-bg-animated');
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'pln-advanced-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                particleContainer.appendChild(particle);
            }
        }

        // Scroll Progress Indicator
        function createScrollProgress() {
            const progressBar = document.createElement('div');
            progressBar.className = 'pln-scroll-progress';
            document.body.appendChild(progressBar);
            
            window.addEventListener('scroll', () => {
                const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (window.scrollY / windowHeight) * 100;
                progressBar.style.width = scrolled + '%';
            });
        }

        // Stars Animation on Scroll
        function animateStarsOnScroll() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const stars = entry.target.querySelectorAll('.pln-star-filled');
                        stars.forEach((star, index) => {
                            setTimeout(() => {
                                star.style.animation = 'plnStarPulse 0.5s ease-out';
                            }, index * 100);
                        });
                    }
                });
            });
            
            document.querySelectorAll('.pln-testimonial-card').forEach(card => {
                observer.observe(card);
            });
        }

        // Enhanced PLN Button
        function enhancePLNButton() {
            const button = document.querySelector('.pln-cta-button');
            if (button) {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    ripple.className = 'pln-ripple';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            }
        }

        // Mobile Optimization
        if (window.innerWidth <= 768) {
            // Pause animations on mobile for better performance
            document.addEventListener('visibilitychange', function() {
                const scrollElements = document.querySelectorAll('.pln-scroll-up, .pln-scroll-down');
                scrollElements.forEach(el => {
                    if (document.hidden) {
                        el.style.animationPlayState = 'paused';
                    } else {
                        el.style.animationPlayState = 'running';
                    }
                });
            });
        }

        // Mobile navigation is handled by ultra-modern.js on this page.
        // Avoid duplicate bindings that can cause immediate close on click.

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
    </script>

    <!-- Enhanced CSS Animations -->
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

        @keyframes plnStarPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); color: var(--pln-gold); }
            100% { transform: scale(1); }
        }
        
        .pln-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: plnRipple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes plnRipple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .pln-scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: var(--gradient-accent);
            z-index: 9999;
            transition: width 0.3s ease;
        }
        
        .pln-advanced-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--pln-accent);
            border-radius: 50%;
            opacity: 0.6;
            animation: plnFloatAdvanced 20s infinite linear;
        }
        
        @keyframes plnFloatAdvanced {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Additional Styles for Better Integration */
        .pln-testimonial-section {
            position: relative;
            z-index: 2;
        }

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

        /* Enhanced Particle Colors */
        .pln-particle,
        .pln-advanced-particle {
            background: linear-gradient(45deg, 
                var(--pln-secondary), 
                var(--pln-accent)) !important;
            box-shadow: 0 0 10px rgba(1, 154, 165, 0.3);
        }

        /* Header Spacing - Sinkron dengan tema PLN */
        .modern-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, 
                rgba(0, 63, 92, 0.95) 0%, 
                rgba(1, 154, 165, 0.95) 50%,
                rgba(15, 178, 190, 0.95) 100%);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 212, 0, 0.2);
            z-index: 12001;
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

        /* Header Navigation Colors */
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
            transition: all 0.3s ease;
        }

        .navbar .brand-text span {
            color: rgba(255, 255, 255, 0.9) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .nav-brand:hover .brand-text h3 {
            color: var(--pln-gold) !important;
            text-shadow: 0 2px 6px rgba(255, 212, 0, 0.4);
        }

        .nav-toggle i {
            color: white !important;
            transition: all 0.3s ease;
        }

        .nav-toggle:hover i {
            color: var(--pln-gold) !important;
            transform: scale(1.1);
        }

        /* Back to Top Button Styles */
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

        /* Logo Styling */
        .pln-logo {
            max-width: 120px;
            height: auto;
            filter: drop-shadow(0 4px 12px rgba(255, 212, 0, 0.3));
            transition: all 0.3s ease;
        }

        .pln-logo:hover {
            filter: drop-shadow(0 6px 16px rgba(255, 212, 0, 0.4));
            transform: scale(1.05);
        }

        /* Logo di header navigation */
        .nav-logo {

            filter: brightness(1.1) drop-shadow(0 2px 6px rgba(255, 255, 255, 0.2));
        }

        /* Testimonial Card Enhancements */
        .pln-testimonial-card {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Breadcrumb Styling - Tema PLN */
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

        .breadcrumb-modern span {
            color: var(--pln-accent) !important;
        }

        .breadcrumb-modern span:last-child {
            color: var(--pln-gold) !important;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(255, 212, 0, 0.2);
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            /* Ensure mobile drawer/toggle on top */
            .nav-menu { z-index: 12002; }
            .nav-toggle { z-index: 12003; position: relative; }
            .pln-header-section {
                padding-top: 100px !important;
            }
            
            .modern-header,
            .modern-header.scrolled {
                background: linear-gradient(135deg, 
                    rgba(0, 63, 92, 0.96) 0%, 
                    rgba(1, 154, 165, 0.96) 100%) !important;
            }
            
            .pln-testimonials-wrapper {
                flex-direction: column;
                gap: 2rem;
            }
            
            .pln-testimonial-column {
                width: 100%;
            }

            .breadcrumb-modern {
                padding: 0.8rem 1.5rem;
                font-size: 0.8rem;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, 
                    rgba(0, 63, 92, 0.2) 0%, 
                    rgba(1, 154, 165, 0.2) 100%);
            }

            .back-to-top {
                bottom: 1rem;
                right: 1rem;
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
                background: linear-gradient(135deg, 
                    var(--pln-primary) 0%, 
                    var(--pln-secondary) 100%);
            }

            .navbar .nav-link:hover,
            .navbar .nav-link.active {
                padding: 0.5rem 0.8rem !important;
            }
        }
    </style>

    <!-- Mobile visual parity tweaks: match desktop palette (dark base, gold/teal accents) -->
    <style>
        @media (max-width: 768px) {
            /* Desktop-like dark background with subtle radial accents */
            body.pln-testimonial-body {
                background: var(--pln-dark) !important;
                color: var(--pln-light) !important;
            }
            .pln-testimonial-section {
                background: linear-gradient(135deg, transparent 0%, rgba(1, 154, 165, 0.05) 100%) !important;
            }
            .pln-bg-animated {
                background: none !important; /* keep particles only; base dark comes from body */
            }

            /* Titles: follow desktop (gold, white, gradient teal) */
            .pln-main-title .pln-title-highlight {
                color: var(--pln-gold) !important;
                -webkit-text-fill-color: var(--pln-gold) !important;
            }
            .pln-main-title .pln-title-main {
                color: #ffffff !important;
                -webkit-text-fill-color: #ffffff !important;
            }
            .pln-main-title .pln-title-accent {
                background: var(--gradient-accent) !important;
                -webkit-background-clip: text !important;
                -webkit-text-fill-color: transparent !important;
                background-clip: text !important;
                color: transparent !important;
            }
            .pln-description { color: #cbd5e1 !important; }
            .pln-quote-icon { color: var(--pln-secondary) !important; }

            /* Stats: gold numbers + subtle labels like desktop */
            .pln-stats .stat-number,
            .pln-stats .number,
            .pln-stats strong {
                color: var(--pln-gold) !important;
                -webkit-text-fill-color: var(--pln-gold) !important;
            }
            .pln-stats .stat-label,
            .pln-stats .label {
                color: #94a3b8 !important;
            }

            /* Keep glass card aesthetic on dark background */
            .pln-testimonial-card {
                background: rgba(255, 255, 255, 0.05) !important;
                border-color: rgba(1, 154, 165, 0.2) !important;
                box-shadow: var(--shadow-soft) !important;
            }
            .pln-testimonial-text { color: #e2e8f0 !important; }
            .pln-author-name { color: #ffffff !important; }
            .pln-author-role { color: #94a3b8 !important; }

            /* Breadcrumb: same subtle glass look */
            .breadcrumb-modern {
                background: linear-gradient(135deg, rgba(0, 63, 92, 0.15) 0%, rgba(1, 154, 165, 0.15) 100%) !important;
            }
        }
    </style>

    <!-- Footer mobile layout tidy-up (layout only, no design changes) -->
    <style>
        @media (max-width: 768px) {
            /* Stack footer sections and center-align for readability */
            .modern-footer .footer-main {
                display: grid !important;
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
            }

            .modern-footer .footer-brand,
            .modern-footer .footer-links,
            .modern-footer .footer-contact,
            .modern-footer .footer-cta {
                text-align: center;
            }

            /* Brand block */
            .modern-footer .footer-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
            }

            .modern-footer .footer-description {
                max-width: 580px;
                margin: 0.75rem auto 0;
            }

            .modern-footer .social-links {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.75rem;
                flex-wrap: wrap;
                margin-top: 0.5rem;
            }

            /* Links block */
            .modern-footer .footer-links ul {
                list-style: none;
                padding: 0;
                margin: 0.5rem auto 0;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.5rem 0.75rem;
                max-width: 480px;
            }

            .modern-footer .footer-links li a {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            /* Contact block */
            .modern-footer .contact-item {
                display: grid;
                grid-template-columns: 28px 1fr;
                gap: 0.75rem;
                justify-content: center;
                text-align: left;
                max-width: 520px;
                margin: 0 auto;
            }

            /* CTA block */
            .modern-footer .footer-cta p {
                max-width: 520px;
                margin: 0.5rem auto 1rem;
            }

            /* Bottom bar: stack and center */
            .modern-footer .footer-bottom .footer-bottom-content {
                display: grid;
                grid-template-columns: 1fr;
                gap: 0.5rem;
                text-align: center;
            }

            .modern-footer .footer-bottom-links {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }
        }
    </style>

    <!-- Page-scoped variable to use gold color for hamburger icon on this page -->
    <style>
        :root { --hamburger-color: var(--pln-gold); }
    </style>
</body>
</html>