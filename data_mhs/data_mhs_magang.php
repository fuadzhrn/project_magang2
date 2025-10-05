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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- JS Library Tambahan -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <title>Data Mahasiswa Magang</title>
</head>
                  

<body>
    <!-- Modern Navigation Header -->
    <header class="modern-header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="nav-brand-link" aria-label="Kembali ke Beranda">
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
                        <a href="../data_mhs/data_mahasiswa.php" class="nav-link active">
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

    <!-- Compact Data Header -->
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
                        <a href="data_mahasiswa.php">
                            <i class="ri-database-2-line"></i>
                            Data Mahasiswa
                        </a>
                        <span class="separator">
                            <i class="ri-arrow-right-s-line"></i>
                        </span>
                        <span class="current">Data Peserta Magang</span>
                    </nav>
                    
                    <div class="page-badge">
                        <i class="ri-team-line"></i>
                        <span>Database Peserta</span>
                    </div>
                    
                    <h1 class="page-title">Data Peserta Magang</h1>
                    <p class="page-subtitle">
                        Kelola dan pantau data peserta program magang & PKL PT PLN UID Sulselrabar
                    </p>
                    
                    <?php
                    include "../admin/config/koneksi.php";
                    $queryAktif = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang WHERE status = 'Aktif'");
                    $queryTotal = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang");
                    $querySelesai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang WHERE status = 'Selesai'");
                    
                    $jumlahAktif = mysqli_fetch_assoc($queryAktif)['total'];
                    $jumlahTotal = mysqli_fetch_assoc($queryTotal)['total'];
                    $jumlahSelesai = mysqli_fetch_assoc($querySelesai)['total'];
                    ?>
                    
                    <!-- Compact Statistics -->
                    <div class="data-stats-compact" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-compact">
                            <div class="stat-icon active">
                                <i class="ri-play-circle-line"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-number"><?= $jumlahAktif ?></span>
                                <span class="stat-label">Aktif</span>
                            </div>
                        </div>
                        <div class="stat-compact">
                            <div class="stat-icon total">
                                <i class="ri-team-line"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-number"><?= $jumlahTotal ?></span>
                                <span class="stat-label">Total</span>
                            </div>
                        </div>
                        <div class="stat-compact">
                            <div class="stat-icon completed">
                                <i class="ri-check-circle-line"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-number"><?= $jumlahSelesai ?></span>
                                <span class="stat-label">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        <!-- Modern Data Table Section -->
        <section class="services-section" id="data-table" style="background: var(--bg-secondary);">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="ri-table-line"></i>
                        <span>Tabel Data</span>
                    </div>
                    <h2 class="section-title">Data Peserta Magang & PKL</h2>
                    <p class="section-description">
                        Tabel lengkap data peserta program magang dan praktik kerja lapangan
                    </p>
                </div>
                
                <div class="service-card glass" data-aos="fade-up" style="margin: 0 auto; padding: 2rem;">
                    <div class="table-header-modern">
                        <div class="table-info">
                            <h3><i class="ri-database-2-line"></i> Database Peserta</h3>
                            <p>Total data: <span id="totalRecords"><?= $jumlahTotal ?></span> peserta</p>
                            <div class="table-metrics">
                                <span class="metric-badge active">
                                    <i class="ri-play-circle-line"></i>
                                    Aktif: <strong id="countAktif"><?= $jumlahAktif ?></strong>
                                </span>
                                <span class="metric-badge completed">
                                    <i class="ri-check-circle-line"></i>
                                    Selesai: <strong id="countSelesai"><?= $jumlahSelesai ?></strong>
                                </span>
                            </div>
                        </div>
                        <div class="table-actions">
                            <button class="btn btn-outline toggle-filter-btn" id="toggleFilter">
                                <i class="ri-filter-3-line"></i>
                                Filter
                            </button>
                            <button class="btn btn-primary export-btn">
                                <i class="ri-download-line"></i>
                                Export Data
                            </button>
                        </div>
                    </div>
                    
                    <!-- Integrated Filter Panel -->
                    <div class="integrated-filter-panel" id="filterPanel" style="display: none;">
                        <div class="filter-panel-header">
                            <div class="filter-title">
                                <i class="ri-filter-3-line"></i>
                                <span>Filter Data Peserta</span>
                            </div>
                            <button class="filter-close-btn" id="closeFilter">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                        
                        <div class="integrated-filter-grid">
                            <div class="filter-group-integrated">
                                <label for="filterBidang"><i class="ri-building-line"></i> Bidang</label>
                                <select id="filterBidang" class="filter-select-integrated">
                                    <option value="">Semua Bidang</option>
                                    <option value="umum">Umum</option>
                                    <option value="sti">STI</option>
                                    <option value="hc">HC</option>
                                    <option value="htd">HTD</option>
                                    <option value="Pengadaan">Pengadaan</option>
                                    <option value="Komunikasi">Komunikasi</option>
                                    <option value="Keuangan&Akutansi">Keuangan & Akuntansi</option>
                                    <option value="Perencanaan">Perencanaan</option>
                                    <option value="distribusi&up2k">Distribusi & UP2K</option>
                                    <option value="Niaga">Niaga</option>
                                    <option value="K3">K3</option>
                                </select>
                            </div>

                            <div class="filter-group-integrated">
                                <label for="filterMasuk"><i class="ri-calendar-line"></i> Tgl Masuk</label>
                                <input type="date" id="filterMasuk" class="filter-input-integrated">
                            </div>

                            <div class="filter-group-integrated">
                                <label for="filterKeluar"><i class="ri-calendar-check-line"></i> Tgl Keluar</label>
                                <input type="date" id="filterKeluar" class="filter-input-integrated">
                            </div>

                            <div class="filter-group-integrated">
                                <label for="filterStatus"><i class="ri-information-line"></i> Status</label>
                                <select id="filterStatus" class="filter-select-integrated">
                                    <option value="">Semua Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Belum Aktif">Belum Aktif</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="filter-panel-actions">
                            <button class="btn-reset-integrated reset-filters-btn">
                                <i class="ri-refresh-line"></i>
                                Reset Filter
                            </button>
                            <button class="btn-apply-integrated" id="applyFilter">
                                <i class="ri-check-line"></i>
                                Terapkan Filter
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-wrapper-modern">
                        <table id="tabelMagang" class="table-modern">
                            <thead>
                                <tr>
                                    <th><i class="ri-hash"></i> No</th>
                                    <th><i class="ri-building-line"></i> Bidang</th>
                                    <th><i class="ri-calendar-line"></i> Tgl Masuk</th>
                                    <th><i class="ri-calendar-check-line"></i> Tgl Keluar</th>
                                    <th><i class="ri-information-line"></i> Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../admin/config/koneksi.php";
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "
                                  SELECT pm.*, sb.nama_bidang 
                                  FROM peserta_magang pm
                                  JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
                                  ORDER BY pm.id_mahasiswa DESC
                                ");
                                while ($data = mysqli_fetch_array($tampil)) :
                                ?>
                                  <tr class="table-row-modern">
                                    <td class="text-center">
                                        <div class="number-cell">
                                            <?= $no++ ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bidang-cell-modern">
                                            <div class="bidang-icon">
                                                <i class="ri-building-line"></i>
                                            </div>
                                            <div class="bidang-info">
                                                <span class="bidang-name"><?= htmlspecialchars($data['nama_bidang']) ?></span>
                                                <span class="bidang-code"><?= strtoupper(substr($data['nama_bidang'], 0, 3)) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-cell-modern">
                                            <i class="ri-calendar-line"></i>
                                            <span><?= date('d/m/Y', strtotime($data['tgl_masuk'])) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-cell-modern">
                                            <i class="ri-calendar-check-line"></i>
                                            <span><?= date('d/m/Y', strtotime($data['tgl_keluar'])) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($data['status'] == 'Aktif'): ?>
                                          <span class="status-badge status-active">
                                              <i class="ri-play-circle-line"></i>
                                              Aktif
                                          </span>
                                        <?php elseif ($data['status'] == 'Selesai'): ?>
                                          <span class="status-badge status-completed">
                                              <i class="ri-check-circle-line"></i>
                                              Selesai
                                          </span>
                                        <?php elseif ($data['status'] == 'Belum Aktif'): ?>
                                          <span class="status-badge status-pending">
                                              <i class="ri-time-line"></i>
                                              Belum Aktif
                                          </span>
                                        <?php endif; ?>
                                    </td>
                                  </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
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
                            <span>Data Peserta Magang</span>
                        </div>
                    </div>
                    
                    <div class="footer-nav">
                        <a href="../index.php" class="footer-nav-link">
                            <i class="ri-home-3-line"></i>
                            Beranda
                        </a>
                        <a href="data_mahasiswa.php" class="footer-nav-link">
                            <i class="ri-database-2-line"></i>
                            Menu Data
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
    
    <!-- Enhanced DataTable Script with Modern Features -->
    <script>
        $(document).ready(function () {
            console.log('🚀 PLN Data Peserta Magang Ultra Modern Loading...');
            
            // Integrated Filter Panel Controls
            const toggleFilterBtn = $('#toggleFilter');
            const filterPanel = $('#filterPanel');
            const closeFilterBtn = $('#closeFilter');
            const applyFilterBtn = $('#applyFilter');
            
            // Toggle Filter Panel
            toggleFilterBtn.on('click', function() {
                filterPanel.slideToggle(300);
                $(this).toggleClass('active');
                
                if ($(this).hasClass('active')) {
                    $(this).find('i').removeClass('ri-filter-3-line').addClass('ri-filter-3-fill');
                } else {
                    $(this).find('i').removeClass('ri-filter-3-fill').addClass('ri-filter-3-line');
                }
            });
            
            // Close Filter Panel
            closeFilterBtn.on('click', function() {
                filterPanel.slideUp(300);
                toggleFilterBtn.removeClass('active');
                toggleFilterBtn.find('i').removeClass('ri-filter-3-fill').addClass('ri-filter-3-line');
            });
            
            // Apply Filter Button (optional - filters work in real-time)
            applyFilterBtn.on('click', function() {
                filterPanel.slideUp(300);
                toggleFilterBtn.removeClass('active');
                toggleFilterBtn.find('i').removeClass('ri-filter-3-fill').addClass('ri-filter-3-line');
                
                // Visual feedback
                $(this).addClass('btn-loading');
                setTimeout(() => {
                    $(this).removeClass('btn-loading');
                }, 500);
            });
            
            // Initialize Enhanced DataTable with Modern Styling
            var table = $('#tabelMagang').DataTable({
                pageLength: 10,
                lengthChange: true,
                info: true,
                searching: true,
                responsive: true,
                language: {
                    search: "Cari data:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Selanjutnya"
                    },
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    emptyTable: "Tidak ada data tersedia"
                },
                drawCallback: function() {
                    // Animate table rows with modern effects
                    $(this.api().table().body()).find('tr').each(function(index) {
                        $(this).css({
                            opacity: 0,
                            transform: 'translateX(-20px)'
                        }).delay(index * 50).animate({
                            opacity: 1
                        }, 400, function() {
                            $(this).css('transform', 'translateX(0)');
                        });
                    });
                    // Update counters on every draw (search/paginate/filter)
                    updateFilterStats();
                }
            });

            // Modern Filter Functions
            function animateFilter(element) {
                element.addClass('filter-active');
                setTimeout(() => {
                    element.removeClass('filter-active');
                }, 300);
            }

            $('#filterBidang').on('change', function () {
                animateFilter($(this));
                table.column(1).search(this.value).draw();
                updateFilterStats();
            });

            $('#filterMasuk').on('change', function () {
                animateFilter($(this));
                if (this.value) {
                    var searchDate = this.value.split('-').reverse().join('/');
                    table.column(2).search(searchDate).draw();
                } else {
                    table.column(2).search('').draw();
                }
                updateFilterStats();
            });

            $('#filterKeluar').on('change', function () {
                animateFilter($(this));
                if (this.value) {
                    var searchDate = this.value.split('-').reverse().join('/');
                    table.column(3).search(searchDate).draw();
                } else {
                    table.column(3).search('').draw();
                }
                updateFilterStats();
            });

            $('#filterStatus').on('change', function () {
                animateFilter($(this));
                var statusFilter = this.value;
                if (statusFilter === '') {
                    table.column(4).search('').draw();
                } else {
                    table.column(4).search(statusFilter, true, false).draw();
                }
                updateFilterStats();
            });

            // Reset Filters Function
            $('.reset-filters-btn').on('click', function() {
                $('#filterBidang, #filterStatus').val('');
                $('#filterMasuk, #filterKeluar').val('');
                table.search('').columns().search('').draw();
                
                // Visual feedback
                $(this).addClass('btn-loading');
                setTimeout(() => {
                    $(this).removeClass('btn-loading');
                }, 500);
            });

            // Update filter statistics + status counters (Aktif/Selesai) based on visible rows
            function updateFilterStats() {
                const visibleRows = table.rows({search: 'applied'}).count();
                const totalRows = table.rows().count();
                $('#totalRecords').text(visibleRows);

                // Count statuses from the Status column (index 4)
                let aktif = 0, selesai = 0;
                table.column(4, { search: 'applied' }).nodes().each(function(td) {
                    const txt = $(td).text().trim().toLowerCase();
                    if (txt.includes('selesai')) {
                        selesai++;
                    } else if (txt.includes('aktif') && !txt.includes('belum')) {
                        aktif++;
                    }
                });
                $('#countAktif').text(aktif);
                $('#countSelesai').text(selesai);

                if (visibleRows !== totalRows) {
                    console.log(`Filter applied: showing ${visibleRows} of ${totalRows} records (Aktif: ${aktif}, Selesai: ${selesai})`);
                }
            }

            // Initialize counters once after table is ready
            updateFilterStats();

            // Enhanced Export functionality
            $('.export-btn').on('click', function() {
                // Modern export animation
                $(this).addClass('btn-loading');
                setTimeout(() => {
                    $(this).removeClass('btn-loading');
                    alert('Fitur export akan segera tersedia dengan format modern!');
                }, 1000);
            });

            // Enhanced Row Interactions with Modern Effects
            $('#tabelMagang tbody').on('click', '.table-row-modern', function() {
                // Modern row selection effect
                $('.table-row-modern').removeClass('row-selected');
                $(this).addClass('row-selected');
                
                // Extract row data for modern interaction
                const bidang = $(this).find('.bidang-name').text();
                const status = $(this).find('.status-badge').text().trim();
                
                console.log(`Selected: ${bidang} - Status: ${status}`);
            });

            // Status Badge Hover Effects
            $('.status-badge').hover(
                function() {
                    $(this).addClass('status-hover');
                },
                function() {
                    $(this).removeClass('status-hover');
                }
            );

            // Smooth scroll to sections
            $('.btn[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $($(this).attr('href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800);
                }
            });

            // Initialize modern interactions
            setTimeout(() => {
                console.log('✨ Modern Data Table initialized successfully');
            }, 1000);
        });

        // Add modern interaction styles
        const modernStyles = `
            <style>
                .filter-active {
                    transform: scale(1.02);
                    border-color: var(--pln-accent) !important;
                    box-shadow: 0 0 0 3px rgba(15, 178, 190, 0.2);
                }
                
                .btn-loading {
                    position: relative;
                    pointer-events: none;
                }
                
                .btn-loading::after {
                    content: '';
                    position: absolute;
                    width: 16px;
                    height: 16px;
                    margin: auto;
                    border: 2px solid transparent;
                    border-top-color: #ffffff;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                }
                
                .row-selected {
                    background: rgba(15, 178, 190, 0.1) !important;
                    border: 1px solid rgba(15, 178, 190, 0.3);
                }
                
                .status-hover {
                    transform: scale(1.1);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                }
                
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>
        `;
        
        document.head.insertAdjacentHTML('beforeend', modernStyles);
    </script>
    <style>
        /* Compact metrics for counts next to total */
        /* Keep brand link visual consistent and without underline */
        .nav-brand-link { text-decoration: none !important; color: inherit !important; display: inline-flex; align-items: center; }
        .nav-brand-link:hover, .nav-brand-link:focus { text-decoration: none; outline: none; }

        .table-metrics {
            display: flex;
            gap: .75rem;
            margin-top: .5rem;
            flex-wrap: wrap;
        }
        .metric-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .35rem .6rem;
            border-radius: .75rem;
            font-size: .9rem;
            font-weight: 600;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
            background: #ffffffcc;
            backdrop-filter: blur(6px);
        }
        .metric-badge i { font-size: 1rem; }
        .metric-badge.active {
            color: #16a34a; /* green */
            border-color: rgba(22,163,74,0.25);
            background: rgba(22,163,74,0.08);
        }
        .metric-badge.completed {
            color: #0ea5e9; /* sky */
            border-color: rgba(14,165,233,0.25);
            background: rgba(14,165,233,0.08);
        }
        .metric-badge strong { font-weight: 800; }
    </style>

    
</body>
</html>