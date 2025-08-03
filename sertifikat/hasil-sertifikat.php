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
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/sertfikat.css?v=<?php echo time(); ?>">
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
    <title>Hasil Sertifikat</title>
</head>
<body>
        
        
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
              <a href="../permintaaan_srt/permintaan_srt.php">Permintaan Surat</a>
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

        <section class="sertifikat">
  <div class="container-sertifikat">
    
    <div class="header-sertifikat">
      <img src="../img/sertifikat2.png" alt="">
      <h2>Sertifikat</h2>
    </div>
    
    <hr>

    <div class="deskripsi-sertifikat">
      <!-- Bisa isi sesuatu di sini nanti -->
    </div>

    <?php if ($data): ?>
      <div class="informasi-sertifikat">
        <p>🎉 Sertifikatmu sudah terbit! <br> Silakan unduh sertifikat magangmu melalui tombol di bawah ini.</p>

        <?php if (!empty($data['file_sertifikat'])): ?>
          <a href="../admin/file_sertifikat/<?= urlencode($data['file_sertifikat']) ?>" target="_blank">
            <button class="btn-periksa">Unduh Sertifikat</button>
          </a>
        <?php else: ?>
          <p><strong>File sertifikat belum tersedia.</strong></p>
        <?php endif; ?>
      </div>

    <?php elseif ($not_found): ?>
      <div class="informasi-sertifikat">
        <p><strong>Maaf!</strong> Data tidak ditemukan. <br> Pastikan informasi yang sudah diisi sudah benar atau hubungi admin.</p>
      </div>
    <?php endif; ?>

  </div>
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