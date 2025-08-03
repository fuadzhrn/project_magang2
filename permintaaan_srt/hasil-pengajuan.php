<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/mhs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/permintaan-srt.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../img/favicon.png">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Hasil Pengajuan</title>
</head>
<body>
        <?php
        include "../admin/config/koneksi.php"; // Pastikan path sesuai

        // Cek jika form dikirim via GET
        if (
        isset($_GET['nomor_surat']) &&
        isset($_GET['nama_pengirim']) &&
        isset($_GET['asal_instansi']) &&
        !empty($_GET['nomor_surat']) &&
        !empty($_GET['nama_pengirim']) &&
        !empty($_GET['asal_instansi'])
        ) {
            // Konversi ke huruf besar semua (agar case-insensitive)
        $nomor_surat = strtoupper(trim(mysqli_real_escape_string($koneksi, $_GET['nomor_surat'])));
        $nama_pengirim = strtoupper(trim(mysqli_real_escape_string($koneksi, $_GET['nama_pengirim'])));
        $asal_instansi = strtoupper(trim(mysqli_real_escape_string($koneksi, $_GET['asal_instansi'])));

        // Query pencocokan huruf besar semua
        $query = mysqli_query($koneksi, "
            SELECT * FROM balasan_surat 
            WHERE 
                UPPER(nomor_surat) = '$nomor_surat' AND 
                UPPER(nama_pengirim) = '$nama_pengirim' AND 
                UPPER(asal_instansi) = '$asal_instansi'
        ");

        $data = mysqli_fetch_assoc($query);
    }
        
        ?>
    <div class="header">
            <nav>
        <ul>
            <li>
                <i class="ri-home-3-line"></i>
                <a href="../index.php">Beranda</a>
            </li>
            <li>
                <i class="ri-database-2-line"></i>
                <a  href="../data_mhs/data_mahasiswa.php">Data Mahasiswa</a>
            </li>
            <li>
                <i class="ri-mail-line"></i>
                <a class="active" href="../permintaaan_srt/permintaan_srt.php">Permintaan Surat</a>
            </li>
            <li>
                <i class="ri-information-2-line"></i>
                <a href="../ulasan/ulasan.php">Ulasan</a>
            </li>
        </ul>
    </nav>
    <div class="box menu-bar">
                    <i class="ri-menu-3-fill" style="color: white;"></i>
                </div>
    </div>
     <section class="section-oval">
  <div class="isi-oval">
    <h2>
      Hasil Pengajuan Permohonan Magang
    </h2>
  </div>
 
</section>
                <?php if (isset($data) && $data): ?>
                <!-- Jika ditemukan -->
                <section class="konten-pengajuan">
                    <p>Dokumen hasil pengajuan kamu telah tersedia.</p>
                    <a href="../admin/file_balasan/<?= urlencode($data['file_pdf']) ?>" target="_blank">
                    <button class="btn-periksa">Unduh</button>
                    </a>
                </section>
                <?php else: ?>
                <section class="konten-pengajuan">
                    <p> <strong>Maaf!</strong> Nomor surat yang Anda masukkan tidak ditemukan. <br> Pastikan nomor sudah benar atau hubungi pihak admin.</p>
                    <p>Periksa juga apakah nama Anda tercantum sebagai nama pertama dalam surat tersebut,.</p>
                </section>
                <?php endif; ?>


                <section class="permintaan-srt2">
                <h1 class="bg-text-kanan2">Internship</h1>
                <img src="/img/Group-15.png" alt="Logo" class="bg-img-kanan2" />
                <img src="/img/Froup-15.png" alt="Logo" class="bg-img-kiri2" />
                </section>

     <footer class="footer">
            <div class="blur-kanan"></div>
        <div class="footer-kiri">
            <div class="footer-section">
            <h4>Sitemap</h4>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="../data_mhs/data_mahasiswa.php">Data Mahasiswa</a></li>
                <li><a href="../permintaaan_srt/permintaan_srt.php">Permintaan Surat</a></li>
                <li><a href="../ulasan/ulasan.php">Ulasan</a></li>
            </ul>
            </div>
            <div class="footer-section">
            <h4>Kontak</h4>
            <p>fuadzahran64@gmail.com</p>
            </div>
        </div>

        <div class="footer-kanan">
            <h3>Hubungi Kami</h3>
            <p>Makassar, Indonesia</p>
            <p><strong>Jl. Letjen Hertasning No.Blok B 90222 Makassar Sulawesi</strong></p>
        </div>

        <div class="footer-bawah">
            <p>© 2025, PT PLN (Persero) UID Sulselrabar. All Rights Reserved.</p>
        </div>
        </footer>
    
</body>
<script src="../java_script/script.js"></script>
</html>