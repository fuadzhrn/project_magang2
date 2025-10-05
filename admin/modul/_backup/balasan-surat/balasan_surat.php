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

<!-- Modern Form -->
<div class="card-modern mb-4">
  <div class="card-header">
    <i class="fas fa-plus-circle"></i> Form Upload Balasan Surat
  </div>
  <div class="card-body">
    <?php if (!empty($pesan_error)) : ?>
      <div class="alert-modern alert-danger">
        <i class="fas fa-exclamation-triangle"></i> <?= $pesan_error ?>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="form-modern">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="nomor_surat">
              <i class="fas fa-hashtag"></i> Nomor Surat
            </label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Masukkan nomor surat" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="nama_pengirim">
              <i class="fas fa-user"></i> Nama Pengirim
            </label>
            <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Masukkan nama pengirim" required>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="asal_instansi">
              <i class="fas fa-building"></i> Asal Instansi
            </label>
            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Masukkan asal instansi" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label" for="file">
              <i class="fas fa-file-pdf"></i> Upload File (PDF Max 2MB)
            </label>
            <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
            <small class="text-muted">File harus berformat PDF dengan maksimal ukuran 2MB</small>
          </div>
        </div>
      </div>
      
      <div class="form-group text-right">
        <button type="reset" class="btn btn-danger-modern mr-2">
          <i class="fas fa-times"></i> Batal
        </button>
        <button type="submit" name="bsimpan" class="btn btn-primary-modern">
          <i class="fas fa-save"></i> Simpan Data
        </button>
      </div>
    </form>
  </div>
</div>

<?php
// Setup pagination variables and calculate total data first
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
?>

<!-- Modern Data Table -->
<div class="card-modern">
  <div class="card-header">
    <i class="fas fa-table"></i> Data Balasan Surat
    <span class="badge-modern badge-info float-right">Total: <?= $total_data ?> data</span>
  </div>
  <div class="card-body">
    <!-- Modern Search -->
    <div class="search-modern">
      <form method="get">
        <input type="hidden" name="halaman" value="balasan_surat">
        <input type="text" name="search" placeholder="Cari nomor surat, nama pengirim, atau instansi..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary-modern" type="submit">
            <i class="fas fa-search"></i> Cari
          </button>
        </div>
      </form>
    </div>

    <div class="table-modern">
      <table class="table table-striped">
        <thead>
          <tr>
            <th><i class="fas fa-hashtag"></i> No</th>
            <th><i class="fas fa-file-alt"></i> Nomor Surat</th>
            <th><i class="fas fa-user"></i> Nama Pengirim</th>
            <th><i class="fas fa-building"></i> Asal Instansi</th>
            <th><i class="fas fa-file-pdf"></i> File</th>
            <th><i class="fas fa-cogs"></i> Aksi</th>
          </tr>
        </thead>
        <tbody>
         <?php
        // Ambil data per halaman
        $query = mysqli_query($koneksi, "
          SELECT * FROM balasan_surat 
          $where 
          ORDER BY id DESC 
          LIMIT $start, $limit
        ");

        $no = $start + 1;
        if (mysqli_num_rows($query) > 0):
          while ($data = mysqli_fetch_array($query)) :
        ?>
        <tr>
          <td><span class="badge-modern badge-info"><?= $no++ ?></span></td>
          <td><strong><?= htmlspecialchars($data['nomor_surat']) ?></strong></td>
          <td><?= htmlspecialchars($data['nama_pengirim']) ?></td>
          <td><?= htmlspecialchars($data['asal_instansi']) ?></td>
          <td>
            <a href="file_balasan/<?= urlencode($data['file_pdf']) ?>" target="_blank" class="btn btn-success-modern btn-sm">
              <i class="fas fa-eye"></i> Lihat File
            </a>
          </td>
          <td>
            <a href="?halaman=balasan_surat&hal=hapus&id=<?= $data['id'] ?>" 
               class="btn btn-danger-modern btn-sm" 
               onclick="return confirm('Yakin ingin menghapus data ini?\n\nData: <?= htmlspecialchars($data['nama_pengirim']) ?> - <?= htmlspecialchars($data['nomor_surat']) ?>')">
              <i class="fas fa-trash"></i> Hapus
            </a>
          </td>
        </tr>
        <?php 
          endwhile;
        else: 
        ?>
        <tr>
          <td colspan="6" class="text-center py-4">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Tidak ada data yang ditemukan</p>
            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
              <a href="?halaman=balasan_surat" class="btn btn-primary-modern btn-sm mt-2">
                <i class="fas fa-refresh"></i> Tampilkan Semua Data
              </a>
            <?php endif; ?>
          </td>
        </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <!-- Modern Pagination -->
    <?php if ($total_page > 1): ?>
    <div class="text-center mt-4">
      <nav>
        <ul class="pagination pagination-modern">
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $page - 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">
                <i class="fas fa-chevron-left"></i> Sebelumnya
              </a>
            </li>
          <?php endif; ?>

          <?php 
          $start_page = max(1, $page - 2);
          $end_page = min($total_page, $page + 2);
          
          for ($i = $start_page; $i <= $end_page; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($page < $total_page): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=balasan_surat&page=<?= $page + 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">
                Berikutnya <i class="fas fa-chevron-right"></i>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      
      <small class="text-muted">
        Menampilkan <?= $start + 1 ?> - <?= min($start + $limit, $total_data) ?> dari <?= $total_data ?> data
      </small>
    </div>
    <?php endif; ?>
  </div>
</div>
