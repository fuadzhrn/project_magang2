<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/msk-ulasan.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" href="../img/favicon.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
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
              <a href="../permintaaan_srt/permintaan_srt.php">Permintaan Surat</a>
            </li>
            <li>
                <i class="ri-information-2-line"></i>
              <a class="active" href="ulasan.php">Ulasan</a>
            </li>
        </ul>
    </nav>
    <div class="box menu-bar">
                    <i class="ri-menu-3-fill" style="color: white;"></i>
                </div>
    </div>
   <section class="msk-ulasan">
  <div class="testimoni-title-ulasan">
    <img src="../img/Portal.png" alt="Bintang" class="judul-icon-ulasan" />
    <img src="../img/Asterisk 2-ulasan.png" alt="" class="judul-icon-ulasan2">
    
    <h2 id="isi-oval">
     
    </h2>
    <p id="teks-ulasan">
  Ulasanmu akan membantu memperbaiki dan meningkatkan <br>
  pengalaman magang bagi mahasiswa berikutnya.
</p>

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
    <form method="POST" action="">
      <div class="informasi-ulasan">
        <input type="text" name="nama" placeholder="Nama Lengkap" class="input-field animate__animated animate__backInDown " required>
        <input type="text" name="instansi" placeholder="Asal Instansi" class="input-field animate__animated animate__backInDown animate__delay-2s" required>
        <input type="text" name="ulasan" placeholder="Ulasan (maks 20 kata)" class="input-field animate__animated animate__backInDown animate__delay-4s" maxlength="200" required>
            <select name="rating" class="input-field animate__animated animate__backInDown animate__delay-5s" required>
            <option value="">Beri Rating</option>
            <option value="5">★ 5.0 - Sangat Puas</option>
            <option value="4">★ 4.0 - Puas</option>
            <option value="3">★ 3.0 - Cukup</option>
            <option value="2">★ 2.0 - Kurang</option>
            <option value="1">★ 1.0 - Tidak Puas</option>
            </select><br><br>

      </div>
      <button type="submit" name="submit" class="btn-periksa">Kirim Ulasan</button>
    </form>
    <!-- FORM selesai -->
  </div>
</section>

</body>
<script src="../java_script/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    new TypeIt("#isi-oval", {
      strings: ["Punya Cerita atau Masukan? <br> Yuk, Tulis Ulasan Magangmu!"],
      speed: 60,
      nextStringDelay: 1500
    })
    .exec(() => {
      document.getElementById("teks-ulasan").classList.add("show");
    })
    .go();
  });
</script>


<script>
  AOS.init();
</script>
</html>