<?php
// Error handling: log errors but don't display to end users
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
// Ensure there's a PHP error log configured in php.ini; if not, you can set a file:
// ini_set('error_log', __DIR__ . '/php-error.log');

// koneksi
include "../admin/config/koneksi.php";

$vnama = '';
$vasal = '';
$vid_bidang = '';
$vtgl_masuk = '';
$vtgl_keluar = '';
$vstatus = '';
$vnomor_surat = '';
$vbalasan_file = '';
$vsertifikat_file = '';

if (!function_exists('safe_input')) {
  function safe_input($value)
  {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
  }
}

// aksi hapus data
if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    $id_mahasiswa = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil data mahasiswa untuk hapus file terkait
    $data_mhs = mysqli_query($koneksi, "SELECT nama_mahasiswa, asal_instansi FROM peserta_magang WHERE id_mahasiswa = '$id_mahasiswa'");
    $mhs = mysqli_fetch_array($data_mhs);
    
    if ($mhs) {
        $nama_mahasiswa = strtoupper($mhs['nama_mahasiswa']);
        $asal_instansi = strtoupper($mhs['asal_instansi']);
        
        // Hapus file balasan surat
        $balasan = mysqli_query($koneksi, "SELECT file_pdf FROM balasan_surat WHERE UPPER(nama_pengirim) = '$nama_mahasiswa' AND UPPER(asal_instansi) = '$asal_instansi'");
        while ($file_balasan = mysqli_fetch_array($balasan)) {
            $file_path = "../file_balasan/" . $file_balasan['file_pdf'];
            if (file_exists($file_path)) unlink($file_path);
        }
        
        // Hapus file sertifikat
        $sertifikat = mysqli_query($koneksi, "SELECT file_sertifikat FROM data_sertifikat WHERE UPPER(nama_lengkap) = '$nama_mahasiswa' AND UPPER(asal_instansi) = '$asal_instansi'");
        while ($file_cert = mysqli_fetch_array($sertifikat)) {
            $file_path = "../file_sertifikat/" . $file_cert['file_sertifikat'];
            if (file_exists($file_path)) unlink($file_path);
        }
        
        // Hapus data dari tabel terkait
        mysqli_query($koneksi, "DELETE FROM balasan_surat WHERE UPPER(nama_pengirim) = '$nama_mahasiswa' AND UPPER(asal_instansi) = '$asal_instansi'");
        mysqli_query($koneksi, "DELETE FROM data_sertifikat WHERE UPPER(nama_lengkap) = '$nama_mahasiswa' AND UPPER(asal_instansi) = '$asal_instansi'");
    }
    
    // Hapus data mahasiswa
    $hapus = mysqli_query($koneksi, "DELETE FROM peserta_magang WHERE id_mahasiswa = '$id_mahasiswa'");
  if ($hapus) {
    echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=deleted"></noscript>';
    echo '<script>location.href="?halaman=mahasiswa&notice=deleted";</script>';
    exit;
  }
}

// tampilkan data yang akan diedit
if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
    $id_mahasiswa = mysqli_real_escape_string($koneksi, $_GET['id']);
    $tampil = mysqli_query($koneksi, "
        SELECT pm.*, 
               bs.nomor_surat, bs.file_pdf as balasan_file,
               ds.file_sertifikat
        FROM peserta_magang pm
        LEFT JOIN balasan_surat bs ON UPPER(bs.nama_pengirim) = UPPER(pm.nama_mahasiswa) 
                                   AND UPPER(bs.asal_instansi) = UPPER(pm.asal_instansi)
        LEFT JOIN data_sertifikat ds ON UPPER(ds.nama_lengkap) = UPPER(pm.nama_mahasiswa) 
                                     AND UPPER(ds.asal_instansi) = UPPER(pm.asal_instansi)
        WHERE pm.id_mahasiswa = '$id_mahasiswa'
    ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
    $vnama = $data['nama_mahasiswa'];
    $vasal = $data['asal_instansi'];
        $vid_bidang = $data['id_bidang'];
        $vtgl_masuk = $data['tgl_masuk'];
        $vtgl_keluar = $data['tgl_keluar'];
        $vstatus = $data['status'];
    $vnomor_surat = $data['nomor_surat'] ?? '';
        $vbalasan_file = $data['balasan_file'];
        $vsertifikat_file = $data['file_sertifikat'];
    }
}

// tombol simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $today = date('Y-m-d');

    if ($_POST['tgl_masuk'] > $today) {
        $status_auto = 'Belum Aktif';
    } elseif ($_POST['tgl_keluar'] <= $today) {
        $status_auto = 'Selesai';
    } else {
        $status_auto = 'Aktif';
    }

  // Tentukan status akhir: gunakan input user bila valid, jika kosong gunakan otomatis
  $allowed_statuses = ['Aktif', 'Belum Aktif', 'Selesai'];
  $status_input = isset($_POST['status']) ? trim($_POST['status']) : '';
  $status_final = in_array($status_input, $allowed_statuses, true) ? $status_input : $status_auto;

    $nama_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_mahasiswa']);
    $asal_instansi = mysqli_real_escape_string($koneksi, $_POST['asal_instansi']);
    $id_bidang = mysqli_real_escape_string($koneksi, $_POST['id_bidang']);
    $tgl_masuk = mysqli_real_escape_string($koneksi, $_POST['tgl_masuk']);
    $tgl_keluar = mysqli_real_escape_string($koneksi, $_POST['tgl_keluar']);
    $nomor_surat = isset($_POST['nomor_surat']) ? mysqli_real_escape_string($koneksi, trim($_POST['nomor_surat'])) : '';

  if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
    // Ambil owner lama sebelum update (untuk validasi nomor_surat)
  $id_edit = mysqli_real_escape_string($koneksi, $_GET['id']);
  $resOld = mysqli_query($koneksi, "SELECT nama_mahasiswa AS nama_lama, asal_instansi AS instansi_lama FROM peserta_magang WHERE id_mahasiswa = '$id_edit' LIMIT 1");
  $rowOld = $resOld ? mysqli_fetch_assoc($resOld) : null;
  $nama_lama = $rowOld ? strtoupper($rowOld['nama_lama']) : strtoupper($nama_mahasiswa);
  $instansi_lama = $rowOld ? strtoupper($rowOld['instansi_lama']) : strtoupper($asal_instansi);

    // Update data mahasiswa
  $update_query = "UPDATE peserta_magang SET
            nama_mahasiswa = '$nama_mahasiswa',
            asal_instansi = '$asal_instansi',
            id_bidang = '$id_bidang',
            tgl_masuk = '$tgl_masuk',
            tgl_keluar = '$tgl_keluar',
      status = '" . mysqli_real_escape_string($koneksi, $status_final) . "'
      WHERE id_mahasiswa = '" . mysqli_real_escape_string($koneksi, $_GET['id']) . "'";
        
        $ubah = mysqli_query($koneksi, $update_query);
        
    if (!$ubah) {
      $error_message = addslashes(mysqli_error($koneksi));
      echo "<script>
          alert('Ubah Data Gagal: $error_message');
          window.history.back();
          </script>";
      exit;
    }

    // Validasi & Upsert balasan_surat saat nomor_surat diisi
    if (!empty($nomor_surat)) {
      // Cek apakah nomor_surat sudah ada dan milik siapa
      $dup = mysqli_query($koneksi, "SELECT nama_pengirim, asal_instansi FROM balasan_surat WHERE nomor_surat = UPPER('$nomor_surat') LIMIT 1");
      if ($dup && mysqli_num_rows($dup) > 0) {
        $dupRow = mysqli_fetch_assoc($dup);
        $ownerIsNew = (strtoupper($dupRow['nama_pengirim']) === strtoupper($nama_mahasiswa)) && (strtoupper($dupRow['asal_instansi']) === strtoupper($asal_instansi));
        $ownerIsOld = (strtoupper($dupRow['nama_pengirim']) === $nama_lama) && (strtoupper($dupRow['asal_instansi']) === $instansi_lama);
        if (!$ownerIsNew && !$ownerIsOld) {
          echo "<script>alert('Nomor surat sudah digunakan oleh data lain. Gunakan nomor lain.'); window.history.back();</script>"; exit;
        }
        // Nomor surat milik kita (lama/baru) -> perbarui owner ke data terbaru
        mysqli_query($koneksi, "UPDATE balasan_surat SET nama_pengirim = UPPER('$nama_mahasiswa'), asal_instansi = UPPER('$asal_instansi') WHERE nomor_surat = UPPER('$nomor_surat')");
      } else {
        // Belum ada baris untuk nomor_surat ini -> upsert berdasarkan nama+instansi
        $cek_balasan = mysqli_query($koneksi, "SELECT 1 FROM balasan_surat WHERE UPPER(nama_pengirim) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
        if ($cek_balasan && mysqli_num_rows($cek_balasan) > 0) {
          mysqli_query($koneksi, "UPDATE balasan_surat SET nomor_surat = UPPER('$nomor_surat') WHERE UPPER(nama_pengirim) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
        } else {
          mysqli_query($koneksi, "INSERT INTO balasan_surat (nomor_surat, nama_pengirim, asal_instansi, file_pdf) VALUES (UPPER('$nomor_surat'), UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '')");
        }
      }
    }

        // Handle file upload balasan surat
        if (isset($_FILES['file_balasan']) && !empty($_FILES['file_balasan']['name'])) {
            $file_balasan = $_FILES['file_balasan'];
            $ext = strtolower(pathinfo($file_balasan['name'], PATHINFO_EXTENSION));
            
            if ($ext == 'pdf' && $file_balasan['size'] <= 2*1024*1024) {
                $nama_file_balasan = time() . "_" . preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($file_balasan['name'], PATHINFO_FILENAME)) . ".pdf";
                $target_balasan = "../file_balasan/" . $nama_file_balasan;
                
        if (!is_dir("../file_balasan/")) {
          @mkdir("../file_balasan/", 0777, true);
        }
        if (!is_dir("../file_balasan/") || !is_writable("../file_balasan/")) {
          echo "<script>alert('Folder upload balasan tidak dapat diakses/tulis. Hubungi admin.'); window.history.back();</script>"; exit;
        }
        if (move_uploaded_file($file_balasan['tmp_name'], $target_balasan)) {
                    $cek_balasan = mysqli_query($koneksi, "SELECT * FROM balasan_surat WHERE UPPER(nama_pengirim) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
                    
                    if (mysqli_num_rows($cek_balasan) > 0) {
                        mysqli_query($koneksi, "UPDATE balasan_surat SET file_pdf = '$nama_file_balasan' WHERE UPPER(nama_pengirim) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
                    } else {
                        mysqli_query($koneksi, "INSERT INTO balasan_surat (nomor_surat, nama_pengirim, asal_instansi, file_pdf) VALUES (UPPER('$nomor_surat'), UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '$nama_file_balasan')");
                    }
                }
            }
        }

        // Handle file upload sertifikat
        if (isset($_FILES['file_sertifikat']) && !empty($_FILES['file_sertifikat']['name'])) {
            $file_sertifikat = $_FILES['file_sertifikat'];
            $ext = strtolower(pathinfo($file_sertifikat['name'], PATHINFO_EXTENSION));
            
            if ($ext == 'pdf' && $file_sertifikat['size'] <= 2*1024*1024) {
                $nama_file_sertifikat = time() . "_" . preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($file_sertifikat['name'], PATHINFO_FILENAME)) . ".pdf";
                $target_sertifikat = "../file_sertifikat/" . $nama_file_sertifikat;
                
        if (!is_dir("../file_sertifikat/")) {
          @mkdir("../file_sertifikat/", 0777, true);
        }
        if (!is_dir("../file_sertifikat/") || !is_writable("../file_sertifikat/")) {
          echo "<script>alert('Folder upload sertifikat tidak dapat diakses/tulis. Hubungi admin.'); window.history.back();</script>"; exit;
        }
        if (move_uploaded_file($file_sertifikat['tmp_name'], $target_sertifikat)) {
                    $cek_sertifikat = mysqli_query($koneksi, "SELECT * FROM data_sertifikat WHERE UPPER(nama_lengkap) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
                    
                    if (mysqli_num_rows($cek_sertifikat) > 0) {
                        mysqli_query($koneksi, "UPDATE data_sertifikat SET file_sertifikat = '$nama_file_sertifikat', id_bidang = '$id_bidang' WHERE UPPER(nama_lengkap) = UPPER('$nama_mahasiswa') AND UPPER(asal_instansi) = UPPER('$asal_instansi')");
                    } else {
                        mysqli_query($koneksi, "INSERT INTO data_sertifikat (nama_lengkap, asal_instansi, id_bidang, file_sertifikat) VALUES (UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '$id_bidang', '$nama_file_sertifikat')");
                    }
                }
            }
        }

    if ($ubah) {
      echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=updated"></noscript>';
      echo '<script>location.href="?halaman=mahasiswa&notice=updated";</script>';
      exit;
    } else {
      echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=update_failed"></noscript>';
      echo '<script>location.href="?halaman=mahasiswa&notice=update_failed";</script>';
      exit;
    }
  } else {
    // cek kuota dengan prepared statement dan validasi baris
    $stmtK = mysqli_prepare($koneksi, "SELECT kouta FROM sub_bidang WHERE id_bidang = ? LIMIT 1");
    if (!$stmtK) {
      $error_message = addslashes(mysqli_error($koneksi));
      echo "<script>alert('Gagal menyiapkan kueri kuota: $error_message'); window.history.back();</script>"; exit;
    }
    mysqli_stmt_bind_param($stmtK, 's', $id_bidang);
    mysqli_stmt_execute($stmtK);
    mysqli_stmt_bind_result($stmtK, $kouta);
    $hasRow = mysqli_stmt_fetch($stmtK);
    mysqli_stmt_close($stmtK);

    if (!$hasRow) {
      echo "<script>alert('Sub Bidang tidak ditemukan. Silakan pilih ulang.'); window.history.back();</script>"; exit;
    }

    if ((int)$kouta > 0) {
      // Validasi nomor_surat pada INSERT: jika sudah ada, tolak
      if (!empty($nomor_surat)) {
        $dup = mysqli_query($koneksi, "SELECT 1 FROM balasan_surat WHERE nomor_surat = UPPER('$nomor_surat') LIMIT 1");
        if ($dup && mysqli_num_rows($dup) > 0) {
          echo "<script>alert('Nomor surat sudah digunakan. Gunakan nomor lain.'); window.history.back();</script>"; exit;
        }
      }
      // simpan data mahasiswa baru (prepared statement)
      $stmt = mysqli_prepare($koneksi, "INSERT INTO peserta_magang (nama_mahasiswa, asal_instansi, id_bidang, tgl_masuk, tgl_keluar, status) VALUES (?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
        $error_message = addslashes(mysqli_error($koneksi));
        echo "<script>alert('Gagal menyiapkan kueri simpan: $error_message'); window.history.back();</script>"; exit;
      }
  mysqli_stmt_bind_param($stmt, 'ssssss', $nama_mahasiswa, $asal_instansi, $id_bidang, $tgl_masuk, $tgl_keluar, $status_final);
      $simpan = mysqli_stmt_execute($stmt);
      $newId = mysqli_insert_id($koneksi);
      $stmtErr = addslashes(mysqli_error($koneksi));
      mysqli_stmt_close($stmt);

      if (!$simpan || $newId <= 0) {
        echo "<script>alert('Simpan Data Gagal: $stmtErr'); window.history.back();</script>"; exit;
      }

      if ($simpan) {
                // Simpan data balasan surat jika ada
                if (!empty($nomor_surat)) {
                    // Handle file upload balasan surat
                    if (isset($_FILES['file_balasan']) && !empty($_FILES['file_balasan']['name'])) {
                        $file_balasan = $_FILES['file_balasan'];
                        $ext = strtolower(pathinfo($file_balasan['name'], PATHINFO_EXTENSION));
                        
                        if ($ext == 'pdf' && $file_balasan['size'] <= 2*1024*1024) {
                            $nama_file_balasan = time() . "_" . preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($file_balasan['name'], PATHINFO_FILENAME)) . ".pdf";
                            $target_balasan = "../file_balasan/" . $nama_file_balasan;
                            
              if (!is_dir("../file_balasan/")) {
                @mkdir("../file_balasan/", 0777, true);
              }
              if (!is_dir("../file_balasan/") || !is_writable("../file_balasan/")) {
                echo "<script>alert('Folder upload balasan tidak dapat diakses/tulis. Hubungi admin.'); window.history.back();</script>"; exit;
              }
              if (move_uploaded_file($file_balasan['tmp_name'], $target_balasan)) {
                                mysqli_query($koneksi, "INSERT INTO balasan_surat (nomor_surat, nama_pengirim, asal_instansi, file_pdf) VALUES (UPPER('$nomor_surat'), UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '$nama_file_balasan')");
                            }
                        }
                    } else {
                        // Insert tanpa file jika hanya nomor surat
                        mysqli_query($koneksi, "INSERT INTO balasan_surat (nomor_surat, nama_pengirim, asal_instansi, file_pdf) VALUES (UPPER('$nomor_surat'), UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '')");
                    }
                }

                // Handle file upload sertifikat
                if (isset($_FILES['file_sertifikat']) && !empty($_FILES['file_sertifikat']['name'])) {
                    $file_sertifikat = $_FILES['file_sertifikat'];
                    $ext = strtolower(pathinfo($file_sertifikat['name'], PATHINFO_EXTENSION));
                    
                    if ($ext == 'pdf' && $file_sertifikat['size'] <= 2*1024*1024) {
                        $nama_file_sertifikat = time() . "_" . preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($file_sertifikat['name'], PATHINFO_FILENAME)) . ".pdf";
                        $target_sertifikat = "../file_sertifikat/" . $nama_file_sertifikat;
                        
            if (!is_dir("../file_sertifikat/")) {
              @mkdir("../file_sertifikat/", 0777, true);
            }
            if (!is_dir("../file_sertifikat/") || !is_writable("../file_sertifikat/")) {
              echo "<script>alert('Folder upload sertifikat tidak dapat diakses/tulis. Hubungi admin.'); window.history.back();</script>"; exit;
            }
            if (move_uploaded_file($file_sertifikat['tmp_name'], $target_sertifikat)) {
                            mysqli_query($koneksi, "INSERT INTO data_sertifikat (nama_lengkap, asal_instansi, id_bidang, file_sertifikat) VALUES (UPPER('$nama_mahasiswa'), UPPER('$asal_instansi'), '$id_bidang', '$nama_file_sertifikat')");
                        }
                    }
                }

        echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=added"></noscript>';
        echo '<script>location.href="?halaman=mahasiswa&notice=added";</script>';
        exit;
            } else {
        echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=add_failed"></noscript>';
        echo '<script>location.href="?halaman=mahasiswa&notice=add_failed";</script>';
        exit;
            }
        } else {
      echo '<noscript><meta http-equiv="refresh" content="0;url=?halaman=mahasiswa&notice=quota_full"></noscript>';
      echo '<script>location.href="?halaman=mahasiswa&notice=quota_full";</script>';
      exit;
        }
    }
}
?>


<!-- Formulir Terintegrasi untuk Data Mahasiswa -->
<div class="card-modern mb-4">
  <div class="card-header">
    <i class="fas fa-user-graduate"></i> Form Data Mahasiswa Terintegrasi
    <small class="text-muted d-block mt-1 text-custom-white"> Input semua data dalam satu form: Data Mahasiswa, Balasan Surat, dan Sertifikat</small>
  </div>
  <div class="card-body">
  <form method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8') ?>" enctype="multipart/form-data">
      
      <!-- Section Data Mahasiswa -->
      <div class="form-section mb-4">
        <h5 class="section-title"><i class="fas fa-user text-primary"></i> Data Mahasiswa</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_mahasiswa">Nama Mahasiswa</label>
              <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= safe_input($vnama) ?>" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="asal_instansi">Asal Instansi</label>
              <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="<?= safe_input($vasal) ?>" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="id_bidang">Sub Bidang</label>
              <select class="form-control" id="id_bidang" name="id_bidang" required>
                <option value="">-- Pilih Sub Bidang --</option>
                <?php
                $bidang = mysqli_query($koneksi, "SELECT * FROM sub_bidang ORDER BY nama_bidang");
                while ($row = mysqli_fetch_array($bidang)) {
                    $selected = ($vid_bidang == $row['id_bidang']) ? 'selected' : '';
                    echo "<option value='{$row['id_bidang']}' $selected>{$row['nama_bidang']} (Kuota: {$row['kouta']})</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="tgl_masuk">Tanggal Masuk</label>
              <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= safe_input($vtgl_masuk) ?>" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="tgl_keluar">Tanggal Keluar</label>
              <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" value="<?= safe_input($vtgl_keluar) ?>" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="status">Status Mahasiswa</label>
              <select class="form-control" id="status" name="status">
                <option value="">-- Otomatis (berdasarkan tanggal) --</option>
                <option value="Aktif" <?= $vstatus === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Belum Aktif" <?= $vstatus === 'Belum Aktif' ? 'selected' : '' ?>>Belum Aktif</option>
                <option value="Selesai" <?= $vstatus === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
              </select>
              <small class="form-text text-muted">Biarkan kosong untuk menentukan otomatis dari tanggal masuk/keluar.</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Section Balasan Surat -->
      <div class="form-section mb-4">
        <h5 class="section-title"><i class="fas fa-envelope text-success"></i> Balasan Surat</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nomor_surat">Nomor Surat</label>
              <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" 
                     value="<?= safe_input($vnomor_surat) ?>" 
                     placeholder="Contoh: 001/PLN/2024">
              <small class="form-text text-muted" style="color: #ee2a2aff !important">Kosongkan jika belum ada</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="file_balasan">File Balasan Surat (PDF)</label>
              <input type="file" class="form-control" id="file_balasan" name="file_balasan" accept=".pdf">
              <small class="form-text text-muted">Maksimal 2MB, format PDF</small>
              <?php if (isset($vbalasan_file) && !empty($vbalasan_file)): ?>
                <div class="mt-2">
                  <a href="../file_balasan/<?= urlencode($vbalasan_file) ?>" target="_blank" class="btn btn-info btn-sm">
                    <i class="fas fa-file-pdf"></i> Lihat File Saat Ini
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Section Sertifikat -->
      <div class="form-section mb-4">
        <h5 class="section-title"><i class="fas fa-certificate text-warning"></i> Sertifikat</h5>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="file_sertifikat">File Sertifikat (PDF)</label>
              <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat" accept=".pdf">
              <small class="form-text text-muted">Maksimal 2MB, format PDF</small>
              <?php if (isset($vsertifikat_file) && !empty($vsertifikat_file)): ?>
                <div class="mt-2">
                  <a href="../file_sertifikat/<?= urlencode($vsertifikat_file) ?>" target="_blank" class="btn btn-warning btn-sm">
                    <i class="fas fa-certificate"></i> Lihat Sertifikat Saat Ini
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="form-actions">
        <button type="submit" name="bsimpan" value="1" class="btn btn-primary">
          <i class="fas fa-save"></i> 
          <?= (isset($_GET['hal']) && $_GET['hal'] == 'edit') ? 'Update Data' : 'Simpan Data' ?>
        </button>
        <a href="?halaman=mahasiswa" class="btn btn-secondary">
          <i class="fas fa-times"></i> Batal
        </a>
      </div>
    </form>
  </div>
</div>

<!-- Informasi Penting -->
<div class="alert-modern alert-info">
  <i class="fas fa-info-circle"></i>
  <strong>Informasi Penting:</strong>
  <ul class="mb-0 mt-2">
    <li>Semua data (mahasiswa, balasan surat, sertifikat) dapat diinput dalam satu form</li>
    <li>File balasan surat dan sertifikat bersifat opsional - dapat diupload nanti</li>
    <li>Status mahasiswa akan otomatis dihitung berdasarkan tanggal masuk dan keluar</li>
    <li>Kuota bidang akan otomatis dicek sebelum menyimpan data</li>
  </ul>
</div>

<style>
.text-custom-white {
  color: #dbd5d5ff !important;
}
.form-section {
  border: 1px solid #e3e6f0;
  border-radius: 8px;
  padding: 20px;
  background: #f8f9fc;
}

.section-title {
  color: var(--pln-primary);
  font-weight: 600;
  margin-bottom: 15px;
  padding-bottom: 8px;
  border-bottom: 2px solid #e3e6f0;
}

.form-actions {
  text-align: center;
  padding-top: 20px;
  border-top: 1px solid #e3e6f0;
}

.form-actions .btn {
  margin: 0 10px;
  padding: 10px 25px;
}
</style>
