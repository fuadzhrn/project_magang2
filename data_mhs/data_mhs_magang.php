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
    <link rel="stylesheet" href="../style/mhs.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/favicon.png">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery dan DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
    <div class="header">
            <nav class="animate__animated animate__slideInDown animate__faster">
        <ul>
            <li>
                <i class="ri-home-3-line"></i>
              <a class="" href="../index.php">Beranda</a>
            </li>
            <li>
              <i class="ri-database-2-line"></i>
              <a href="../data_mhs/data_mahasiswa.php">Data Mahasiswa</a>
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

    <section class="mhs-magang">
        <div class="container-mhs-magang">
        <div class="header-magang">
            <img class="icon-mhs-magang" src="../img/solar_user-mhs.png" alt="">
            <h2 class="description-mhs-magang">Data Peserta Magang & Praktik Kerja Lingkungan (PKL)</h2>
            
        </div>
        <hr>
       <div class="filter-wrapper">
  <div class="filter">

    <!-- Filter Bidang -->
    <div class="filter-item">
      <label for="filterBidang">Bidang</label>
      <select id="filterBidang">
        <option value="">Semua</option>
        <option value="umum">umum</option>
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

    <!-- Filter Tgl Masuk -->
    <div class="filter-item">
      <label for="filterMasuk">Tgl Masuk</label>
      <input type="text" id="filterMasuk" placeholder="yyyy-mm-dd">
    </div>

    <!-- Filter Tgl Keluar -->
    <div class="filter-item">
      <label for="filterKeluar">Tgl Keluar</label>
      <input type="text" id="filterKeluar" placeholder="yyyy-mm-dd">
    </div>

    <!-- Filter Status -->
    <!-- Filter Status -->
        <div class="filter-item">
            <label for="filterStatus">Status</label>
            <select id="filterStatus">
                <option value="">Semua</option>
                <option value="Aktif">Aktif</option>
                <option value="Selesai">Selesai</option>
                <option value="Belum Aktif">Belum Aktif</option>
            </select>
        </div>


      <!-- Penampil Jumlah Mahasiswa Aktif -->
       <?php
        include "../admin/config/koneksi.php";
        $queryAktif = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang WHERE status = 'Aktif'");
        $jumlahAktif = mysqli_fetch_assoc($queryAktif)['total'];
      ?>


    <div class="filter-item">
      <label>Jumlah Mahasiswa Aktif</label>
      <input type="text" value="<?= $jumlahAktif ?>" readonly>
    </div>
  </div>
</div>

  </div>
</div>


        </div>
        <div class="garis-putus-tengah"></div>
    </section>
    <section class="data-mahasiswa">
    <div class="table-wrapper">
<table id="tabelMagang" class="tabel-magang">
  <thead>
    <tr>
      <th>No</th>
      <th>Bidang</th>
      <th>Tgl Masuk</th>
      <th>Tgl Keluar</th>
      <th>Status</th>
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
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($data['nama_bidang']) ?></td>
        <td><?= htmlspecialchars($data['tgl_masuk']) ?></td>
        <td><?= htmlspecialchars($data['tgl_keluar']) ?></td>
        <td>
        <?php if ($data['status'] == 'Aktif'): ?>
          <span class="badge aktif">Aktif</span>
        <?php elseif ($data['status'] == 'Selesai'): ?>
          <span class="badge selesai">Selesai</span>
        <?php elseif ($data['status'] == 'Belum Aktif'): ?>
          <span class="badge belum-aktif">Belum Aktif</span>
        <?php endif; ?>
      </td>

      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</div>
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
       <script>
     $(document).ready(function () {
  var table = $('#tabelMagang').DataTable({
    pageLength: 5,
    lengthChange: false,
    info: false,
    searching: true,
    language: {
      paginate: {
        previous: "<",
        next: ">"
      }
    }
  });

  // Filter berdasarkan Bidang
  $('#filterBidang').on('change', function () {
    table.column(1).search(this.value).draw();
  });

  // Filter berdasarkan Tanggal Masuk
  $('#filterMasuk').on('keyup change', function () {
    table.column(2).search(this.value).draw();
  });

  // Filter berdasarkan Tanggal Keluar
  $('#filterKeluar').on('keyup change', function () {
    table.column(3).search(this.value).draw();
  });

  // Filter berdasarkan Status (Kolom 4)
  $('#filterStatus').on('change', function () {
    var statusFilter = this.value;
    
    // Filter status yang tepat (Aktif, Selesai, Belum Aktif)
    if (statusFilter === '') {
      table.column(4).search('').draw(); // Tidak ada filter, tampilkan semuanya
    } else {
      table.column(4).search('^' + statusFilter + '$', true, false).draw(); // Pastikan pencocokan tepat
    }
  });
});




</script>
<script src="../java_script/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>