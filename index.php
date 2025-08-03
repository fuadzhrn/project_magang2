<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sistem Magang PLN UID Sulselrabar. Cek status surat, cetak sertifikat, dan lihat pengalaman peserta magang di PLN.">
  <meta name="keywords" content="magang PLN, surat magang PLN, PLN UID Sulselrabar, sertifikat magang, pengalaman magang">
  <meta name="author" content="PLN UID Sulselrabar">
  <meta name="google-site-verification" content="aAzrnk4YZu4KqTVJntpevwf8_1H4EB-53a8skKVOaSY" />
  
  <title>PLN Internship</title>
  
  <link rel="stylesheet" href="style/style.css?<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="icon" href="img/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
</head>

<body>
    <div class="header">
            <nav class="animate__animated animate__slideInDown animate__faster">
        <ul>
            <li>
                <i class="ri-home-3-line"></i>
                <a class="active" href="#">Beranda</a>
            </li>
            <li> 
                <i class="ri-database-2-line"></i>
                <a href="data_mhs/data_mahasiswa.php">Data Mahasiswa</a>
            </li>
            <li>
                <i class="ri-mail-line"></i>
                <a href="permintaaan_srt/permintaan_srt.php">Permintaan Surat</a>
            </li>
            <li>
                <i class="ri-information-2-line"></i>
                <a href="ulasan/ulasan.php">Ulasan</a>
            </li>
        </ul>
        
    </nav>
    <div class="box menu-bar">
                    <i class="ri-menu-3-fill" style="color: white;"></i>
                </div>
    </div>
  
    <div class="slider-container">
        <div  class="slider-item">
            <img src="img/img home.jpg" alt="">
            <div class="silder-content">
                <h2 class="slider-title animate__animated animate__backInDown" >Welcome,</h2>
                <h3 class="slider-description animate__animated animate__backInDown">PT PLN(PERSERO) UID SULSELRABAR </h3>
                <div class="slider-description2">
                     <h3 class="animate__animated animate__backInUp">Internship</h3>
                </div>
                <div class="slider-button">
                         <a href="#dua-kolom" class="animate__animated animate__fadeIn">Selengkapnya</a>
                </div>
               <!-- <div class="slider-bg">
                    <h3>Internship</h3>
               </div> -->
            </div>
            
        </div>
        
   
        <div  class="slider-item">
            <img src="img/bg 2.jpg" alt="">
            <div class="silder-content">
                <h2 class="slider-title">Welcome,</h2>
                <h3 class="slider-description">PT PLN(PERSERO) UID SULSELRABAR </h3>
                <div class="slider-description2">
                     <h3>Internship</h3>
                </div>
                <div class="slider-button">
                         <a href="#dua-kolom">Selengkapnya</a>
                </div>
               <!-- <div class="slider-bg">
                    <h3>Internship</h3>
               </div> -->
            </div>
        </div>
    
   
        <div  class="slider-item">
            <img src="img/bg 3.jpg" alt="">
            <div class="silder-content">
                <h2 class="slider-title">Welcome,</h2>
                <h3 class="slider-description">PT PLN(PERSERO) UID SULSELRABAR </h3>
                <div class="slider-description2">
                     <h3>Internship</h3>
                </div>
                <div class="slider-button">
                         <a href="">Selengkapnya</a>
                </div>
               <!-- <div class="slider-bg">
                    <h3>Internship</h3>
               </div> -->
            </div>
        </div>
    </div>

<section class="dua-kolom" id="dua-kolom">
    <div class="kiri" data-aos="fade-right" data-aos-duration="2000">
        <h2>Apa manfaat magang/PKL di PT PLN (PERSERO) UID SULSERABAR?</h2>
       <div class="anak-magang">
            <div class="avatar">
                 <img src="img/user.png" alt="User Icon">
                 </div>
                <div class="chat-box">
         <p class="role">Calon Anak Magang</p>
         <p class="pesan">Kenapa harus magang/PKL di PT PLN (PERSERO) UID SULSERABAR?</p>
     </div>
    </div>

                <div class="admin">
        <div class="admin-chat">
            <p class="role">Admin</p>
            <p class="pesan">
            Magang di PT PLN (Persero) UID Sulselrabar memberimu pengalaman langsung di dunia kerja profesional, keterlibatan dalam proyek nyata, serta kesempatan belajar dari para ahli di industri energi dalam lingkungan yang mendukung pengembangan diri dan kontribusi bagi negeri.
            </p>
        </div>
        <div class="avatar">
            <img src="img/user.png" alt="Admin Icon">
        </div>
        </div>

        <div class="description-kiri">
            <h3>Temukan daftar mahasiswa yang telah atau sedang mengikuti program magang di PT PLN (Persero) UID Sulselrabar.</h3>
        </div>
        <div class="tombol-container">
            <a href="data_mhs/data_mhs_magang.php" class="tombol-link">
                      Selengkapnya
            <img src="img/Vector.png" alt="Panah">
        </a>
        </div>

    </div>
    <div class="kanan" data-aos="fade-left" data-aos-duration="2000" >
         <h2 class="judul-kanan">Panduan Pengajuan <strong>Magang/PKL</strong></h2>
            <ol class="nomor-kanan">
                
                <li>
                Siapkan surat permohonan pelaksanaan magang/PKL
                <p>Pastikan surat tersebut sudah:</p>
                <ul>
                    <li>Ditandatangani oleh pihak berwenang di kampus.</li>
                    <li>Melampirkan beberapa berkas pendukung, diantaranya adalah CV.</li>
                    <li>Permohonan magang dimasukkan maksimal 2 pekan sebelum tanggal pelaksanaan</li>
                </ul>
                <a href="contoh_surat/Template_Surat_Permohonan_Magang.pdf">[Contoh Surat Permohonan Magang]</a>
                <br>
                 <a href="contoh_surat/template_CV_ATS (1).pdf">[Contoh CV]</a>
                </li>

                <li>
                Serahkan surat ke kantor PT PLN (PERSERO) UID SULSERABAR.
                <ul>
                    <li>Jl. Letjen Hertasning No.Blok B 90222 Makassar Sulawesi</li>
                    <li>Pukul 09.00 - 15.00 WITA</li>
                </ul>
                <p>Staff akan menerima dan mencatat datamu untuk proses seleksi.</p>
                <p>Surat Anda akan diproses dalam waktu maksimal 1 minggu sejak tanggal penerimaan.</p>
                
                </li>

                <li>
                Cek Hasil Pengajuan di Website.
                <p>Setelah menyerahkan surat, kamu bisa mengecek status pengajuan magang melalui halaman Permintaan Surat di website ini.</p>
                </li>

            </ol>
         <div class="tombol-container1">
            <a href="permintaaan_srt/permintaan_srt.php" class="tombol-link">
                      Cek Hasil
            <img src="img/Vector.png" alt="Panah">
        </a>
        </div>
    </div>

</section>
        <footer class="footer">
            <div class="blur-kanan"></div>
        <div class="footer-kiri"data-aos="fade-up"
     data-aos-duration="1000">
            <div class="footer-section">
            <h4>Sitemap</h4>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="data_mhs/data_mahasiswa.php">Data Mahasiswa</a></li>
                <li><a href="permintaaan_srt/permintaan_srt.php">Permintaan Surat</a></li>
                <li><a href="ulasan/ulasan.php">Ulasan</a></li>
            </ul>
            </div>
            <div class="footer-section">
            <h4>Kontak</h4>
            <p>fuadzahran64@gmail.com</p>
            </div>
        </div>

        <div class="footer-kanan"data-aos="fade-up"
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
<script src="java_script/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>