
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
     <link rel="stylesheet" href="../style/mhs.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../img/favicon.png">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Data Mahasiswa</title>
</head>
<body>
     <div class="header">
            <nav class="animate__animated animate__slideInDown animate__faster">
        <ul>
            <li>
              <i class="ri-home-3-line"></i>
              <a  href="../index.php">Beranda</a>
            </li>
            <li>
              <i class="ri-database-2-line"></i>
              <a class="active" href="data_mahasiswa.php">Data Mahasiswa</a>
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
                    <i class="ri-menu-3-fill" style="color: black;"></i>
                </div>
    </div>

<section class="section-oval">
  <div class="isi-oval">
    <h2 id="isi-oval">
      Lihat <strong>Mahasiswa Magang</strong> serta kenali <strong>Sub Bidang</strong><br>
      di PT PLN (PERSERO) UID SULSERABAR!
    </h2>
  </div>
  
</section>

<!-- SVG Bayangan di luar -->
<div class="oval-shadow-wrapper">
  <svg class="oval-shadow-outer" viewBox="0 0 1200 120" preserveAspectRatio="none">
    <path d="M0,0 C300,40 900,40 1200,0 L1200,120 L0,120 Z" fill="rgba(0, 0, 0, 0.1)" />
  </svg>
</div>

<section class="fitur-section">
  <div class="fitur-container">

    <!-- Kartu 1 -->
<div class="fitur-wrapper animate__animated animate__rubberBand">
  <div class="fitur-card">
    <h3>Peserta<br>Magang & PKL</h3>
    <div class="fitur-icon-bg">
      <img src="../img/user-bold.png" alt="Icon Peserta" class="fitur-icon" />
    </div>
    <div class="fitur-footer">
      <img src="../img/Lightning 2.png" alt="Icon Petir" class="icon-kecil" />
    </div>
  </div>
  <a href="data_mhs_magang.php" class="arrow-link">
    <img src="../img/Arrow 5.png" alt="Icon Panah" class="icon-panah-outside" />
  </a>
</div>

<!-- Kartu 2 - dengan class tambahan untuk hover khusus -->
<div class="fitur-wrapper animate__animated animate__rubberBand">
  <div class="fitur-card">
    <h3>Sub Bidang<br></h3>
    <div class="fitur-icon-bg">
      <img src="../img/sub_bidang.png" alt="Icon Sub Bidang" class="fitur-icon" />
    </div>
    <div class="fitur-footer">
      <img src="../img/Lightning 2.png" alt="Icon Petir" class="icon-kecil" />
    </div>
  </div>
  <a href="../sub_bidang/sub-bidang.php" class="arrow-link arrow-subbidang">
    <img src="../img/Arrow 5.png" alt="Icon Panah" class="icon-panah-outside" />
  </a>
</div>

<!-- Kartu 3 -->
<div class="fitur-wrapper animate__animated animate__rubberBand">
  <div class="fitur-card">
    <h3>Sertifikat<br></h3>
    <div class="fitur-icon-bg">
      <img src="../img/sertifikat.png" alt="Icon Sertifikat" class="fitur-icon" />
    </div>
    <div class="fitur-footer">
      <img src="../img/Lightning 2.png" alt="Icon Petir" class="icon-kecil" />
    </div>
  </div>
  <a href="../sertifikat/sertifikat.php" class="arrow-link">
    <img src="../img/Arrow 5.png" alt="Icon Panah" class="icon-panah-outside" />
  </a>
</div>


      

  </div>
</section>

 <footer class="footer">
            <div class="blur-kanan"></div>
        <div class="footer-kiri" class="footer-kanan"data-aos="fade-up"
     data-aos-duration="1000">
            <div class="footer-section">
            <h4>Sitemap</h4>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="#">Data Mahasiswa</a></li>
                <li><a href="../permintaaan_srt/permintaan_srt.php">Permintaan Surat</a></li>
                <li><a href="../ulasan/ulasan.php">Ulasan</a></li>
            </ul>
            </div>
            <div class="footer-section">
            <h4>Kontak</h4>
            <p>fuadzahran64@gmail.com</p>
            </div>
        </div>

        <div class="footer-kanan" class="footer-kanan"data-aos="fade-up"
     data-aos-duration="1000">
            <h3>Hubungi Kami</h3>
            <p>Makassar, Indonesia</p>
            <p><strong>Jl. Letjen Hertasning No.Blok B 90222 Makassar Sulawesi</strong></p>
        </div>

        <div class="footer-bawah">
            <p>© 2025, PT PLN (Persero) UID Sulselrabar. All Rights Reserved.</p>
        </div>
        </footer>




<!-- script bagian bawah halaman -->
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    new TypeIt("#isi-oval", {
      // strings: ["Halo, selamat datang di situs kami.<br>Temukan informasi menarik di sini."],
      speed: 60,
      loop: true,
      breakLines: true, // agar <br> dianggap sebagai baris baru
      nextStringDelay: 1500,
      deleteSpeed: 30
    }).go();
  });
</script>


<script src="../java_script/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
