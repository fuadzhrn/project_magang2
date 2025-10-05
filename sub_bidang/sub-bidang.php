
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
    <title>Sub Bidang Kerja - PLN UID Sulselrabar</title>
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
                        <span class="current">Sub Bidang Kerja</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-building-2-line"></i>
                        <span>Bidang Kerja</span>
                    </div>
                    
                    <h1 class="page-title">Sub Bidang Kerja</h1>
                    <p class="page-subtitle">
                        Pilih bidang kerja sesuai dengan minat dan keahlian Anda di PT PLN UID Sulselrabar
                    </p>
                </div>
            </div>
        </section>

        <!-- Sub Bidang Grid Section -->
        <section class="services-section" style="padding: 3rem 0;">
            <div class="container">
                <div class="sub-bidang-grid" data-aos="fade-up">
                    <?php
                    include "../admin/config/koneksi.php";
                    $result = mysqli_query($koneksi, "
                        SELECT sb.id_bidang, sb.nama_bidang, sb.deskripsi, 
                              (sb.kouta - COUNT(pm.id_mahasiswa)) AS sisa_kuota
                        FROM sub_bidang sb
                        LEFT JOIN peserta_magang pm 
                            ON sb.id_bidang = pm.id_bidang AND pm.status = 'Aktif'
                        GROUP BY sb.id_bidang
                        ORDER BY sb.nama_bidang ASC
                    ");

                    $bidang_data = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $bidang_data[] = $row;
                    }

                    foreach ($bidang_data as $index => $row) {
                        $nama_bidang = htmlspecialchars($row['nama_bidang']);
                        $deskripsi = htmlspecialchars($row['deskripsi']);
                        $sisa_kuota = max(0, $row['sisa_kuota']);
                        $slug = strtolower(str_replace([' ', '&'], ['-', ''], $nama_bidang));
                        
                        // Icon mapping untuk setiap bidang
                        $icons = [
                            'k3' => 'ri-shield-check-line',
                            'niaga' => 'ri-money-dollar-circle-line',
                            'pengadaan' => 'ri-shopping-cart-line',
                            'distribusi-up2k' => 'ri-git-branch-line',
                            'perencanaan' => 'ri-calendar-schedule-line',
                            'hc' => 'ri-team-line',
                            'htd' => 'ri-tools-line',
                            'keuangan-akutansi' => 'ri-calculator-line',
                            'komunikasi' => 'ri-message-3-line',
                            'umum' => 'ri-building-line',
                            'sti' => 'ri-computer-line'
                        ];
                        
                        $icon = $icons[$slug] ?? 'ri-building-2-line';
                        $delay = ($index % 3) * 100;
                    ?>
                        <div class="bidang-card-interactive" data-bidang="<?= $slug ?>" data-aos="fade-up" data-aos-delay="<?= $delay ?>" onclick="selectBidang('<?= $slug ?>')">
                            <!-- Initial Card State -->
                            <div class="card-initial-state">
                                <div class="bidang-icon-large">
                                    <i class="<?= $icon ?>"></i>
                                </div>
                                <h3 class="bidang-title-initial"><?= $nama_bidang ?></h3>
                                <div class="selection-indicator">
                                    <i class="ri-cursor-line"></i>
                                    <span>Klik untuk info detail</span>
                                </div>
                            </div>
                            
                            <!-- Expanded Card State -->
                            <div class="card-expanded-state" id="expanded-<?= $slug ?>">
                                <div class="expanded-header">
                                    <div class="bidang-icon-small">
                                        <i class="<?= $icon ?>"></i>
                                    </div>
                                    <div class="bidang-info">
                                        <h3 class="bidang-title-expanded"><?= $nama_bidang ?></h3>
                                        <div class="bidang-category">
                                            <i class="ri-bookmark-line"></i>
                                            <span>Bidang Kerja</span>
                                        </div>
                                    </div>
                                    <button class="close-expanded" onclick="closeBidang('<?= $slug ?>')">
                                        <i class="ri-close-line"></i>
                                    </button>
                                </div>
                                
                                <div class="quota-info-panel">
                                    <div class="quota-visual">
                                        <div class="quota-circle">
                                            <div class="quota-number-large"><?= $sisa_kuota ?></div>
                                            <div class="quota-label-small">Tersisa</div>
                                        </div>
                                        <div class="quota-status-large <?= $sisa_kuota > 0 ? 'available' : 'full' ?>">
                                            <i class="<?= $sisa_kuota > 0 ? 'ri-check-circle-fill' : 'ri-close-circle-fill' ?>"></i>
                                            <span><?= $sisa_kuota > 0 ? 'Masih Tersedia' : 'Kuota Penuh' ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="description-panel">
                                    <h4>
                                        <i class="ri-information-2-line"></i>
                                        Deskripsi Bidang
                                    </h4>
                                    <p class="bidang-description-full"><?= nl2br($deskripsi) ?></p>
                                </div>
                                
                                <div class="action-panel">
                                    <div class="action-info">
                                        <div class="info-item">
                                            <i class="ri-time-line"></i>
                                            <span>Durasi: 3-6 bulan</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="ri-group-line"></i>
                                            <span>Total Kuota: <?= $sisa_kuota + 5 ?> posisi</span>
                                        </div>
                                    </div>
                                    <?php if ($sisa_kuota > 0): ?>
                                        <button class="btn-apply-bidang">
                                            <i class="ri-send-plane-fill"></i>
                                            <span>Tertarik dengan bidang ini</span>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn-waitlist-bidang">
                                            <i class="ri-notification-3-line"></i>
                                            <span>Daftarkan ke Waiting List</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Selection Animation Overlay -->
                            <div class="selection-overlay" id="overlay-<?= $slug ?>">
                                <div class="ripple-effect"></div>
                            </div>
                        </div>
                    <?php } ?>
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
                            <span>Sub Bidang Kerja</span>
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
                        <a href="../permintaaan_srt/permintaan_srt.php" class="footer-nav-link">
                            <i class="ri-mail-line"></i>
                            Permintaan Surat
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

    
</body>
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
        let selectedBidang = null;
        let isAnimating = false;
        
        // Interactive Bidang Selection
        function selectBidang(bidangSlug) {
            if (isAnimating) return;
            
            const card = document.querySelector(`[data-bidang="${bidangSlug}"]`);
            const overlay = document.getElementById(`overlay-${bidangSlug}`);
            const expandedState = document.getElementById(`expanded-${bidangSlug}`);
            
            // If clicking the same card, close it
            if (selectedBidang === bidangSlug) {
                closeBidang(bidangSlug);
                return;
            }
            
            // Close previously selected card
            if (selectedBidang && selectedBidang !== bidangSlug) {
                closeBidang(selectedBidang);
            }
            
            // Set animation flag
            isAnimating = true;
            
            // Trigger ripple effect
            const ripple = overlay.querySelector('.ripple-effect');
            overlay.classList.add('active');
            ripple.classList.add('animate');
            
            // Add selection class to card
            card.classList.add('selected');
            selectedBidang = bidangSlug;
            
            // Show expanded state with staggered animation
            setTimeout(() => {
                expandedState.classList.add('show');
                
                // Animate elements in sequence
                const elements = expandedState.querySelectorAll('.expanded-header, .quota-info-panel, .description-panel, .action-panel');
                elements.forEach((el, index) => {
                    setTimeout(() => {
                        el.classList.add('animate-in');
                    }, index * 150);
                });
            }, 300);
            
            // Smooth scroll to center the selected card (mobile optimized)
            setTimeout(() => {
                if (window.innerWidth <= 768) {
                    // Mobile: scroll to top of card with offset for header
                    const cardRect = card.getBoundingClientRect();
                    const headerHeight = 100;
                    const scrollTop = window.pageYOffset + cardRect.top - headerHeight;
                    
                    window.scrollTo({
                        top: scrollTop,
                        behavior: 'smooth'
                    });
                } else {
                    // Desktop: center the card
                    card.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center',
                        inline: 'nearest'
                    });
                }
                isAnimating = false;
            }, 600);
            
            // Add stats animation
            setTimeout(() => {
                animateQuotaNumber(bidangSlug);
            }, 800);
        }
        
        function closeBidang(bidangSlug) {
            if (isAnimating) return;
            
            const card = document.querySelector(`[data-bidang="${bidangSlug}"]`);
            const overlay = document.getElementById(`overlay-${bidangSlug}`);
            const expandedState = document.getElementById(`expanded-${bidangSlug}`);
            
            // Remove animations and classes
            card.classList.remove('selected');
            overlay.classList.remove('active');
            overlay.querySelector('.ripple-effect').classList.remove('animate');
            expandedState.classList.remove('show');
            
            // Remove animation classes from elements
            const elements = expandedState.querySelectorAll('.expanded-header, .quota-info-panel, .description-panel, .action-panel');
            elements.forEach(el => {
                el.classList.remove('animate-in');
            });
            
            selectedBidang = null;
        }
        
        function animateQuotaNumber(bidangSlug) {
            const quotaElement = document.querySelector(`[data-bidang="${bidangSlug}"] .quota-number-large`);
            const targetNumber = parseInt(quotaElement.textContent);
            
            let currentNumber = 0;
            const increment = Math.ceil(targetNumber / 20);
            
            const animation = setInterval(() => {
                currentNumber += increment;
                if (currentNumber >= targetNumber) {
                    currentNumber = targetNumber;
                    clearInterval(animation);
                    
                    // Add pulse effect when animation completes
                    quotaElement.classList.add('pulse-effect');
                    setTimeout(() => {
                        quotaElement.classList.remove('pulse-effect');
                    }, 1000);
                }
                quotaElement.textContent = currentNumber;
            }, 50);
        }
        
        // Enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Check if device is mobile
            const isMobile = window.innerWidth <= 768;
            
            // Hover effects for desktop only
            if (!isMobile) {
                document.querySelectorAll('.bidang-card-interactive').forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        if (!this.classList.contains('selected')) {
                            this.style.transform = 'translateY(-8px) scale(1.02)';
                            this.querySelector('.selection-indicator').style.opacity = '1';
                        }
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        if (!this.classList.contains('selected')) {
                            this.style.transform = 'translateY(0) scale(1)';
                            this.querySelector('.selection-indicator').style.opacity = '0.7';
                        }
                    });
                });
            }
            
            // Touch interactions for mobile
            document.querySelectorAll('.bidang-card-interactive').forEach(card => {
                card.addEventListener('touchstart', function(e) {
                    if (!this.classList.contains('selected')) {
                        this.style.transform = 'scale(0.98)';
                    }
                });
                
                card.addEventListener('touchend', function(e) {
                    if (!this.classList.contains('selected')) {
                        this.style.transform = 'scale(1)';
                    }
                });
            });
            
            // Apply button interactions
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-apply-bidang')) {
                    const button = e.target.closest('.btn-apply-bidang');
                    button.classList.add('clicked');
                    
                    // Show success feedback
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="ri-check-line"></i><span>Minat tercatat! Hubungi admin untuk lanjut</span>';
                    button.style.background = 'linear-gradient(135deg, #10B981, #059669)';
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.style.background = '';
                        button.classList.remove('clicked');
                    }, 3000);
                    
                    e.stopPropagation();
                }
                
                if (e.target.closest('.btn-waitlist-bidang')) {
                    const button = e.target.closest('.btn-waitlist-bidang');
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="ri-notification-3-fill"></i><span>Ditambahkan ke waiting list</span>';
                    button.style.background = 'linear-gradient(135deg, #F59E0B, #D97706)';
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.style.background = '';
                    }, 3000);
                    
                    e.stopPropagation();
                }
            });
            
            // Close on outside click (optimized for mobile)
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.bidang-card-interactive') && selectedBidang) {
                    // On mobile, only close if clicking far from cards
                    if (window.innerWidth <= 768) {
                        const cards = document.querySelectorAll('.bidang-card-interactive');
                        let clickedNearCard = false;
                        
                        cards.forEach(card => {
                            const rect = card.getBoundingClientRect();
                            const clickX = e.clientX;
                            const clickY = e.clientY;
                            
                            // Add buffer zone around cards on mobile
                            if (clickX >= rect.left - 20 && clickX <= rect.right + 20 &&
                                clickY >= rect.top - 20 && clickY <= rect.bottom + 20) {
                                clickedNearCard = true;
                            }
                        });
                        
                        if (!clickedNearCard) {
                            closeBidang(selectedBidang);
                        }
                    } else {
                        closeBidang(selectedBidang);
                    }
                }
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && selectedBidang) {
                    closeBidang(selectedBidang);
                }
            });
            
            // Window resize handler for responsive adjustments
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    // Reset card transforms on resize
                    if (selectedBidang) {
                        const selectedCard = document.querySelector(`[data-bidang="${selectedBidang}"]`);
                        if (selectedCard) {
                            // Re-trigger smooth scroll with new dimensions
                            setTimeout(() => {
                                if (window.innerWidth <= 768) {
                                    const cardRect = selectedCard.getBoundingClientRect();
                                    const headerHeight = 100;
                                    const scrollTop = window.pageYOffset + cardRect.top - headerHeight;
                                    
                                    window.scrollTo({
                                        top: scrollTop,
                                        behavior: 'smooth'
                                    });
                                }
                            }, 100);
                        }
                    }
                }, 250);
            });
            
            // Prevent zoom on double tap for mobile (iOS Safari)
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function (event) {
                const now = (new Date()).getTime();
                if (now - lastTouchEnd <= 300) {
                    event.preventDefault();
                }
                lastTouchEnd = now;
            }, false);
            
            console.log('🚀 PLN Interactive Sub Bidang Page Loaded - Mobile Optimized');
        });
    </script>


</html>