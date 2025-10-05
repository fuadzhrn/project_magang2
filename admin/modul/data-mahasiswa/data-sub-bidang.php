<?php
include "../admin/config/koneksi.php";

// Inisialisasi variabel form
$vnama_bidang = '';
$vkouta = '';
$vdeskripsi = '';
$pesan_error = '';
$pesan_sukses = '';

// Tampilkan notifikasi berbasis query string (hasil redirect)
if (isset($_GET['notice'])) {
  switch ($_GET['notice']) {
    case 'added':
      $pesan_sukses = 'Data berhasil disimpan!';
      break;
    case 'updated':
      $pesan_sukses = 'Data berhasil diperbarui!';
      break;
    case 'deleted':
      $pesan_sukses = 'Data berhasil dihapus!';
      break;
    case 'delete_blocked':
      $cnt = isset($_GET['count']) ? (int)$_GET['count'] : 0;
      $pesan_error = 'Gagal hapus! Masih ada ' . $cnt . ' mahasiswa yang terdaftar di bidang ini.';
      break;
    case 'delete_failed':
      $pesan_error = 'Gagal menghapus data. Silakan coba lagi.';
      break;
  }
}

// Tangani submit secara andal (tidak bergantung pada name tombol)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil input
  $nama_bidang = isset($_POST['nama_bidang']) ? trim($_POST['nama_bidang']) : '';
  $kouta_raw   = isset($_POST['kouta']) ? trim($_POST['kouta']) : '';
  $deskripsi   = isset($_POST['deskripsi']) ? trim($_POST['deskripsi']) : '';
  $id_bidang_p = isset($_POST['id_bidang']) ? (int)$_POST['id_bidang'] : 0; // hidden saat edit

  // Validasi
  if ($nama_bidang === '' || $kouta_raw === '' || $deskripsi === '') {
    $pesan_error = "Semua field harus diisi!";
  } elseif (!ctype_digit($kouta_raw) || (int)$kouta_raw < 1) {
    $pesan_error = "Kuota harus berupa angka bulat positif!";
  } else {
    $kouta = (int)$kouta_raw;

    // Mode edit vs tambah
    $isEdit = (isset($_GET['hal']) && $_GET['hal'] === 'edit') || $id_bidang_p > 0;

    if ($isEdit) {
      // Tentukan id dari POST (lebih andal), fallback GET
      $id_bidang = $id_bidang_p > 0 ? $id_bidang_p : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
      if ($id_bidang <= 0) {
        $pesan_error = "ID bidang tidak valid.";
      } else {
        // Cek duplikasi nama bidang milik record lain
        $stmtC = mysqli_prepare($koneksi, "SELECT id_bidang FROM sub_bidang WHERE nama_bidang = ? AND id_bidang <> ? LIMIT 1");
        if ($stmtC) {
          mysqli_stmt_bind_param($stmtC, 'si', $nama_bidang, $id_bidang);
          mysqli_stmt_execute($stmtC);
          mysqli_stmt_store_result($stmtC);
          $dup_exists = mysqli_stmt_num_rows($stmtC) > 0;
          mysqli_stmt_close($stmtC);
          if ($dup_exists) {
            $pesan_error = "Nama bidang sudah digunakan. Gunakan nama lain.";
          }
        }

        if ($pesan_error === '') {
          // Update dengan prepared statement
          $stmt = mysqli_prepare($koneksi, "UPDATE sub_bidang SET nama_bidang = ?, kouta = ?, deskripsi = ? WHERE id_bidang = ?");
          if (!$stmt) {
            $pesan_error = "Gagal menyiapkan kueri: " . mysqli_error($koneksi);
          } else {
            mysqli_stmt_bind_param($stmt, 'sisi', $nama_bidang, $kouta, $deskripsi, $id_bidang);
            if (mysqli_stmt_execute($stmt)) {
              mysqli_stmt_close($stmt);
              header('Location: ?halaman=sub-bidang&notice=updated');
              exit;
            } else {
              $pesan_error = "Gagal mengupdate data: " . mysqli_error($koneksi);
              mysqli_stmt_close($stmt);
            }
          }
        }
      }
    } else {
      // Tambah: cek duplikat nama bidang
      $stmtC = mysqli_prepare($koneksi, "SELECT id_bidang FROM sub_bidang WHERE nama_bidang = ? LIMIT 1");
      if (!$stmtC) {
        $pesan_error = "Gagal menyiapkan kueri duplikasi: " . mysqli_error($koneksi);
      } else {
        mysqli_stmt_bind_param($stmtC, 's', $nama_bidang);
        mysqli_stmt_execute($stmtC);
        mysqli_stmt_store_result($stmtC);
        $exists = mysqli_stmt_num_rows($stmtC) > 0;
        mysqli_stmt_close($stmtC);

        if ($exists) {
          $pesan_error = "Nama bidang sudah ada! Gunakan nama yang berbeda.";
        } else {
          // Insert
          $stmt = mysqli_prepare($koneksi, "INSERT INTO sub_bidang (nama_bidang, kouta, deskripsi) VALUES (?, ?, ?)");
          if (!$stmt) {
            $pesan_error = "Gagal menyiapkan kueri simpan: " . mysqli_error($koneksi);
          } else {
            mysqli_stmt_bind_param($stmt, 'sis', $nama_bidang, $kouta, $deskripsi);
            if (mysqli_stmt_execute($stmt)) {
              mysqli_stmt_close($stmt);
              header('Location: ?halaman=sub-bidang&notice=added');
              exit;
            } else {
              $pesan_error = "Gagal menyimpan data: " . mysqli_error($koneksi);
              mysqli_stmt_close($stmt);
            }
          }
        }
      }
    }
  }
}

// Jika edit atau hapus
if (isset($_GET['hal']) && isset($_GET['id'])) {
    $id_bidang = mysqli_real_escape_string($koneksi, $_GET['id']);

    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM sub_bidang WHERE id_bidang = '$id_bidang'");
        if ($tampil) {
            $data = mysqli_fetch_array($tampil);
            if ($data) {
                $vnama_bidang = $data['nama_bidang'];
                $vkouta = $data['kouta'];
                $vdeskripsi = $data['deskripsi'];
            } else {
                $pesan_error = "Data tidak ditemukan!";
            }
        } else {
            $pesan_error = "Error query: " . mysqli_error($koneksi);
        }

  } elseif ($_GET['hal'] == "hapus") {
        // Cek apakah bidang ini masih digunakan oleh mahasiswa
        $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang WHERE id_bidang = '$id_bidang'");
        if ($cek) {
            $hasil = mysqli_fetch_assoc($cek);

            if ($hasil['total'] > 0) {
        header('Location: ?halaman=sub-bidang&notice=delete_blocked&count=' . (int)$hasil['total']);
        exit;
            } else {
                $hapus = mysqli_query($koneksi, "DELETE FROM sub_bidang WHERE id_bidang = '$id_bidang'");
                if ($hapus) {
          header('Location: ?halaman=sub-bidang&notice=deleted');
          exit;
                } else {
          header('Location: ?halaman=sub-bidang&notice=delete_failed');
          exit;
                }
            }
        } else {
      header('Location: ?halaman=sub-bidang&notice=delete_failed');
      exit;
        }
    }
}

?>

























<!-- Alert Messages -->
<?php if (!empty($pesan_error)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> <?= htmlspecialchars($pesan_error) ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<?php if (!empty($pesan_sukses)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> <?= htmlspecialchars($pesan_sukses) ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white">
    <i class="fas fa-sitemap"></i> 
    <?= (isset($_GET['hal']) && $_GET['hal'] == 'edit') ? 'Edit Data Bidang' : 'Form Data Bidang' ?>
  </div>
  <div class="card-body">
    <form method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
      <?php if (isset($_GET['hal']) && $_GET['hal'] == 'edit' && isset($_GET['id'])): ?>
        <input type="hidden" name="id_bidang" value="<?= (int)$_GET['id'] ?>">
      <?php endif; ?>
      <div class="form-group">
        <label for="nama_bidang"><i class="fas fa-tag"></i> Sub Bidang</label>
        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" 
               value="<?= htmlspecialchars($vnama_bidang) ?>" 
               placeholder="Contoh: Teknologi Informasi" required>
      </div>
      
      <div class="form-group">
        <label for="kouta_bidang"><i class="fas fa-users"></i> Kuota</label>
        <input type="number" class="form-control" id="kouta_bidang" name="kouta" 
               value="<?= htmlspecialchars($vkouta) ?>" 
               placeholder="Contoh: 10" min="1" required>
        <small class="form-text text-muted">Jumlah maksimal mahasiswa yang dapat diterima</small>
      </div>
      
      <div class="form-group">
        <label for="deskripsi"><i class="fas fa-file-text"></i> Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                  placeholder="Deskripsi singkat tentang bidang ini..." required><?= htmlspecialchars($vdeskripsi) ?></textarea>
      </div>

      <div class="form-group">
        <button type="submit" name="bsimpan" class="btn btn-primary">
          <i class="fas fa-save"></i> 
          <?= (isset($_GET['hal']) && $_GET['hal'] == 'edit') ? 'Update Data' : 'Simpan Data' ?>
        </button>
        <a href="?halaman=sub-bidang" class="btn btn-secondary">
          <i class="fas fa-times"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white d-flex justify-content-between align-items-center">
    <span><i class="fas fa-list"></i> Data Bidang</span>
    <a href="?halaman=sub-bidang" class="btn btn-light btn-sm">
      <i class="fas fa-plus"></i> Tambah Bidang
    </a>
  </div>
  <div class="card-body">
    <?php
    $tampil = mysqli_query($koneksi, "SELECT sb.*, COUNT(pm.id_mahasiswa) as jumlah_mahasiswa 
                                    FROM sub_bidang sb 
                                    LEFT JOIN peserta_magang pm ON sb.id_bidang = pm.id_bidang 
                                    GROUP BY sb.id_bidang 
                                    ORDER BY sb.id_bidang DESC");
    
    if ($tampil && mysqli_num_rows($tampil) > 0):
    ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
          <tr>
            <th width="5%">No</th>
            <th width="25%">Nama Bidang</th>
            <th width="10%">Kuota</th>
            <th width="10%">Terisi</th>
            <th width="10%">Sisa</th>
            <th width="30%">Deskripsi</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($data = mysqli_fetch_array($tampil)) :
            $sisa_kuota = $data['kouta'] - $data['jumlah_mahasiswa'];
            $persentase = $data['kouta'] > 0 ? ($data['jumlah_mahasiswa'] / $data['kouta']) * 100 : 0;
          ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><strong><?= htmlspecialchars($data['nama_bidang']) ?></strong></td>
              <td class="text-center">
                <span class="badge badge-primary"><?= htmlspecialchars($data['kouta']) ?></span>
              </td>
              <td class="text-center">
                <span class="badge badge-info"><?= htmlspecialchars($data['jumlah_mahasiswa']) ?></span>
              </td>
              <td class="text-center">
                <?php if ($sisa_kuota > 0): ?>
                  <span class="badge badge-success"><?= $sisa_kuota ?></span>
                <?php else: ?>
                  <span class="badge badge-danger">Penuh</span>
                <?php endif; ?>
              </td>
              <td><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></td>
              <td>
                <div class="btn-group" role="group">
                  <a href="?halaman=sub-bidang&hal=edit&id=<?= $data['id_bidang'] ?>" 
                     class="btn btn-success btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="?halaman=sub-bidang&hal=hapus&id=<?= $data['id_bidang'] ?>" 
                     class="btn btn-danger btn-sm" 
                     onclick="return confirm('Apakah yakin ingin menghapus bidang <?= htmlspecialchars($data['nama_bidang']) ?>?')"
                     title="Hapus">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="text-center py-4">
      <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
      <p class="text-muted">Belum ada data bidang.</p>
      <a href="?halaman=sub-bidang" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Bidang Pertama
      </a>
    </div>
    <?php endif; ?>
  </div>
</div>


