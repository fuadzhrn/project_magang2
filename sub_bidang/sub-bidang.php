
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/sub-bidang.css?v=<?php echo time(); ?>">
     <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <link rel="icon" href="../img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Sub Bidang</title>
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
              <a href="../ulasan/ulasan.php">Ulasan</a>
            </li>
        </ul>
    </nav>
    <div class="box menu-bar">
                    <i class="ri-menu-3-fill" style="color: white;"></i>
                </div>
    </div>

<section class="sub-bidang">
  <div class="container-sub-bidang">
    <div class="header-sub-bidang">
      <img class="icon-sub" src="../img/majesticons_sub_bidang.png" alt="">
      <h2 class="description-sub">Sub Bidang PT PLN (PERSERO) UID SULSERABAR</h2>
    </div>
    <hr>

    <div class="bagian-sub">
      <div class="baris">
        <a href="#" class="btn-bidang" data-bidang="k3"><span>Bid. K3</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="niaga"><span>Bid. Niaga</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="pengadaan"><span>Bid. Pengadaan</span><span class="bulat"></span></a>
      </div>
      <div class="baris">
        <a href="#" class="btn-bidang" data-bidang="distribusi&up2k"><span>Bid. Distribusi & UP2K</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="perencanaan"><span>Bid. Perencanaan</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="hc"><span>Bid. HC</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="htd"><span>Bid. HTD</span><span class="bulat"></span></a>
      </div>
      <div class="baris">
        <a href="#" class="btn-bidang" data-bidang="keuangan&akutansi"><span>Bid. Keuangan & Akutansi</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="komunikasi"><span>Bid. Komunikasi</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="umum"><span>Bid. Umum</span><span class="bulat"></span></a>
        <a href="#" class="btn-bidang" data-bidang="sti"><span>Bid. STI</span><span class="bulat"></span></a>
      </div>
    </div>
  </div>
  <!-- <div class="efek-bawah" id="efekBawah">
  </div> -->
  <div class="listrik">
    <img src="../img/Listrik.png" alt="">
  </div>

  <!-- DESKRIPSI SUB BIDANG -->
        <?php
        include "../admin/config/koneksi.php"; // pastikan path koneksi benar

        $result = mysqli_query($koneksi, "
            SELECT sb.id_bidang, sb.nama_bidang, sb.deskripsi, 
                  (sb.kouta - COUNT(pm.id_mahasiswa)) AS sisa_kuota
            FROM sub_bidang sb
            LEFT JOIN peserta_magang pm 
                ON sb.id_bidang = pm.id_bidang AND pm.status = 'Aktif'
            GROUP BY sb.id_bidang
        ");

        while ($row = mysqli_fetch_assoc($result)) {
            $nama_bidang = htmlspecialchars($row['nama_bidang']);
            $deskripsi   = nl2br(htmlspecialchars($row['deskripsi']));
            $sisa_kuota  = max(0, $row['sisa_kuota']); // jaga-jaga agar tidak tampil negatif
            $slug        = strtolower(str_replace(' ', '-', $nama_bidang));

            echo "
            <div class='deskripsi-sub-bidang' data-bidang='$slug'>
              <p class='deskripsi'><strong>$nama_bidang</strong> $deskripsi</p>
              <div class='jumlah-kouta'><p>Sisa Kuota: $sisa_kuota</p></div>
            </div>
            ";
        }
        ?>



    
</section>

<footer class="footer">
            <div class="blur-kanan"></div>
        <div class="footer-kiri" data-aos="fade-up"
     data-aos-duration="1000">
            <div class="footer-section" >
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
    <script>
  const tombolBidang = document.querySelectorAll('.btn-bidang .bulat');
const deskripsiBoxes = document.querySelectorAll('.deskripsi-sub-bidang');
const container = document.querySelector('.container-sub-bidang');
const efekBawah = document.getElementById('efekBawah');

tombolBidang.forEach(bulat => {
  bulat.addEventListener('click', function (e) {
    e.preventDefault();

    const bidang = this.closest('.btn-bidang').dataset.bidang;
    const targetBox = document.querySelector(`.deskripsi-sub-bidang[data-bidang="${bidang}"]`);

    const isVisible = targetBox.classList.contains('show');

    if (isVisible) {
      // Sembunyikan saja
      targetBox.classList.remove('show');
      container.classList.remove('normal-shape');
      efekBawah.classList.remove('hide');
    } else {
      // Tutup semua dulu, lalu buka yang baru
      deskripsiBoxes.forEach(box => box.classList.remove('show'));

      targetBox.classList.add('show');
      container.classList.add('normal-shape');
      efekBawah.classList.add('hide');
    }
  });
});

// bulat
document.querySelectorAll('.btn-bidang').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      this.classList.toggle('active');
    });
  });

</script>
<script src="../java_script/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


</html>