<?php
include "../admin/config/koneksi.php";

$pesan_error = ''; // Pesan error akan ditampilkan di atas form

// Proses simpan
if (isset($_POST['bsimpan'])) {
    $nomor_surat   = strtoupper(trim($_POST['nomor_surat']));
    $nama_pengirim = strtoupper(trim($_POST['nama_pengirim']));
    $asal_instansi = strtoupper(trim($_POST['asal_instansi']));

    // Gunakan mysqli_real_escape_string untuk menghindari masalah dengan karakter khusus
    $nomor_surat = mysqli_real_escape_string($koneksi, $nomor_surat);
    $nama_pengirim = mysqli_real_escape_string($koneksi, $nama_pengirim);
    $asal_instansi = mysqli_real_escape_string($koneksi, $asal_instansi);

    // Cek data duplikat
    $cek = mysqli_query($koneksi, "
        SELECT * FROM balasan_surat 
        WHERE UPPER(nomor_surat) = '$nomor_surat' 
          AND UPPER(nama_pengirim) = '$nama_pengirim' 
          AND UPPER(asal_instansi) = '$asal_instansi'
    ");
    if (mysqli_num_rows($cek) > 0) {
        $pesan_error = "Data dengan nomor surat, pengirim, dan instansi yang sama sudah ada!";
    } elseif (empty($nomor_surat) || empty($nama_pengirim) || empty($asal_instansi)) {
        $pesan_error = "Semua field wajib diisi!";
    }

    // Hentikan jika ada error
    if (empty($pesan_error)) {
        // Upload file
        $nama_file   = $_FILES['file']['name'];
        $tmp_file    = $_FILES['file']['tmp_name'];
        $ukuran_file = $_FILES['file']['size'];
        $target_folder = "file_balasan/";

        // Mengambil ekstensi file
        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $nama_file_clean = preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($nama_file, PATHINFO_FILENAME));
        $nama_file_baru = time() . "_" . $nama_file_clean . "." . $ext;
        $path_simpan = $target_folder . $nama_file_baru;

        // Validasi file
        if (!in_array($ext, ['pdf'])) {
            $pesan_error = "File harus berupa PDF!";
        } elseif ($ukuran_file > 2 * 1024 * 1024) {
            $pesan_error = "Ukuran file maksimal 2MB!";
        } else {
            // Pastikan folder tujuan ada
            if (!is_dir($target_folder)) mkdir($target_folder, 0777, true);

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($tmp_file, $path_simpan)) {
                // Gunakan Prepared Statement untuk menyimpan data ke database
                $stmt = $koneksi->prepare("INSERT INTO balasan_surat (nomor_surat, nama_pengirim, asal_instansi, file_pdf) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nomor_surat, $nama_pengirim, $asal_instansi, $nama_file_baru);

                // Eksekusi dan periksa apakah data berhasil disimpan
                if ($stmt->execute()) {
                    echo "<script>alert('Data berhasil disimpan'); location.href='?halaman=balasan_surat';</script>";
                } else {
                    $pesan_error = "Gagal simpan ke database.";
                }
                $stmt->close();
            } else {
                $pesan_error = "Gagal upload file.";
            }
        }
    }
}

// Proses hapus
if (isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT file_pdf FROM balasan_surat WHERE id = '$id'");
    $data = mysqli_fetch_array($cek);

    if ($data) {
        $filePath = "file_balasan/" . $data['file_pdf'];
        if (file_exists($filePath)) unlink($filePath);

        $hapus = mysqli_query($koneksi, "DELETE FROM balasan_surat WHERE id = '$id'");
        if ($hapus) {
            echo "<script>alert('Data dan file berhasil dihapus'); location.href='?halaman=balasan_surat';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }
}
?>

<!-- HTML Form -->
<div class="card mt-3">
  <div class="card-header bg-info text-white">Form Data Pengirim Surat</div>
  <div class="card-body">
    <?php if (!empty($pesan_error)) : ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?= $pesan_error ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nomor_surat">Nomor Surat</label>
        <input type="text" class="form-control" name="nomor_surat" required>
      </div>
      <div class="form-group">
        <label for="nama_pengirim">Nama Pengirim</label>
        <input type="text" class="form-control" name="nama_pengirim" required>
      </div>
      <div class="form-group">
        <label for="asal_instansi">Asal Instansi</label>
        <input type="text" class="form-control" name="asal_instansi" required>
      </div>
      <div class="form-group">
        <label for="file">Upload File (PDF)</label>
        <input type="file" class="form-control" name="file" accept="application/pdf" required>
      </div>
      <button type="submit" name="bsimpan" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>

<!-- Tabel Data Pengirim Surat -->
<div class="card mt-3">
  <div class="card-header bg-info text-white">Data Pengirim Surat</div>
  <div class="card-body">
    <form method="get" class="mb-3">
      <input type="hidden" name="halaman" value="balasan_surat">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nomor surat, nama pengirim, atau instansi..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Cari</button>
        </div>
      </div>
    </form>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Surat</th>
          <th>Nama Pengirim</th>
          <th>Asal Instansi</th>
          <th>File</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
       <?php
      // Pagination setup
      $limit = 5;
      $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $start = ($page - 1) * $limit;

      $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
      $where = $search ? "WHERE nomor_surat LIKE '%$search%' 
                          OR nama_pengirim LIKE '%$search%' 
                          OR asal_instansi LIKE '%$search%'" : '';

      // Hitung total data
      $total_result = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM balasan_surat 
        $where
      ");
      $total_row = mysqli_fetch_assoc($total_result);
      $total_data = $total_row['total'];
      $total_page = ceil($total_data / $limit);

      // Ambil data per halaman
      $query = mysqli_query($koneksi, "
        SELECT * FROM balasan_surat 
        $where 
        ORDER BY id DESC 
        LIMIT $start, $limit
      ");

      $no = $start + 1;
      while ($data = mysqli_fetch_array($query)) :
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($data['nomor_surat']) ?></td>
        <td><?= htmlspecialchars($data['nama_pengirim']) ?></td>
        <td><?= htmlspecialchars($data['asal_instansi']) ?></td>
        <td><a href="file_balasan/<?= urlencode($data['file_pdf']) ?>" target="_blank">Lihat File</a></td>
        <td>
          <a href="?halaman=balasan_surat&hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
    <div class="text-center mt-3">
      <nav>
        <ul class="pagination justify-content-center">
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $page - 1 ?>">← Sebelumnya</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($page < $total_page): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $page + 1 ?>">Berikutnya →</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
