<?php
require_once __DIR__ . '/../../config/koneksi.php';

// Ensure table exists (safe no-op if already exists)
mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS `gallery_photos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) DEFAULT NULL,
  `caption` VARCHAR(255) DEFAULT NULL,
  `filename` VARCHAR(255) NOT NULL,
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");

// Upload handling
$alert = '';
function sanitize($s) {
    return htmlspecialchars(trim($s ?? ''), ENT_QUOTES, 'UTF-8');
}

// Helper to get file extension from MIME
function extension_from_mime($mime) {
    switch ($mime) {
        case 'image/jpeg':
        case 'image/pjpeg': return '.jpg';
        case 'image/png': return '.png';
        case 'image/webp': return '.webp';
        default: return '';
    }
}

// Crop & resize to 3:2 (e.g., 1200x800) using GD if available
function process_image_3x2($srcPath, $dstPath, $targetW = 1200, $targetH = 800) {
    $info = getimagesize($srcPath);
    if (!$info) return false;
    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg':
        case 'image/pjpeg':
      if (!function_exists('imagecreatefromjpeg') || !function_exists('imagejpeg')) return false;
      $src = @imagecreatefromjpeg($srcPath); break;
        case 'image/png':
      if (!function_exists('imagecreatefrompng') || !function_exists('imagepng')) return false;
      $src = @imagecreatefrompng($srcPath); break;
        case 'image/webp':
      if (!function_exists('imagecreatefromwebp') || !function_exists('imagewebp')) { return false; }
      $src = @imagecreatefromwebp($srcPath);
            break;
        default:
            return false;
    }
    if (!$src) return false;

    $w = imagesx($src); $h = imagesy($src);
    $targetRatio = $targetW / $targetH; // 1.5
    $srcRatio = $w / $h;

    if ($srcRatio > $targetRatio) {
        // source wider -> crop width
        $newW = (int) round($h * $targetRatio);
        $newH = $h;
        $sx = (int) round(($w - $newW)/2);
        $sy = 0;
    } else {
        // source taller -> crop height
        $newW = $w;
        $newH = (int) round($w / $targetRatio);
        $sx = 0;
        $sy = (int) round(($h - $newH)/2);
    }

    $crop = imagecreatetruecolor($targetW, $targetH);
    // For PNG/WebP keep transparency
    if ($mime === 'image/png' || $mime === 'image/webp') {
        imagealphablending($crop, false);
        imagesavealpha($crop, true);
        $transparent = imagecolorallocatealpha($crop, 0, 0, 0, 127);
        imagefilledrectangle($crop, 0, 0, $targetW, $targetH, $transparent);
    }

    imagecopyresampled($crop, $src, 0, 0, $sx, $sy, $targetW, $targetH, $newW, $newH);

    $ok = false;
  if ($mime === 'image/jpeg' || $mime === 'image/pjpeg') {
    $ok = @imagejpeg($crop, $dstPath, 82); // compress
  } elseif ($mime === 'image/png') {
    $ok = @imagepng($crop, $dstPath, 6);
  } elseif ($mime === 'image/webp') {
    if (function_exists('imagewebp')) { $ok = @imagewebp($crop, $dstPath, 82); }
  }

    imagedestroy($src); imagedestroy($crop);
    return $ok;
}

$uploadDir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload') {
    $title = sanitize($_POST['title'] ?? '');
    $caption = sanitize($_POST['caption'] ?? '');
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $alert = '<div class="alert alert-danger alert-modern">Gagal mengunggah file.</div>';
    } else {
        $tmp = $_FILES['photo']['tmp_name'];
        $mime = mime_content_type($tmp);
        if (!in_array($mime, ['image/jpeg','image/pjpeg','image/png','image/webp'])) {
            $alert = '<div class="alert alert-danger alert-modern">Format tidak didukung. Gunakan JPG, PNG atau WebP.</div>';
        } else {
            $ext = extension_from_mime($mime);
            $basename = time() . '_' . bin2hex(random_bytes(4)) . $ext;
            $dest = $uploadDir . $basename;
      // Process to 3:2 (if GD available). If not, fallback to simple move.
      if (process_image_3x2($tmp, $dest)) {
                // Insert DB with max sort_order + 1
                $resSO = mysqli_query($koneksi, "SELECT COALESCE(MAX(sort_order),0)+1 AS so FROM gallery_photos");
                $rowSO = $resSO ? mysqli_fetch_assoc($resSO) : ['so'=>1];
                $so = (int)$rowSO['so'];
                $stmt = mysqli_prepare($koneksi, "INSERT INTO gallery_photos(title, caption, filename, sort_order, is_active) VALUES(?,?,?,?,1)");
                mysqli_stmt_bind_param($stmt, 'sssi', $title, $caption, $basename, $so);
                if ($stmt && mysqli_stmt_execute($stmt)) {
                    $alert = '<div class="alert alert-success alert-modern">Foto berhasil ditambahkan.</div>';
                } else {
                    @unlink($dest);
                    $alert = '<div class="alert alert-danger alert-modern">Gagal menyimpan data.</div>';
                }
      } else {
        // Fallback: simpan file apa adanya jika GD tidak aktif.
        if (@move_uploaded_file($tmp, $dest)) {
          $resSO = mysqli_query($koneksi, "SELECT COALESCE(MAX(sort_order),0)+1 AS so FROM gallery_photos");
          $rowSO = $resSO ? mysqli_fetch_assoc($resSO) : ['so'=>1];
          $so = (int)$rowSO['so'];
          $stmt = mysqli_prepare($koneksi, "INSERT INTO gallery_photos(title, caption, filename, sort_order, is_active) VALUES(?,?,?,?,1)");
          mysqli_stmt_bind_param($stmt, 'sssi', $title, $caption, $basename, $so);
          if ($stmt && mysqli_stmt_execute($stmt)) {
            $alert = '<div class="alert alert-warning alert-modern">Foto ditambahkan tanpa pemotongan (ekstensi GD belum aktif). Tampilan tetap rapi karena CSS object-fit cover.</div>';
          } else {
            @unlink($dest);
            $alert = '<div class="alert alert-danger alert-modern">Gagal menyimpan data.</div>';
          }
        } else {
          $alert = '<div class="alert alert-danger alert-modern">Gagal memproses/menyimpan gambar (periksa izin folder img/gallery/uploads dan ekstensi GD).</div>';
        }
      }
        }
    }
}

// Toggle active
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    mysqli_query($koneksi, "UPDATE gallery_photos SET is_active = 1 - is_active WHERE id = $id");
    header('Location: ?halaman=galeri');
    exit;
}

// Delete
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $res = mysqli_query($koneksi, "SELECT filename FROM gallery_photos WHERE id=$id");
    $row = $res ? mysqli_fetch_assoc($res) : null;
    if ($row) {
        @unlink($uploadDir . $row['filename']);
    }
    mysqli_query($koneksi, "DELETE FROM gallery_photos WHERE id=$id");
    header('Location: ?halaman=galeri');
    exit;
}

// Reorder (move up/down)
if (isset($_GET['move']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $dir = $_GET['move'] === 'up' ? 'up' : 'down';
    $res = mysqli_query($koneksi, "SELECT id, sort_order FROM gallery_photos WHERE id=$id");
    if ($res && ($cur = mysqli_fetch_assoc($res))) {
        $so = (int)$cur['sort_order'];
        if ($dir === 'up') {
            $neighbor = mysqli_query($koneksi, "SELECT id, sort_order FROM gallery_photos WHERE sort_order < $so ORDER BY sort_order DESC LIMIT 1");
        } else {
            $neighbor = mysqli_query($koneksi, "SELECT id, sort_order FROM gallery_photos WHERE sort_order > $so ORDER BY sort_order ASC LIMIT 1");
        }
        if ($neighbor && ($nb = mysqli_fetch_assoc($neighbor))) {
            $id2 = (int)$nb['id']; $so2 = (int)$nb['sort_order'];
            mysqli_query($koneksi, "UPDATE gallery_photos SET sort_order=$so2 WHERE id=$id");
            mysqli_query($koneksi, "UPDATE gallery_photos SET sort_order=$so WHERE id=$id2");
        }
    }
    header('Location: ?halaman=galeri');
    exit;
}

// List data
$list = mysqli_query($koneksi, "SELECT * FROM gallery_photos ORDER BY sort_order, id");
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-7">
      <div class="card card-modern mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0"><i class="fas fa-images"></i> Galeri Foto</h5>
          <a href="?halaman=galeri" class="btn btn-sm btn-outline-secondary"><i class="fas fa-rotate"></i> Muat Ulang</a>
        </div>
        <div class="card-body">
          <?php if ($alert) echo $alert; ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead>
                <tr>
                  <th style="width: 80px">Gambar</th>
                  <th>Judul</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Urutan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($list && mysqli_num_rows($list) > 0): ?>
                  <?php while($r = mysqli_fetch_assoc($list)): ?>
                  <tr>
                    <td>
                      <?php $src = '../img/gallery/uploads/' . $r['filename']; ?>
                      <img src="<?=$src?>" alt="thumb" style="width:72px;height:48px;object-fit:cover;border-radius:8px;"/>
                    </td>
                    <td><?=sanitize($r['title'])?></td>
                    <td><?=sanitize($r['caption'])?></td>
                    <td>
                      <?php if ($r['is_active']): ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php else: ?>
                        <span class="badge badge-secondary">Nonaktif</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a class="btn btn-outline-primary" href="?halaman=galeri&move=up&id=<?=$r['id']?>" title="Naik"><i class="fas fa-arrow-up"></i></a>
                        <a class="btn btn-outline-primary" href="?halaman=galeri&move=down&id=<?=$r['id']?>" title="Turun"><i class="fas fa-arrow-down"></i></a>
                      </div>
                    </td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group">
                        <a class="btn btn-outline-secondary" href="?halaman=galeri&toggle=<?=$r['id']?>">Toggle</a>
                        <a class="btn btn-outline-danger" href="?halaman=galeri&hapus=<?=$r['id']?>" onclick="return confirm('Hapus foto ini?')"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="6" class="text-center text-muted">Belum ada foto di galeri.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card card-modern">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-upload"></i> Tambah Foto</h5></div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="upload"/>
            <div class="form-group">
              <label>Judul (opsional)</label>
              <input type="text" name="title" class="form-control" maxlength="150" placeholder="Contoh: Praktik Lapangan"/>
            </div>
            <div class="form-group">
              <label>Keterangan (opsional)</label>
              <input type="text" name="caption" class="form-control" maxlength="255" placeholder="Deskripsi singkat"/>
            </div>
            <div class="form-group">
              <label>Foto (JPG/PNG/WebP)</label>
              <input type="file" name="photo" class="form-control-file" accept="image/jpeg,image/png,image/webp" required/>
              <small class="form-text text-muted">Gambar akan otomatis dipotong ke rasio 3:2 dan dikompresi.</small>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Simpan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
