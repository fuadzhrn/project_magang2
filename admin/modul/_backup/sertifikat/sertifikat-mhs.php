<?php
include "../admin/config/koneksi.php";

// Proses simpan
if (isset($_POST['bsimpan'])) {
    $nama_lengkap   = mysqli_real_escape_string($koneksi, strtoupper($_POST['nama_lengkap']));
    $asal_instansi  = mysqli_real_escape_string($koneksi, strtoupper($_POST['asal_instansi']));
    $id_bidang      = mysqli_real_escape_string($koneksi, $_POST['id_bidang']);

    $nama_file      = $_FILES['file_sertifikat']['name'];
    $tmp_file       = $_FILES['file_sertifikat']['tmp_name'];
    $ukuran_file    = $_FILES['file_sertifikat']['size'];

    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $nama_bersih = preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($nama_file, PATHINFO_FILENAME));
    $nama_file_baru = time() . "_" . $nama_bersih . "." . $ext;
    $folder_simpan = "file_sertifikat/";

    if (!in_array($ext, ['pdf'])) {
        echo "<script>alert('Hanya file PDF yang diizinkan!');</script>";
    } elseif ($ukuran_file > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran maksimal 2MB!');</script>";
    } else {
        if (!is_dir($folder_simpan)) mkdir($folder_simpan, 0777, true);
        $path_simpan = $folder_simpan . $nama_file_baru;

        if (move_uploaded_file($tmp_file, $path_simpan)) {
            $simpan = mysqli_query($koneksi, "INSERT INTO data_sertifikat 
                (nama_lengkap, asal_instansi, id_bidang, file_sertifikat) VALUES 
                ('$nama_lengkap', '$asal_instansi', '$id_bidang', '$nama_file_baru')");

            echo $simpan
                ? "<script>alert('Data berhasil disimpan');location.href='?halaman=sertifikat-mhs';</script>"
                : "<script>alert('Gagal menyimpan ke database');</script>";
        } else {
            echo "<script>alert('Upload file gagal');</script>";
        }
    }
}

// Proses hapus
if (isset($_GET['hal']) && $_GET['hal'] == "hapus" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $cek = mysqli_query($koneksi, "SELECT file_sertifikat FROM data_sertifikat WHERE id_sertifikat = '$id'");
    $data = mysqli_fetch_array($cek);
    if ($data && file_exists("file_sertifikat/" . $data['file_sertifikat'])) {
        unlink("file_sertifikat/" . $data['file_sertifikat']);
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM data_sertifikat WHERE id_sertifikat = '$id'");
    echo $hapus
        ? "<script>alert('Data berhasil dihapus');location.href='?halaman=sertifikat-mhs';</script>"
        : "<script>alert('Gagal menghapus data');</script>";
}
?>

<!-- Form Upload -->
<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white">Form Data Pengirim Sertifikat</div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" required>
      </div>
      <div class="form-group">
        <label>Asal Instansi</label>
        <input type="text" class="form-control" name="asal_instansi" required>
      </div>
      <div class="form-group">
        <label>Bidang</label>
        <select class="form-control" name="id_bidang" required>
          <option value="">-- Pilih Bidang --</option>
          <?php
          $bidang = mysqli_query($koneksi, "SELECT * FROM sub_bidang");
          while ($row = mysqli_fetch_array($bidang)) {
              echo "<option value='{$row['id_bidang']}'>{$row['nama_bidang']}</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Upload File (PDF)</label>
        <input type="file" class="form-control" name="file_sertifikat" accept="application/pdf" required>
      </div>
      <button type="submit" name="bsimpan" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>

<!-- Table Data -->
<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white">Data Pengirim Sertifikat</div>
  <div class="card-body">
    <!-- Modern Search (matching permintaan surat style) -->
    <div class="search-modern">
      <form method="get">
        <input type="hidden" name="halaman" value="sertifikat-mhs">
        <input type="text" name="search" placeholder="Cari nama lengkap, instansi, atau bidang..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary-modern" type="submit">
            <i class="fas fa-search"></i> Cari
          </button>
        </div>
      </form>
    </div>

    <?php
    // Setup pagination variables and calculate total data first
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
    $filter_by = isset($_GET['filter_by']) ? $_GET['filter_by'] : 'all';

    switch ($filter_by) {
        case 'nama':
            $where = "WHERE ds.nama_lengkap LIKE '%$search%'";
            break;
        case 'instansi':
            $where = "WHERE ds.asal_instansi LIKE '%$search%'";
            break;
        case 'bidang':
            $where = "WHERE sb.nama_bidang LIKE '%$search%'";
            break;
        default:
            $where = $search ? "WHERE ds.nama_lengkap LIKE '%$search%' 
                              OR ds.asal_instansi LIKE '%$search%' 
                              OR sb.nama_bidang LIKE '%$search%'" : '';
    }

    // Hitung total data
    $total_result = mysqli_query($koneksi, "
      SELECT COUNT(*) AS total 
      FROM data_sertifikat ds
      JOIN sub_bidang sb ON ds.id_bidang = sb.id_bidang
      $where
    ");
    $total_row = mysqli_fetch_assoc($total_result);
    $total_data = $total_row['total'];
    $total_page = ceil($total_data / $limit);
    ?>

    <!-- Modern Data Table (matching permintaan surat style) -->
    <div class="card-modern">
      <div class="card-header">
        <i class="fas fa-certificate"></i> Data Sertifikat Mahasiswa
        <span class="badge-modern badge-info float-right">Total: <?= $total_data ?> data</span>
      </div>
      <div class="card-body">
        <div class="table-modern">
          <table class="table table-striped">
            <thead>
              <tr>
                <th><i class="fas fa-hashtag"></i> NO</th>
                <th><i class="fas fa-user"></i> NAMA LENGKAP</th>
                <th><i class="fas fa-university"></i> ASAL INSTANSI</th>
                <th><i class="fas fa-sitemap"></i> SUB BIDANG</th>
                <th><i class="fas fa-file-pdf"></i> SERTIFIKAT</th>
                <th><i class="fas fa-cogs"></i> AKSI</th>
              </tr>
            </thead>
            <tbody>
        <?php
        // Ambil data per halaman
        $query = mysqli_query($koneksi, "
          SELECT ds.*, sb.nama_bidang 
          FROM data_sertifikat ds
          JOIN sub_bidang sb ON ds.id_bidang = sb.id_bidang
          $where
          ORDER BY ds.id_sertifikat DESC
          LIMIT $start, $limit
        ");

        $no = $start + 1;
        if (mysqli_num_rows($query) > 0):
          while ($data = mysqli_fetch_array($query)) :
        ?>
            <tr>
              <td><span class="badge-modern badge-info"><?= $no++ ?></span></td>
              <td><strong><?= htmlspecialchars($data['nama_lengkap']) ?></strong></td>
              <td><?= htmlspecialchars($data['asal_instansi']) ?></td>
              <td><?= htmlspecialchars($data['nama_bidang']) ?></td>
              <td>
                <a href="file_sertifikat/<?= urlencode($data['file_sertifikat']) ?>" target="_blank" class="btn btn-success-modern btn-sm">
                  <i class="fas fa-eye"></i> Lihat File
                </a>
              </td>
              <td>
                <a href="?halaman=sertifikat-mhs&hal=hapus&id=<?= $data['id_sertifikat'] ?>" class="btn btn-danger-modern btn-sm" onclick="return confirm('Yakin ingin menghapus data sertifikat <?= htmlspecialchars($data['nama_lengkap']) ?>?')">
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
                  <a href="?halaman=sertifikat-mhs" class="btn btn-primary-modern btn-sm mt-2">
                    <i class="fas fa-refresh"></i> Tampilkan Semua Data
                  </a>
                <?php endif; ?>
              </td>
            </tr>
        <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modern Pagination (matching permintaan surat style) -->
    <?php if ($total_page > 1): ?>
    <div class="text-center mt-4">
      <nav>
        <ul class="pagination pagination-modern">
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=sertifikat-mhs&page=<?= $page - 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">
                <i class="fas fa-chevron-left"></i> Sebelumnya
              </a>
            </li>
          <?php endif; ?>

          <?php 
          $start_page = max(1, $page - 2);
          $end_page = min($total_page, $page + 2);
          
          for ($i = $start_page; $i <= $end_page; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=sertifikat-mhs&page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($page < $total_page): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=sertifikat-mhs&page=<?= $page + 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">
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
