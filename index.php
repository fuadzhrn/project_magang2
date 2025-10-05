<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portal Informasi Magang PLN UID Sulselrabar. Cek status surat permohonan, unduh sertifikat, dan lihat informasi program magang.">
  <meta name="keywords" content="informasi magang PLN, status surat PLN, PLN UID Sulselrabar, sertifikat magang, cek status magang">
  <meta name="author" content="PLN UID Sulselrabar">
  <meta name="google-site-verification" content="aAzrnk4YZu4KqTVJntpevwf8_1H4EB-53a8skKVOaSY" />
  
  <title>Portal Informasi Magang - PLN UID Sulselrabar</title>
  
<?php
// Bring DB connection for dynamic gallery & media
$koneksi = null;
@include __DIR__ . '/admin/config/koneksi.php'; // config.php sets $koneksi
$media = ['hero_main' => null, 'about_main' => null];
if ($koneksi) {
  $resM = mysqli_query($koneksi, "SELECT media_key, filename, title, caption FROM site_media WHERE media_key IN ('hero_main','about_main')");
  while ($resM && ($rowM = mysqli_fetch_assoc($resM))) {
    $media[$rowM['media_key']] = $rowM;
  }
}
?>
  
  <!-- Ultra Modern Styling -->
  <link rel="stylesheet" href="style/style-ultra-modern.css?<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="icon" href="img/favicon.png">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
        <link rel="stylesheet" href="style/mobile-header.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="style/mobile-optimizations.css?v=<?php echo time(); ?>">
  
  <!-- Button Fix Styles -->
  <style>
    /* PLN Button Fix Styles */
    :root {
        --pln-primary: #00627A;
        --pln-secondary: #019AA5;
        --pln-accent: #0FB2BE;
        --pln-yellow: #FFD400;
        --pln-gradient: linear-gradient(135deg, #00627A 0%, #019AA5 50%, #0FB2BE 100%);
        --pln-glow: 0 0 30px rgba(15, 178, 190, 0.3);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --glass-blur: blur(20px);
        --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        --shadow-md: 0 10px 15px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 25px 50px rgba(0, 0, 0, 0.15);
        --border-radius: 12px;
        --transition-normal: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.75rem !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        padding: 1rem 2rem !important;
        border-radius: var(--border-radius) !important;
        text-decoration: none !important;
        transition: var(--transition-normal) !important;
        position: relative !important;
        overflow: hidden !important;
        border: none !important;
        cursor: pointer !important;
        font-family: 'Inter', sans-serif !important;
    }
    
    .btn-primary {
        background: var(--pln-gradient) !important;
        color: white !important;
        box-shadow: var(--shadow-md) !important;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px) scale(1.02) !important;
        box-shadow: var(--shadow-xl), var(--pln-glow) !important;
        color: white !important;
        text-decoration: none !important;
    }
    
    .btn-glass {
        background: var(--glass-bg) !important;
        color: var(--pln-primary) !important;
        backdrop-filter: var(--glass-blur) !important;
        border: 1px solid var(--glass-border) !important;
        box-shadow: var(--glass-shadow) !important;
    }
    
    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-2px) !important;
        box-shadow: var(--glass-shadow) !important;
        color: var(--pln-primary) !important;
        text-decoration: none !important;
    }
    
    .hero-buttons {
        display: flex !important;
        gap: 1.5rem !important;
        flex-wrap: wrap !important;
        margin-top: 2rem !important;
    }
    
    /* Icon styling in buttons */
    .btn i {
        font-size: 1.1em !important;
        opacity: 0.9 !important;
    }
    
    .btn:hover i {
        opacity: 1 !important;
    }
    
    /* Service Link Styling - for "Lihat Data Peserta" button */
    .service-link {
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.75rem !important;
        color: var(--pln-secondary) !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: var(--transition-normal) !important;
        position: relative !important;
        padding: 0.75rem 1.5rem !important;
        background: var(--glass-bg) !important;
        border: 1px solid var(--glass-border) !important;
        border-radius: var(--border-radius) !important;
        backdrop-filter: var(--glass-blur) !important;
        box-shadow: var(--glass-shadow) !important;
        font-family: 'Inter', sans-serif !important;
        cursor: pointer !important;
    }
    
    .service-link::after {
        content: '' !important;
        position: absolute !important;
        bottom: -2px !important;
        left: 0 !important;
        width: 0 !important;
        height: 2px !important;
        background: var(--pln-gradient) !important;
        transition: width 0.3s ease !important;
    }
    
    .service-link:hover::after {
        width: 100% !important;
    }
    
    .service-link:hover {
        gap: 1rem !important;
        color: var(--pln-primary) !important;
        text-decoration: none !important;
        transform: translateY(-2px) !important;
        box-shadow: var(--shadow-xl) !important;
    }
    
    .service-link i {
        font-size: 1.1em !important;
        opacity: 0.8 !important;
        transition: all 0.3s ease !important;
    }
    
    .service-link:hover i {
        opacity: 1 !important;
        transform: translateX(2px) !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-buttons {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        
        .btn {
            justify-content: center !important;
            text-align: center !important;
        }
        
        .service-link {
            justify-content: center !important;
            text-align: center !important;
            margin-top: 1rem !important;
        }
    }
    
    /* Navigation Brand Link Styling */
    .nav-brand-link {
        text-decoration: none !important;
        color: inherit !important;
        transition: var(--transition-normal) !important;
        cursor: pointer !important;
    }
    
    .nav-brand-link:hover {
        text-decoration: none !important;
        color: inherit !important;
    }
    
    .nav-brand-link:hover .nav-brand {
        transform: scale(1.02) !important;
        opacity: 0.9 !important;
    }
    
    .nav-brand-link:hover .brand-text h3 {
        color: var(--pln-secondary) !important;
    }
    
    /* Scroll Progress Indicator */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: var(--pln-gradient);
        z-index: 9999;
        transition: width 0.3s ease;
        box-shadow: 0 2px 10px rgba(15, 178, 190, 0.3);
    }
    
    /* Footer Particle Animation */
    .footer-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
        z-index: 1;
    }
    
    .footer-particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: linear-gradient(45deg, var(--pln-accent), var(--pln-secondary));
        border-radius: 50%;
        opacity: 0.7;
        animation: floatUpFooter 8s infinite linear;
        box-shadow: 0 0 10px rgba(15, 178, 190, 0.4);
    }
    
    .footer-particle:nth-child(2n) {
        background: linear-gradient(45deg, var(--pln-secondary), var(--pln-primary));
        animation-duration: 10s;
        width: 4px;
        height: 4px;
    }
    
    .footer-particle:nth-child(3n) {
        background: linear-gradient(45deg, var(--pln-yellow), var(--pln-accent));
        animation-duration: 12s;
        width: 8px;
        height: 8px;
        opacity: 0.5;
    }
    
    @keyframes floatUpFooter {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.7;
        }
        90% {
            opacity: 0.7;
        }
        100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
        }
    }
    
    /* Enhanced Footer Styling */
    .modern-footer {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, 
            #1a1a1a 0%, 
            #2d3748 30%, 
            #1e2832 70%, 
            #0a1117 100%);
        border-top: 4px solid var(--pln-secondary);
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .modern-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 2;
        pointer-events: none;
    }
    
    .footer-content {
        position: relative;
        z-index: 3;
    }

    /* Threads logo image inside social link */
    .social-link img { 
        width: 22px; 
        height: 22px; 
        object-fit: contain; 
        display: block; 
    }
    .modern-footer .social-link img { 
        filter: invert(1) brightness(1.2); 
        opacity: 0.95; 
        transition: opacity 0.3s ease, filter 0.3s ease; 
    }
    .modern-footer .social-link:hover img { 
        opacity: 1; 
        filter: invert(1) brightness(1.4); 
    }

    /* Mobile readability fixes for hero badge & stats */
    @media (max-width: 768px) {
        /* Keep original design; only ensure text contrast */
        /* Make the hero badge match desktop style: white pill + teal text */
        .hero-badge {
            background: #ffffff !important;
            color: var(--pln-secondary) !important;
            border: 1px solid rgba(1, 154, 165, 0.25) !important;
            font-weight: 700 !important;
            letter-spacing: 0.2px;
            mix-blend-mode: normal !important;
            box-shadow: 0 10px 24px rgba(0, 63, 92, 0.08);
            backdrop-filter: saturate(120%) blur(4px);
        }
        .hero-badge i { 
            color: var(--pln-yellow) !important; 
            opacity: 1 !important; 
            filter: drop-shadow(0 1px 1px rgba(0,0,0,0.25));
        }

        /* Ensure statistic numbers are visible on WebKit-based mobile */
        .stat-item .stat-number, .stat-number {
            background: none !important;                  /* remove gradient text */
            -webkit-background-clip: initial !important;
            background-clip: initial !important;
            -webkit-text-fill-color: var(--pln-secondary) !important; /* fix transparent fill */
            color: var(--pln-secondary) !important;
            text-shadow: none !important;
            font-weight: 800 !important;
            letter-spacing: -0.25px;
        }
        .stat-item .stat-label, .stat-label {
            color: #334155 !important; /* slate-700 */
            font-weight: 600;
        }
        /* Keep original decorative line/dot and layout (no glass card) */
        .stat-item::before { display: block !important; }
        .hero-stats {
            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;
            padding: 0 !important;
            box-shadow: none !important;
        }

        /* Slightly darken hero overlay to maintain overall contrast */
        .hero-overlay {
            background: linear-gradient(180deg,
                rgba(0, 63, 92, 0.10) 0%,
                rgba(0, 63, 92, 0.20) 30%,
                rgba(0, 63, 92, 0.30) 60%,
                rgba(0, 63, 92, 0.40) 100%) !important;
        }

        /* Footer layout tidy for mobile (scoped to modern footer) - unified left-aligned baseline */
        .modern-footer .footer-main {
            display: flex !important;
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 1.5rem !important;
        }
        .modern-footer .footer-brand,
        .modern-footer .footer-links,
        .modern-footer .footer-contact,
        .modern-footer .footer-cta {
            max-width: 560px !important;
            margin: 0 auto !important;
            padding: 0 1rem !important;
        }
    .modern-footer .footer-brand { text-align: left !important; }
    .modern-footer .footer-logo { justify-content: flex-start !important; }
    .modern-footer .social-links { justify-content: flex-start !important; flex-wrap: wrap !important; gap: 0.75rem !important; }
    .modern-footer .footer-links { text-align: left !important; }
        .modern-footer .footer-links h4,
        .modern-footer .footer-contact h4,
        .modern-footer .footer-cta h4 { margin-bottom: 0.85rem !important; }
        .modern-footer .footer-links ul {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            justify-items: start !important;
            align-items: start !important;
            row-gap: 0.9rem !important;
            column-gap: 1.25rem !important;
            margin: 0.5rem auto 0 !important;
            padding: 0 !important;
            max-width: 560px !important;
        }
        .modern-footer .footer-links ul li { width: 100% !important; }
        .modern-footer .footer-links ul li a {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.6rem !important;
            justify-content: flex-start !important;
            width: 100% !important;
            padding-left: 0 !important;
        }
        .modern-footer .footer-contact { text-align: left !important; }
        .modern-footer .contact-item {
            display: grid !important;
            grid-template-columns: 28px 1fr !important;
            gap: 0.75rem !important;
            align-items: start !important;
        }
        .modern-footer .contact-item i { margin-top: 0 !important; }
        .modern-footer .contact-item p { line-height: 1.6 !important; }
    .modern-footer .footer-cta { text-align: left !important; }
    .modern-footer .cta-button { display: inline-flex !important; justify-content: flex-start !important; }
        .modern-footer .footer-bottom { padding: 1.5rem 0 4.5rem !important; }
        .modern-footer .footer-bottom .footer-bottom-content {
            display: grid !important;
            grid-template-columns: 1fr !important;
            gap: 0.5rem !important;
            text-align: left !important;
            align-items: start !important;
            justify-items: start !important;
        }
        .modern-footer .footer-bottom-links {
            display: flex !important;
            gap: 1.25rem !important;
            flex-wrap: wrap !important;
            justify-content: flex-start !important;
        }
    }
  </style>
    <!-- Footer mobile layout tidy-up (layout only, no design changes, aligned with testimonial pages) -->
        <style>
            @media (max-width: 768px) {
                .modern-footer .footer-main {
                    display: grid !important;
                    grid-template-columns: 1fr !important;
                    gap: 1.25rem !important;
                }

                /* Keep a comfortable reading width and centered block, but left-align content like ulasan.php */
                        .modern-footer .footer-brand,
                        .modern-footer .footer-links,
                        .modern-footer .footer-contact,
                        .modern-footer .footer-cta {
                            max-width: 560px;
                            margin: 0 !important;          /* do not center the whole block */
                            margin-right: auto !important;  /* align to left like ulasan */
                            padding: 0 1rem;                /* keep pleasant side spacing */
                        }

                /* Brand stays centered */
                        .modern-footer .footer-brand { text-align: left; }
                .modern-footer .footer-logo {
                    display: flex;
                    align-items: center;
                            justify-content: flex-start;
                    gap: 0.75rem;
                }
                        .modern-footer .social-links {
                    display: flex;
                            justify-content: flex-start;
                    align-items: center;
                    gap: 0.75rem;
                    flex-wrap: wrap;
                    margin-top: 0.5rem;
                }
                        .modern-footer .footer-description {
                    max-width: 580px;
                            margin: 0.75rem 0 0;
                }

                /* Sections align left for clean reading, matching ulasan.php */
                .modern-footer .footer-links,
                .modern-footer .footer-contact,
                .modern-footer .footer-cta { text-align: left !important; }

                /* Ensure section headings are left-aligned like ulasan */
                .modern-footer .footer-links h4,
                .modern-footer .footer-contact h4,
                .modern-footer .footer-cta h4 { text-align: left !important; margin-left: 0 !important; }

                        /* Also align any decorative underline used by heading */
                        .modern-footer .footer-links h4::before,
                        .modern-footer .footer-links h4::after,
                        .modern-footer .footer-contact h4::before,
                        .modern-footer .footer-contact h4::after,
                        .modern-footer .footer-cta h4::before,
                        .modern-footer .footer-cta h4::after {
                            left: 0 !important;
                            right: auto !important;
                            margin: 0 !important;
                            transform: none !important;
                        }

                /* Links block */
                        .modern-footer .footer-links ul {
                    list-style: none;
                                    padding: 0 !important;
                            margin: 0.5rem 0 0 !important;
                            display: grid !important;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 0.5rem 0.75rem;
                            max-width: 100%;
                                    justify-items: start;
                                    align-items: start;
                }
                .modern-footer .footer-links li a {
                            display: inline-flex !important;
                            align-items: center !important;
                            gap: 0.5rem !important;
                            justify-content: flex-start !important;
                            width: 100% !important;
                            padding-left: 0 !important;
                }

                /* Contact block */
                        .modern-footer .contact-item {
                    display: grid;
                    grid-template-columns: 28px 1fr;
                    gap: 0.75rem;
                            justify-content: start !important;
                            text-align: left !important;
                            max-width: 100% !important;
                            margin: 0 !important;
                }

                /* CTA block */
                .modern-footer .footer-cta p {
                    max-width: 100%;
                    margin: 0.5rem 0 1rem;
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
            <!-- Mobile override: polished content layout for footer (headings centered, items neatly aligned) -->
            <style>
                @media (max-width: 768px) {
                    /* Section spacing */
                    .modern-footer .footer-brand,
                    .modern-footer .footer-links,
                    .modern-footer .footer-contact,
                    .modern-footer .footer-cta { margin-top: 0.25rem; }

                    /* Center headings for sections */
                    .modern-footer .footer-links { 
                        text-align: left !important; 
                        margin-left: auto !important; 
                        margin-right: auto !important; 
                        padding: 0 1rem; 
                        padding-top: 0.25rem; 
                    }
                    /* Normalize headings so all sections align perfectly */
                    .modern-footer .footer-links h4,
                    .modern-footer .footer-contact h4,
                    .modern-footer .footer-cta h4 {
                        display: block !important;
                        width: auto !important;
                        margin: 0 0 0.85rem !important;
                        text-align: left !important;
                    }
                    .modern-footer .footer-links h4::before,
                    .modern-footer .footer-links h4::after,
                    .modern-footer .footer-contact h4::before,
                    .modern-footer .footer-contact h4::after,
                    .modern-footer .footer-cta h4::before,
                    .modern-footer .footer-cta h4::after {
                        left: 0 !important;
                        right: auto !important;
                        transform: none !important;
                        margin: 0 !important;
                    }

                    /* Navigasi: two-column grid, left-aligned items, good tap targets */
                    .modern-footer .footer-links ul {
                        display: grid !important;
                        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                        justify-items: start !important;
                        align-items: start !important;
                        margin: 0.5rem auto 0 !important;
                        row-gap: 0.9rem !important;
                        column-gap: 1.25rem !important;
                        padding-top: 0.15rem !important;
                        padding-left: 0 !important;
                        max-width: 560px !important;
                        list-style: none !important;
                    }
                    .modern-footer .footer-links li { list-style: none !important; }
                    .modern-footer .footer-links li a {
                        display: inline-flex !important;
                        align-items: center !important;
                        justify-content: flex-start !important;
                        width: 100% !important;
                        gap: 0.6rem !important;
                        padding: 0.35rem 0.25rem !important;
                        text-align: left !important;
                        border-radius: 8px !important;
                    }

                    /* Contact: tidy rows, wrap long lines */
                    .modern-footer .footer-contact { padding: 0 1rem; margin-left: auto; margin-right: auto; }
                    .modern-footer .contact-item { margin-bottom: 0.75rem !important; }
                    .modern-footer .contact-item p,
                    .modern-footer .contact-item a,
                    .modern-footer .footer-contact .info-text { 
                        word-break: break-word; 
                        overflow-wrap: anywhere; 
                    }

                    /* CTA paragraph readable width */
                    .modern-footer .footer-cta p { 
                        max-width: 560px; 
                        margin-left: 0; 
                        margin-right: auto; 
                        text-align: left; 
                    }

                    /* Subtle: lighten particles so they don't distract content */
                    .modern-footer .footer-particle { opacity: 0.45 !important; }

                    /* Bottom bar: align to left rail for consistent rhythm */
                    .modern-footer .footer-bottom .footer-bottom-content {
                        text-align: left !important;
                        justify-items: start !important;
                        align-items: start !important;
                    }
                    .modern-footer .footer-bottom-links {
                        justify-content: flex-start !important;
                    }

                    /* Ultra-small screens: make Navigasi one column */
                    @media (max-width: 420px) {
                        .modern-footer .footer-links ul { grid-template-columns: 1fr !important; }
                    }
                }
            </style>
</head>

<body class="pln-testimonial-body">
    <!-- Modern Navigation Header -->
    <header class="modern-header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="nav-brand-link">
                    <div class="nav-brand">
                                            <img src="img/favicon.png" alt="PLN Logo" class="nav-logo">
                        <div class="brand-text">
                            <h3>PLN UID</h3>
                            <span>Sulselrabar</span>
                        </div>
                    </div>
                </a>
                
                <ul class="nav-menu" id="nav-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="ri-home-3-line"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_mhs/data_mahasiswa.php" class="nav-link">
                            <i class="ri-database-2-line"></i>
                            <span>Data Mahasiswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="permintaaan_srt/permintaan_srt.php" class="nav-link">
                            <i class="ri-mail-line"></i>
                            <span>Permintaan Surat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ulasan/ulasan.php" class="nav-link">
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
  
    <!-- Modern Hero Section -->
    <main>
        <section class="hero-section" id="home">
            <div class="hero-background">
                <div class="hero-overlay"></div>
                <div class="hero-particles" id="particles"></div>
                <div class="geometric-shapes"></div>
            </div>
            
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text" data-aos="fade-up" data-aos-duration="1000">
                        <div class="hero-badge">
                            <i class="ri-information-line"></i>
                            <span>Portal Informasi Magang</span>
                        </div>
                        
                        <h1 class="hero-title">
                            Sistem Informasi Magang
                            <span class="highlight hero-typewriter">PLN UID Sulselrabar</span>
                            - Portal Resmi
                        </h1>
                        
                        <p class="hero-description">
                            Sistem informasi magang PLN UID Sulselrabar. 
                            Cek status surat permohonan, unduh sertifikat, dan lihat informasi program magang.
                        </p>
                        
                        <div class="hero-stats">
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="stat-number" data-target="50">0</div>
                                <div class="stat-label">Peserta Magang</div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="stat-number" data-target="10">0</div>
                                <div class="stat-label">Sub Bidang</div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="600">
                                <div class="stat-number" data-target="98">0</div>
                                <div class="stat-label">Kepuasan</div>
                            </div>
                        </div>
                        
                        <div class="hero-buttons" data-aos="fade-up" data-aos-delay="800">
                            <a href="#services" class="btn btn-primary">
                                <i class="ri-information-line"></i>
                                Lihat Layanan
                            </a>
                            <a href="#about" class="btn btn-glass">
                                <i class="ri-building-line"></i>
                                Tentang PLN
                            </a>
                        </div>
                    </div>
                    
                    <div class="hero-visual" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                        <div class="hero-image-container">
<?php
    $heroSrc = 'img/gallery/praktiklapangan.jpg';
    $heroRow = $media['hero_main'] ?? null;
    if (is_array($heroRow)) {
        $heroFilename = isset($heroRow['filename']) ? $heroRow['filename'] : null;
        if (!empty($heroFilename)) {
            $heroSrc = 'img/media/uploads/' . rawurlencode($heroFilename);
        }
    }
?>
                            <img src="<?=$heroSrc?>" alt="PLN Internship" class="hero-image">
                            <div class="floating-cards">
                                <div class="floating-card card-1">
                                    <i class="ri-award-line"></i>
                                    <span>Sertifikat Resmi</span>
                                </div>
                                <div class="floating-card card-2">
                                    <i class="ri-team-line"></i>
                                    <span>Mentor Expert</span>
                                </div>
                                <div class="floating-card card-3">
                                    <i class="ri-building-line"></i>
                                    <span>Fasilitas Lengkap</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services-section" id="services">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="ri-service-line"></i>
                        <span>Layanan Kami</span>
                    </div>
                    <h2 class="section-title">Solusi Lengkap untuk Kebutuhan Magangmu</h2>
                    <p class="section-description">
                        Portal informasi lengkap untuk mengecek status surat, mengunduh sertifikat, dan melihat data program magang
                    </p>
                </div>
                
                <div class="services-grid">
                    <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-icon">
                            <i class="ri-database-2-line"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3>Data Mahasiswa</h3>
                        <p>Lihat dan kelola data peserta magang yang sedang aktif maupun yang telah menyelesaikan program</p>
                        <a href="data_mhs/data_mahasiswa.php" class="service-link">
                            <span>Lihat Data</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    
                    <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-icon">
                            <i class="ri-mail-line"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3>Permintaan Surat</h3>
                        <p>Cek status pengajuan surat magang dan unduh dokumen resmi yang telah disetujui</p>
                        <a href="permintaaan_srt/permintaan_srt.php" class="service-link">
                            <span>Cek Status</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    
                    <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-icon">
                            <i class="ri-award-line"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3>Sertifikat</h3>
                        <p>Dapatkan sertifikat resmi setelah menyelesaikan program magang dengan baik</p>
                        <a href="sertifikat/sertifikat.php" class="service-link">
                            <span>Unduh Sertifikat</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    
                    <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-icon">
                            <i class="ri-chat-3-line"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <h3>Ulasan & Testimoni</h3>
                        <p>Baca pengalaman peserta lain dan bagikan cerita magangmu untuk yang akan datang</p>
                        <a href="ulasan/ulasan.php" class="service-link">
                            <span>Lihat Ulasan</span>
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="container">
                <div class="about-content">
                    <div class="about-text" data-aos="fade-right">
                        <div class="section-badge">
                            <i class="ri-lightbulb-line"></i>
                            <span>Tentang Kami</span>
                        </div>
                        <h2>Mengapa Memilih PLN UID Sulselrabar?</h2>
                        <p>
                            Magang di PT PLN (Persero) UID Sulselrabar memberikan pengalaman langsung 
                            di dunia kerja profesional, keterlibatan dalam proyek nyata, serta kesempatan 
                            belajar dari para ahli di industri energi.
                        </p>
                        
                        <div class="about-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-team-line"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Mentor Berpengalaman</h4>
                                    <p>Dibimbing langsung oleh profesional berpengalaman di bidangnya</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-building-line"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Fasilitas Modern</h4>
                                    <p>Akses ke teknologi dan fasilitas terdepan di industri energi</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-award-line"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Sertifikat Resmi</h4>
                                    <p>Dapatkan sertifikat yang diakui industri untuk portfolio karier</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="data_mhs/data_mhs_magang.php" class="service-link">
                            <span>Lihat Data Peserta</span>
                            <i class="ri-eye-line"></i>
                        </a>
                    </div>
                    
                    <div class="about-visual" data-aos="fade-left">
                        <div class="about-image-container">
<?php
    $aboutSrc = 'img/bg 2.jpg';
    $aboutRow = $media['about_main'] ?? null;
    if (is_array($aboutRow)) {
        $aboutFilename = isset($aboutRow['filename']) ? $aboutRow['filename'] : null;
        if (!empty($aboutFilename)) {
            $aboutSrc = 'img/media/uploads/' . rawurlencode($aboutFilename);
        }
    }
?>
                            <img src="<?=$aboutSrc?>" alt="PLN Office" class="about-image">
                            <div class="experience-card">
                                <div class="experience-icon">
                                    <i class="ri-trophy-line"></i>
                                </div>
                                <div class="experience-content">
                                    <h3>25+</h3>
                                    <p>Tahun Pengalaman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Magang Section -->
        <section class="gallery-section" id="gallery">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="ri-camera-line"></i>
                        <span>Galeri Pengalaman</span>
                    </div>
                    <h2 class="section-title">Momen Magang di PLN Sulselrabar</h2>
                    <p class="section-description">
                        Saksikan pengalaman nyata peserta magang yang sedang menjalani program di PLN UID Sulselrabar
                    </p>
                </div>
                
                <div class="gallery-container" data-aos="fade-up" data-aos-delay="200">
<?php
$dynamicRows = [[], []];
$hasDb = isset($koneksi) && $koneksi;
if ($hasDb) {
    $res = mysqli_query($koneksi, "SELECT title, caption, filename FROM gallery_photos WHERE is_active=1 ORDER BY sort_order, id LIMIT 16");
    if ($res) {
        $photos = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $photos[] = $row;
        }
        $count = count($photos);
        if ($count > 0) {
            // Split roughly half for two rows
            $half = (int) ceil($count / 2);
            $dynamicRows[0] = array_slice($photos, 0, $half);
            $dynamicRows[1] = array_slice($photos, $half);
        }
    }
}
function render_gallery_row($items) {
    if (!$items || count($items) === 0) return '';
    $html = '';
    foreach ($items as $it) {
        $title = htmlspecialchars($it['title'] ?: 'Momen Magang', ENT_QUOTES, 'UTF-8');
        $cap = htmlspecialchars($it['caption'] ?: 'Pengalaman di PLN', ENT_QUOTES, 'UTF-8');
        $src = 'img/gallery/uploads/' . rawurlencode($it['filename']);
        $html .= "                            <div class=\"gallery-item\">\n";
        $html .= "                                <img src=\"{$src}\" alt=\"{$title}\" loading=\"lazy\">\n";
        $html .= "                                <div class=\"gallery-overlay\">\n";
        $html .= "                                    <div class=\"gallery-info\">\n";
        $html .= "                                        <h4>{$title}</h4>\n";
        $html .= "                                        <p>{$cap}</p>\n";
        $html .= "                                    </div>\n";
        $html .= "                                </div>\n";
        $html .= "                            </div>\n";
    }
    // Duplicate once for seamless scroll
    $html .= $html;
    return $html;
}
?>
                    <!-- Gallery Row 1 - Scroll Right -->
                    <div class="gallery-row gallery-row-right">
                        <div class="gallery-track" id="gallery-track-1">
<?php if (!empty($dynamicRows[0])): ?>
<?= render_gallery_row($dynamicRows[0]); ?>
<?php else: ?>
                            <!-- Fallback static items -->
                            <div class="gallery-item">
                                <img src="img/gallery/praktik22.jpg" alt="Praktik Lapangan" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Praktik Lapangan</h4>
                                        <p>Pengalaman langsung di fasilitas PLN</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/mentor1.jpg" alt="Mentoring Session" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Mentoring Session</h4>
                                        <p>Bimbingan dari professional berpengalaman</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/colab2.jpg" alt="Team Building" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Team Building</h4>
                                        <p>Kolaborasi antar peserta magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/presen2.jpg" alt="Presentasi Proyek" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Presentasi Proyek</h4>
                                        <p>Showcase hasil kerja magang</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Duplicate for seamless loop -->
                            <div class="gallery-item">
                                <img src="img/gallery/praktik22.jpg" alt="Praktik Lapangan" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Praktik Lapangan</h4>
                                        <p>Pengalaman langsung di fasilitas PLN</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/mentor1.jpg" alt="Mentoring Session" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Mentoring Session</h4>
                                        <p>Bimbingan dari professional berpengalaman</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/colab2.jpg" alt="Team Building" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Team Building</h4>
                                        <p>Kolaborasi antar peserta magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/presen2.jpg" alt="Presentasi Proyek" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Presentasi Proyek</h4>
                                        <p>Showcase hasil kerja magang</p>
                                    </div>
                                </div>
                            </div>
<?php endif; ?>
                        </div>
                    </div>

                    <!-- Gallery Row 2 - Scroll Left -->
                    <div class="gallery-row gallery-row-left">
                        <div class="gallery-track" id="gallery-track-2">
<?php if (!empty($dynamicRows[1])): ?>
<?= render_gallery_row($dynamicRows[1]); ?>
<?php else: ?>
                            <!-- Fallback static items -->
                            <div class="gallery-item">
                                <img src="img/gallery/colab1.jpg" alt="Team Building" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Team Building</h4>
                                        <p>Kolaborasi antar peserta magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/presen1.jpg" alt="Presentasi Proyek" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Presentasi Proyek</h4>
                                        <p>Showcase hasil kerja magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/praktiklapangan.jpg" alt="Praktik Lapangan" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Praktik Lapangan</h4>
                                        <p>Pengalaman langsung di fasilitas PLN</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/mentor3.jpg" alt="Mentoring Session" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Mentoring Session</h4>
                                        <p>Bimbingan dari professional berpengalaman</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Duplicate for seamless infinite loop -->
                            <div class="gallery-item">
                                <img src="img/gallery/colab1.jpg" alt="Team Building" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Team Building</h4>
                                        <p>Kolaborasi antar peserta magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/presen1.jpg" alt="Presentasi Proyek" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Presentasi Proyek</h4>
                                        <p>Showcase hasil kerja magang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/praktiklapangan.jpg" alt="Praktik Lapangan" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Praktik Lapangan</h4>
                                        <p>Pengalaman langsung di fasilitas PLN</p>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="img/gallery/mentor3.jpg" alt="Mentoring Session" loading="lazy">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <h4>Mentoring Session</h4>
                                        <p>Bimbingan dari professional berpengalaman</p>
                                    </div>
                                </div>
                            </div>
<?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="gallery-cta" data-aos="fade-up" data-aos-delay="400">
                    <p>Pengalaman nyata dari peserta magang PLN UID Sulselrabar yang telah menjalani program dengan sukses</p>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="process-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="ri-information-line"></i>
                        <span>Informasi Magang</span>
                    </div>
                    <h2 class="section-title">Panduan Lengkap Program Magang</h2>
                    <p class="section-description">
                        Informasi lengkap tentang proses magang di PLN UID Sulselrabar
                    </p>
                </div>
                
                <div class="process-timeline">
                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                        <div class="timeline-number">01</div>
                        <div class="timeline-content">
                            <div class="timeline-icon">
                                <i class="ri-file-text-line"></i>
                            </div>
                            <h3>Persyaratan Dokumen</h3>
                            <p>Dokumen yang diperlukan untuk mengajukan permohonan magang</p>
                            <ul class="timeline-checklist">
                                <li><i class="ri-check-line"></i> Surat ditandatangani pihak kampus</li>
                                <li><i class="ri-check-line"></i> CV format ATS-friendly</li>
                                <li><i class="ri-check-line"></i> Rencana kegiatan magang</li>
                                <li><i class="ri-check-line"></i> Kemampuan Microsoft Office</li>
                            </ul>
                            <div class="timeline-downloads">
                                <a href="contoh_surat/Template_Surat_Permohonan_Magang.pdf" class="download-link">
                                    <i class="ri-download-line"></i>
                                    Template Surat
                                </a>
                                <a href="contoh_surat/template_CV_ATS (1).pdf" class="download-link">
                                    <i class="ri-download-line"></i>
                                    Template CV
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="timeline-number">02</div>
                        <div class="timeline-content">
                            <div class="timeline-icon">
                                <i class="ri-building-2-line"></i>
                            </div>
                            <h3>Prosedur Pengajuan</h3>
                            <p>Tata cara pengajuan permohonan magang ke PLN UID Sulselrabar</p>
                            <div class="office-info">
                                <div class="info-item">
                                    <i class="ri-map-pin-line"></i>
                                    <div>
                                        <strong>Alamat:</strong>
                                        <p>Jl. Letjen Hertasning No.Blok B 90222 Makassar, Sulawesi Selatan</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="ri-time-line"></i>
                                    <div>
                                        <strong>Jam Operasional:</strong>
                                        <p>09.00 - 15.00 WITA (Senin - Jumat)</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="ri-calendar-line"></i>
                                    <div>
                                        <strong>Deadline:</strong>
                                        <p>Maksimal 2 minggu sebelum tanggal pelaksanaan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="timeline-number">03</div>
                        <div class="timeline-content">
                            <div class="timeline-icon">
                                <i class="ri-search-line"></i>
                            </div>
                            <h3>Cek Status & Sertifikat</h3>
                            <p>Monitor status permohonan dan unduh sertifikat melalui website ini</p>
                            <div class="status-features">
                                <div class="status-feature">
                                    <i class="ri-notification-line"></i>
                                    <span>Notifikasi real-time</span>
                                </div>
                                <div class="status-feature">
                                    <i class="ri-download-cloud-line"></i>
                                    <span>Download otomatis</span>
                                </div>
                                <div class="status-feature">
                                    <i class="ri-shield-check-line"></i>
                                    <span>Proses maksimal 1 minggu</span>
                                </div>
                            </div>
                            <div class="timeline-downloads">
                                <a href="permintaaan_srt/permintaan_srt.php" class="download-link">
                                    <i class="ri-search-line"></i>
                                    Cek Status Surat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Modern Footer -->
    <footer class="modern-footer">
        <!-- Footer Particles Background -->
        <div class="footer-particles" id="footerParticles">
            <!-- Particles will be generated by JavaScript -->
        </div>
        
        <div class="footer-content">
            <div class="container">
                <div class="footer-main">
                    <div class="footer-brand" data-aos="fade-up">
                        <div class="footer-logo">
                                                    <img src="img/favicon.png" alt="PLN Logo">
                            <div class="brand-info">
                                <h3>PLN UID Sulselrabar</h3>
                                <p>Sistem Magang Professional</p>
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
                            <a href="https://www.threads.com/@pln_sulselrabar" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Threads">
                                <img src="img/threads-seeklogo.png" alt="Threads logo">
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
                            <li><a href="#"><i class="ri-home-3-line"></i> Beranda</a></li>
                            <li><a href="data_mhs/data_mahasiswa.php"><i class="ri-database-2-line"></i> Data Mahasiswa</a></li>
                            <li><a href="permintaaan_srt/permintaan_srt.php"><i class="ri-mail-line"></i> Permintaan Surat</a></li>
                            <li><a href="ulasan/ulasan.php"><i class="ri-chat-3-line"></i> Ulasan</a></li>
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
                        <h4>Informasi Magang PLN</h4>
                        <p>Dapatkan informasi lengkap tentang program magang dan cek status permohonan Anda melalui sistem kami.</p>
                        <a href="permintaaan_srt/permintaan_srt.php" class="cta-button">
                            <i class="ri-information-line"></i>
                            Cek Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 PT PLN (Persero) UID Sulselrabar. All Rights Reserved. | Versi 2.0.0</p>
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

    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="java_script/ultra-modern.js"></script>
    <script src="java_script/mobile-header.js"></script>
    
    <script>
        // Simple initialization - main functionality is in ultra-modern.js
        console.log('🚀 PLN Ultra Modern Website Loading...');
        
        // Scroll Progress Indicator
        function updateScrollProgress() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            const progressBar = document.getElementById('scrollProgress');
            if (progressBar) {
                progressBar.style.width = scrollPercent + '%';
            }
        }

        // Update progress on scroll
        window.addEventListener('scroll', updateScrollProgress);
        
        // Initialize progress on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateScrollProgress();
            createFooterParticles();
        });
        
        // Create Footer Particles
        function createFooterParticles() {
            const particleContainer = document.getElementById('footerParticles');
            if (!particleContainer) return;
            
            // Create 20 particles
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'footer-particle';
                
                // Random horizontal position
                particle.style.left = Math.random() * 100 + '%';
                
                // Random animation delay
                particle.style.animationDelay = Math.random() * 8 + 's';
                
                // Random animation duration
                particle.style.animationDuration = (Math.random() * 4 + 8) + 's';
                
                // Add to container
                particleContainer.appendChild(particle);
            }
        }
        
        // Optional: Add particle interaction on footer hover
        document.addEventListener('DOMContentLoaded', function() {
            const footer = document.querySelector('.modern-footer');
            if (footer) {
                footer.addEventListener('mouseenter', function() {
                    const particles = document.querySelectorAll('.footer-particle');
                    particles.forEach(particle => {
                        particle.style.animationPlayState = 'running';
                        particle.style.opacity = '1';
                    });
                });
                
                footer.addEventListener('mouseleave', function() {
                    const particles = document.querySelectorAll('.footer-particle');
                    particles.forEach(particle => {
                        particle.style.opacity = '0.7';
                    });
                });
            }
        });
    </script>

    
</body>
</html>