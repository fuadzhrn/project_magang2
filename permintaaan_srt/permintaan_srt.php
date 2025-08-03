<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/mhs.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/permintaan-srt.css?v=<?php echo time(); ?> ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../img/favicon.png">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Permintaan</title>
</head>
<body>
     <div class="header">
            <nav class="animate__animated animate__slideInDown animate__faster">
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
  <div class="isi-oval" >
    <h2 id="isi-oval">
      
    </h2>
  </div>
</section>
            <section class="permintaan-srt">
                <!-- Tulisan besar "Internship" kanan atas -->
                <h1 class="bg-text-kanan">Internship</h1>

                <!-- Gambar logo kanan atas -->
                <img src="/img/Group-15.png" alt="Logo" class="bg-img-kanan" />

                <!-- Tulisan besar "Internship" kiri bawah -->
                <h1 class="bg-text-kiri">Internship</h1>

                <!-- Gambar logo kiri bawah -->
                <img src="/img/Group-15.png" alt="Logo" class="bg-img-kiri" />

           <form action="hasil-pengajuan.php" method="get">
            <div class="informasi-permintaan">
                <input type="text" placeholder="Nomor Surat" name="nomor_surat" class="input-field animate__animated animate__backInLeft" required>
                <input type="text" placeholder="Nama Lengkap" name="nama_pengirim" class="input-field animate__animated animate__backInLeft" required>
                <input type="text" placeholder="Asal Instansi" name="asal_instansi" class="input-field animate__animated animate__backInLeft" required>
            </div>
            <button type="submit" class="btn-periksa">Periksa</button>
            </form>

            </section>

     <footer class="footer">
            <div class="blur-kanan"></div>
        <div class="footer-kiri" data-aos="fade-up"
     data-aos-duration="1000">
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

        <div class="footer-kanan" data-aos="fade-up"
     data-aos-duration="1000">
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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script>
 document.addEventListener("DOMContentLoaded", function () {
  new TypeIt("#isi-oval", {
    strings: ["Hasil Pengajuan Permohonan Magang"],
    speed: 60,
    loop: true,
    deleteSpeed: 30,
    nextStringDelay: 1500
  }).go();
});

</script>
<script>
  AOS.init();
</script>
</html>