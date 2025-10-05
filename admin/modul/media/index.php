<?php
require_once __DIR__ . '/../../config/koneksi.php';

// Ensure table exists
mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS `site_media` (
  `media_key` VARCHAR(50) NOT NULL,
  `title` VARCHAR(150) DEFAULT NULL,
  `caption` VARCHAR(255) DEFAULT NULL,
  `filename` VARCHAR(255) DEFAULT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

function sanitize($s){ return htmlspecialchars(trim($s ?? ''), ENT_QUOTES, 'UTF-8'); }

$uploadDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
if (!is_dir($uploadDir)) { @mkdir($uploadDir, 0777, true); }

$mediaItems = [
  'hero_main' => 'Hero Utama (kanan) - gambar besar',
  'about_main' => 'About - gambar kanan',
];

$alert = '';

// Delete handler
if (isset($_GET['hapus'])) {
  $key = preg_replace('/[^a-z0-9_\-]/i','', $_GET['hapus']);
  $q = mysqli_query($koneksi, "SELECT filename FROM site_media WHERE media_key='".$key."'");
  if ($q && ($r = mysqli_fetch_assoc($q)) && !empty($r['filename'])) {
    @unlink($uploadDir . $r['filename']);
  }
  // clear filename but keep record
  mysqli_query($koneksi, "UPDATE site_media SET filename=NULL WHERE media_key='".$key."'");
  header('Location: ?halaman=media');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['media_key'])) {
  $key = preg_replace('/[^a-z0-9_\-]/i','', $_POST['media_key']);
  $title = sanitize($_POST['title'] ?? '');
  $caption = sanitize($_POST['caption'] ?? '');
  $filename = null;

  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['photo']['tmp_name'];
    $mime = @mime_content_type($tmp) ?: '';
    if (!in_array($mime, ['image/jpeg','image/pjpeg','image/png','image/webp'])) {
      $alert = '<div class="alert alert-danger alert-modern">Format tidak didukung. Gunakan JPG/PNG/WebP.</div>';
    } else {
      $ext = $mime === 'image/png' ? '.png' : ($mime === 'image/webp' ? '.webp' : '.jpg');
      $filename = $key . '_' . time() . '_' . bin2hex(random_bytes(3)) . $ext;
      $dest = $uploadDir . $filename;
      if (@move_uploaded_file($tmp, $dest)) {
        // Remove old file if exists to avoid orphan
        $qOld = mysqli_query($koneksi, "SELECT filename FROM site_media WHERE media_key='".$key."'");
        if ($qOld && ($old = mysqli_fetch_assoc($qOld)) && !empty($old['filename'])) {
          @unlink($uploadDir . $old['filename']);
        }
      } else {
        $alert = '<div class="alert alert-danger alert-modern">Gagal menyimpan file.</div>';
      }
    }
  }

  if (!$alert) {
    // Upsert
    $stmt = mysqli_prepare($koneksi, "INSERT INTO site_media(media_key, title, caption, filename) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE title=VALUES(title), caption=VALUES(caption), filename=COALESCE(VALUES(filename), filename)");
    mysqli_stmt_bind_param($stmt, 'ssss', $key, $title, $caption, $filename);
    if ($stmt && mysqli_stmt_execute($stmt)) {
      $alert = '<div class="alert alert-success alert-modern">Media berhasil diperbarui.</div>';
    } else {
      $alert = '<div class="alert alert-danger alert-modern">Gagal menyimpan media.</div>';
    }
  }
}

// Fetch current media
$current = [];
$res = mysqli_query($koneksi, "SELECT * FROM site_media");
while ($res && ($r = mysqli_fetch_assoc($res))) { $current[$r['media_key']] = $r; }
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card card-modern mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="fas fa-image"></i> Kelola Media Situs</h5>
          <a href="?halaman=media" class="btn btn-sm btn-outline-secondary"><i class="fas fa-rotate"></i> Muat Ulang</a>
        </div>
        <div class="card-body">
          <?php if ($alert) echo $alert; ?>
          <div class="row">
            <?php foreach ($mediaItems as $key => $label): $r = $current[$key] ?? null; $src = $r && $r['filename'] ? ('../img/media/uploads/' . $r['filename']) : ''; ?>
            <div class="col-md-6 mb-4">
              <div class="border rounded p-3 h-100">
                <h6 class="mb-2"><?=sanitize($label)?></h6>
                <?php if ($src): ?>
                  <img src="<?=$src?>" alt="<?=$key?>" style="width:100%;height:260px;object-fit:cover;border-radius:10px;" class="mb-2"/>
                <?php else: ?>
                  <div class="d-flex align-items-center justify-content-center bg-light mb-2" style="width:100%;height:260px;border-radius:10px;color:#888;">Belum ada gambar</div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="media_key" value="<?=$key?>"/>
                  <div class="form-group">
                    <label>Judul (opsional)</label>
                    <input type="text" name="title" class="form-control" maxlength="150" value="<?=sanitize($r['title'] ?? '')?>"/>
                  </div>
                  <div class="form-group">
                    <label>Keterangan (opsional)</label>
                    <input type="text" name="caption" class="form-control" maxlength="255" value="<?=sanitize($r['caption'] ?? '')?>"/>
                  </div>
                  <div class="form-group">
                    <label>Ganti Gambar (JPG/PNG/WebP)</label>
                    <input type="file" name="photo" class="form-control-file" accept="image/jpeg,image/png,image/webp"/>
                  </div>
                  <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                    <a href="?halaman=media&hapus=<?=$key?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus gambar untuk <?=$key?>?')">
                      <i class="fas fa-trash"></i> Hapus Gambar
                    </a>
                  </div>
                </form>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
