<?php
include "../admin/config/koneksi.php";

// Update otomatis status
mysqli_query($koneksi, "
    UPDATE peserta_magang 
    SET status = 'Aktif' 
    WHERE tgl_masuk = CURDATE() AND status = 'Belum Aktif'
");

mysqli_query($koneksi, "
    UPDATE peserta_magang 
    SET status = 'Selesai' 
    WHERE tgl_keluar <= CURDATE() AND status != 'Selesai'
");
?>

<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white">
    Data Mahasiswa
  </div>
  <div class="card-body">
    <?php if (isset($_GET['notice'])): ?>
      <?php
        $notice = $_GET['notice'];
        $map = [
          'added' => ['success', 'Data berhasil ditambahkan'],
          'updated' => ['success', 'Data berhasil diperbarui'],
          'deleted' => ['success', 'Data berhasil dihapus'],
          'quota_full' => ['warning', 'Kuota penuh untuk bidang ini'],
          'add_failed' => ['danger', 'Gagal menambah data'],
          'update_failed' => ['danger', 'Gagal memperbarui data'],
        ];
        $type = isset($map[$notice]) ? $map[$notice][0] : 'info';
        $msg = isset($map[$notice]) ? $map[$notice][1] : 'Operasi selesai';
      ?>
      <div class="alert alert-<?= htmlspecialchars($type) ?> alert-modern" role="alert">
        <i class="fas fa-info-circle"></i> <?= htmlspecialchars($msg) ?>
      </div>
    <?php endif; ?>
  <a href="?halaman=sub-bidang" class="btn btn-pln mb-3">Bidang</a>
  <a href="?halaman=mahasiswa&hal=tambahdata" class="btn btn-pln mb-3">Tambah Data</a>
    <div class="mb-3">
      <a href="modul/data-mahasiswa/export-pdf.php" class="btn btn-danger btn-sm">Export PDF</a>
      <a href="modul/data-mahasiswa/export-excel.php" class="btn btn-success btn-sm">Export Excel</a>
    </div>

    <!-- Pencarian & Filter Status (Professional Toolbar) -->
    <div class="search-toolbar mb-3">
      <form method="get" class="search-form" role="search" aria-label="Pencarian Data Mahasiswa">
        <input type="hidden" name="halaman" value="mahasiswa">
        <div class="search-row">
          <div class="search-input-wrap">
            <i class="fas fa-search" aria-hidden="true"></i>
            <label for="admSearch" class="sr-only">Kata kunci</label>
            <input id="admSearch" type="text" name="search" class="search-input" placeholder="Cari nama, instansi, sub bidang, atau nomor surat" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
          </div>
          <div class="search-select-wrap">
            <?php $statusSel = isset($_GET['status']) ? $_GET['status'] : ''; ?>
            <label for="admStatus" class="sr-only">Status</label>
            <select id="admStatus" name="status" class="search-select">
              <option value="">Semua Status</option>
              <option value="Aktif" <?= $statusSel==='Aktif'?'selected':'' ?>>Aktif</option>
              <option value="Belum Aktif" <?= $statusSel==='Belum Aktif'?'selected':'' ?>>Belum Aktif</option>
              <option value="Selesai" <?= $statusSel==='Selesai'?'selected':'' ?>>Selesai</option>
            </select>
          </div>
          <div class="search-select-wrap">
            <?php
              $bidangSel = isset($_GET['bidang']) ? (int)$_GET['bidang'] : 0;
              $optBidang = mysqli_query($koneksi, "SELECT id_bidang, nama_bidang FROM sub_bidang ORDER BY nama_bidang ASC");
            ?>
            <label for="admBidang" class="sr-only">Sub Bidang</label>
            <select id="admBidang" name="bidang" class="search-select">
              <option value="">Semua Sub Bidang</option>
              <?php if ($optBidang && mysqli_num_rows($optBidang) > 0): ?>
                <?php while ($ob = mysqli_fetch_assoc($optBidang)): ?>
                  <option value="<?= (int)$ob['id_bidang'] ?>" <?= $bidangSel == (int)$ob['id_bidang'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ob['nama_bidang']) ?>
                  </option>
                <?php endwhile; ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="search-actions">
            <button type="submit" class="btn btn-primary-modern"><i class="fas fa-search"></i><span class="d-none d-sm-inline"> Cari</span></button>
            <a href="?halaman=mahasiswa" class="btn btn-light border"><i class="fas fa-undo"></i><span class="d-none d-sm-inline"> Reset</span></a>
          </div>
        </div>
      </form>
    </div>

    <?php
    // Pagination setup
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
    $status_filter = isset($_GET['status']) ? mysqli_real_escape_string($koneksi, $_GET['status']) : '';
    $bidang_filter = isset($_GET['bidang']) ? (int)$_GET['bidang'] : 0;
    $conditions = [];
    if ($search) {
      $conditions[] = "(pm.nama_mahasiswa LIKE '%$search%' OR pm.asal_instansi LIKE '%$search%' OR sb.nama_bidang LIKE '%$search%' OR bs.nomor_surat LIKE '%$search%')";
    }
    if (in_array($status_filter, ['Aktif', 'Belum Aktif', 'Selesai'])) {
      $conditions[] = "pm.status = '$status_filter'";
    }
    if ($bidang_filter > 0) {
      $conditions[] = "pm.id_bidang = $bidang_filter";
    }
    $where_integrated = $conditions ? ('WHERE ' . implode(' AND ', $conditions)) : '';

    // Hitung total data
    $result_total = mysqli_query($koneksi, "
      SELECT COUNT(*) AS total 
      FROM peserta_magang pm
      JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
      LEFT JOIN balasan_surat bs ON pm.nama_mahasiswa = bs.nama_pengirim AND pm.asal_instansi = bs.asal_instansi
      $where_integrated
    ");
    $row_total = mysqli_fetch_assoc($result_total);
    $total_data = $row_total['total'];
    $total_page = ceil($total_data / $limit);
    ?>

    <!-- Modern Data Table (matching permintaan surat style) -->
    <div class="card-modern">
      <div class="card-header">
        <i class="fas fa-users"></i> Data Mahasiswa Magang
  <span class="badge-modern badge-accent float-right">Total: <?= $total_data ?> data</span>
      </div>
      <div class="card-body">

        <!-- Desktop Table View with Horizontal Scroll -->
        <div class="table-responsive d-none d-md-block" style="overflow-x: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px;">
          <table class="table table-striped table-hover mb-0" style="min-width: 1200px;">
            <thead class="card-header bg-pln-secondary">
              <tr style="height: 45px; font-size: 0.8rem;">
                <th style="min-width: 50px; position: relative; left: 0; background-color: var(--pln-secondary); color: #fff; z-index: 10; padding: 8px 6px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-hashtag" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">NO</small>
                </th>
                <th style="min-width: 130px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-file-alt" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">NOMOR SURAT</small>
                </th>
                <th style="min-width: 160px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-user-graduate" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">NAMA MAHASISWA</small>
                </th>
                <th style="min-width: 180px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-university" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">ASAL INSTANSI</small>
                </th>
                <th style="min-width: 140px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-sitemap" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">SUB BIDANG</small>
                </th>
                <th style="min-width: 100px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-calendar-plus" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">TGL MASUK</small>
                </th>
                <th style="min-width: 100px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-calendar-minus" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">TGL KELUAR</small>
                </th>
                <th style="min-width: 80px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-info-circle" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">STATUS</small>
                </th>
                <th style="min-width: 90px; padding: 8px 10px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-certificate" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">FILES</small>
                </th>
                <th style="min-width: 90px; position: relative; right: 0; background-color: var(--pln-secondary); color: #fff; z-index: 10; padding: 8px 6px; vertical-align: middle; text-align: center;">
                  <i class="fas fa-cogs" style="font-size: 0.7rem;"></i><br><small style="font-size: 0.65rem;">AKSI</small>
                </th>
              </tr>
            </thead>
            <tbody>

      <?php
      // Ambil data sesuai halaman dengan integrasi semua tabel
      $result = mysqli_query($koneksi, "
        SELECT pm.*, sb.nama_bidang, bs.nomor_surat, bs.file_pdf as balasan_file,
               ds.file_sertifikat, ds.id_sertifikat
        FROM peserta_magang pm
        JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
        LEFT JOIN balasan_surat bs ON pm.nama_mahasiswa = bs.nama_pengirim AND pm.asal_instansi = bs.asal_instansi
        LEFT JOIN data_sertifikat ds ON pm.nama_mahasiswa = ds.nama_lengkap AND pm.asal_instansi = ds.asal_instansi
        $where_integrated
        ORDER BY pm.id_mahasiswa DESC
        LIMIT $start, $limit
      ");

      $no = $start + 1;
      if (mysqli_num_rows($result) > 0):
        while ($data = mysqli_fetch_array($result)) :
      ?>
            <tr>
              <td style="position: sticky; left: 0; background: white; z-index: 5; border-right: 1px solid #dee2e6;">
                <span class="badge badge-info"><?= $no++ ?></span>
              </td>
              <td style="padding: 12px; white-space: nowrap;" title="<?= !empty($data['nomor_surat']) ? htmlspecialchars($data['nomor_surat']) : 'Belum ada' ?>">
                <?php if (!empty($data['nomor_surat'])): ?>
                  <strong><?= htmlspecialchars($data['nomor_surat']) ?></strong>
                <?php else: ?>
                  <span class="text-muted"><i>Belum ada</i></span>
                <?php endif; ?>
              </td>
              <td style="padding: 12px;" title="<?= htmlspecialchars($data['nama_mahasiswa']) ?>">
                <strong><?= htmlspecialchars($data['nama_mahasiswa']) ?></strong>
              </td>
              <td style="padding: 12px;" title="<?= htmlspecialchars($data['asal_instansi']) ?>">
                <?= htmlspecialchars($data['asal_instansi']) ?>
              </td>
              <td style="padding: 12px;">
                <span class="badge badge-info" style="white-space: normal; word-wrap: break-word; max-width: 140px; display: inline-block;" title="<?= htmlspecialchars($data['nama_bidang']) ?>">
                  <?= htmlspecialchars($data['nama_bidang']) ?>
                </span>
              </td>
              <td style="padding: 12px; white-space: nowrap;"><?= date('d/m/Y', strtotime($data['tgl_masuk'])) ?></td>
              <td style="padding: 12px; white-space: nowrap;"><?= date('d/m/Y', strtotime($data['tgl_keluar'])) ?></td>
              <td style="padding: 12px;">
                <?php if ($data['status'] == 'Aktif'): ?>
                  <span class="badge badge-success">Aktif</span>
                <?php elseif ($data['status'] == 'Selesai'): ?>
                  <span class="badge badge-secondary">Selesai</span>
                <?php elseif ($data['status'] == 'Belum Aktif'): ?>
                  <span class="badge badge-warning">Belum Aktif</span>
                <?php endif; ?>
              </td>
              <td style="padding: 12px;">
                <div class="d-flex gap-1">
                  <?php if (!empty($data['file_sertifikat'])): ?>
                    <a href="../file_sertifikat/<?= urlencode($data['file_sertifikat']) ?>" target="_blank" class="btn btn-pln btn-sm" title="Lihat Sertifikat">
                      <i class="fas fa-certificate"></i>
                    </a>
                  <?php endif; ?>
                  
                  <?php if (!empty($data['balasan_file'])): ?>
                    <a href="../file_balasan/<?= urlencode($data['balasan_file']) ?>" target="_blank" class="btn btn-success btn-sm" title="Lihat Balasan Surat">
                      <i class="fas fa-file-pdf"></i>
                    </a>
                  <?php endif; ?>
                  
                  <?php if (empty($data['file_sertifikat']) && empty($data['balasan_file'])): ?>
                    <span class="text-muted small">-</span>
                  <?php endif; ?>
                </div>
              </td>
              <td style="position: sticky; right: 0; background: white; z-index: 5; border-left: 1px solid #dee2e6; padding: 12px;">
                <div class="d-flex gap-1 justify-content-center">
                  <a href="?halaman=mahasiswa&hal=edit&id=<?= $data['id_mahasiswa'] ?>" class="btn btn-success btn-sm" title="Edit Data">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="?halaman=mahasiswa&hal=hapus&id=<?= $data['id_mahasiswa'] ?>" class="btn btn-danger btn-sm btn-delete" data-name="<?= htmlspecialchars($data['nama_mahasiswa']) ?>" title="Hapus Data">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
      <?php 
        endwhile;
      else: 
      ?>
            <tr>
              <td colspan="8" class="text-center py-4">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted mb-0">Tidak ada data yang ditemukan</p>
                <?php if ((isset($_GET['search']) && $_GET['search'] !== '') || (isset($_GET['status']) && $_GET['status'] !== '') || (isset($_GET['bidang']) && $_GET['bidang'] !== '')): ?>
                  <a href="?halaman=mahasiswa" class="btn btn-primary-modern btn-sm mt-2">
                    <i class="fas fa-refresh"></i> Tampilkan Semua Data
                  </a>
                <?php endif; ?>
              </td>
            </tr>
      <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Mobile Card View -->
        <div class="d-md-none">
          <?php
          // Reset query untuk mobile view
          $result_mobile = mysqli_query($koneksi, "
            SELECT pm.*, sb.nama_bidang, bs.nomor_surat, bs.file_pdf as balasan_file,
                   ds.file_sertifikat, ds.id_sertifikat
            FROM peserta_magang pm
            JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
            LEFT JOIN balasan_surat bs ON pm.nama_mahasiswa = bs.nama_pengirim AND pm.asal_instansi = bs.asal_instansi
            LEFT JOIN data_sertifikat ds ON pm.nama_mahasiswa = ds.nama_lengkap AND pm.asal_instansi = ds.asal_instansi
            $where_integrated
            ORDER BY pm.id_mahasiswa DESC
            LIMIT $start, $limit
          ");

          $no_mobile = $start + 1;
          if (mysqli_num_rows($result_mobile) > 0):
            while ($data_mobile = mysqli_fetch_array($result_mobile)) :
          ?>
          <div class="card mb-3 mobile-card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <span class="badge badge-primary">#<?= $no_mobile++ ?></span>
                <strong><?= htmlspecialchars($data_mobile['nama_mahasiswa']) ?></strong>
              </div>
              <div class="d-flex gap-1">
                <a href="?halaman=mahasiswa&hal=edit&id=<?= $data_mobile['id_mahasiswa'] ?>" class="btn btn-success btn-sm" title="Edit Data">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="?halaman=mahasiswa&hal=hapus&id=<?= $data_mobile['id_mahasiswa'] ?>" class="btn btn-danger btn-sm btn-delete" data-name="<?= htmlspecialchars($data_mobile['nama_mahasiswa']) ?>" title="Hapus Data">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <small class="text-muted">Asal Instansi:</small><br>
                  <strong><?= htmlspecialchars($data_mobile['asal_instansi']) ?></strong>
                </div>
                <div class="col-6">
                  <small class="text-muted">Sub Bidang:</small><br>
                  <span class="badge badge-info badge-pill"><?= htmlspecialchars($data_mobile['nama_bidang']) ?></span>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-6">
                  <small class="text-muted">Tanggal Masuk:</small><br>
                  <i class="fas fa-calendar-plus text-success"></i> <?= date('d/m/Y', strtotime($data_mobile['tgl_masuk'])) ?>
                </div>
                <div class="col-6">
                  <small class="text-muted">Tanggal Keluar:</small><br>
                  <i class="fas fa-calendar-minus text-danger"></i> <?= date('d/m/Y', strtotime($data_mobile['tgl_keluar'])) ?>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-6">
                  <small class="text-muted">Status:</small><br>
                  <?php if ($data_mobile['status'] == 'Aktif'): ?>
                    <span class="badge badge-success">Aktif</span>
                  <?php elseif ($data_mobile['status'] == 'Selesai'): ?>
                    <span class="badge badge-secondary">Selesai</span>
                  <?php elseif ($data_mobile['status'] == 'Belum Aktif'): ?>
                    <span class="badge badge-warning">Belum Aktif</span>
                  <?php endif; ?>
                </div>
                <div class="col-6">
                  <small class="text-muted">Nomor Surat:</small><br>
                  <?php if (!empty($data_mobile['nomor_surat'])): ?>
                    <strong><?= htmlspecialchars($data_mobile['nomor_surat']) ?></strong>
                  <?php else: ?>
                    <span class="text-muted"><i>Belum ada</i></span>
                  <?php endif; ?>
                </div>
              </div>
              
              <?php if (!empty($data_mobile['file_sertifikat']) || !empty($data_mobile['balasan_file'])): ?>
              <div class="mt-3">
                <small class="text-muted">Files:</small><br>
                <?php if (!empty($data_mobile['file_sertifikat'])): ?>
                  <a href="../file_sertifikat/<?= urlencode($data_mobile['file_sertifikat']) ?>" target="_blank" class="btn btn-pln btn-sm mr-1">
                    <i class="fas fa-certificate"></i> Sertifikat
                  </a>
                <?php endif; ?>
                <?php if (!empty($data_mobile['balasan_file'])): ?>
                  <a href="../file_balasan/<?= urlencode($data_mobile['balasan_file']) ?>" target="_blank" class="btn btn-success btn-sm">
                    <i class="fas fa-file-pdf"></i> Balasan
                  </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php 
            endwhile;
          else: 
          ?>
          <div class="text-center py-5">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <p class="text-muted mb-0">Tidak ada data yang ditemukan</p>
            <?php if ((isset($_GET['search']) && $_GET['search'] !== '') || (isset($_GET['status']) && $_GET['status'] !== '') || (isset($_GET['bidang']) && $_GET['bidang'] !== '')): ?>
              <a href="?halaman=mahasiswa" class="btn btn-primary btn-sm mt-2">
                <i class="fas fa-refresh"></i> Tampilkan Semua Data
              </a>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Simple Pagination: Prev, 1, 2, (current if middle), …, last, Next -->
    <?php if ($total_page > 1): ?>
    <div class="text-center mt-4">
      <nav>
        <ul class="pagination pagination-modern">
          <?php 
            $queryExtra = (isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '')
                        . ((isset($_GET['status']) && $_GET['status'] !== '') ? '&status=' . urlencode($_GET['status']) : '')
                        . ((isset($_GET['bidang']) && $_GET['bidang'] !== '') ? '&bidang=' . urlencode($_GET['bidang']) : '');
          ?>
          <!-- Prev -->
          <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" aria-label="Sebelumnya" href="<?= $page <= 1 ? '#' : ('?halaman=mahasiswa&page=' . ($page - 1) . $queryExtra) ?>">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>

          <!-- Page 1 -->
          <li class="page-item <?= 1 == $page ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=mahasiswa&page=1<?= $queryExtra ?>">1</a>
          </li>

          <?php if ($total_page >= 2 && $page <= 4): ?>
          <!-- Page 2 (only show when near the beginning) -->
          <li class="page-item <?= 2 == $page ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=mahasiswa&page=2<?= $queryExtra ?>">2</a>
          </li>
          <?php endif; ?>

          <?php if ($total_page == 3): ?>
            <!-- Only three pages total: show page 3 -->
            <li class="page-item <?= 3 == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=mahasiswa&page=3<?= $queryExtra ?>">3</a>
            </li>
          <?php elseif ($total_page > 3): ?>
            <?php
              // If current page is in the middle (>=3 and < last), show it
              if ($page >= 3 && $page < $total_page) {
                // Ellipsis before current when there's a gap > 1 from page 2
                if ($page > 3) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                }
                // Current page
                echo '<li class="page-item active"><a class="page-link" href="?halaman=mahasiswa&page=' . $page . $queryExtra . '">' . $page . '</a></li>';
                // Ellipsis after current if not adjacent to last
                if ($page < ($total_page - 1)) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                }
              } else {
                // Current is 1,2, or last. If current is at start, keep single ellipsis; if at last, show ellipsis only when pages > 4
                if ($page <= 2 && $total_page > 3) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                } elseif ($page == $total_page && $total_page > 4) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                }
              }
            ?>
            <!-- Last page number -->
            <li class="page-item <?= $total_page == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=mahasiswa&page=<?= $total_page ?><?= $queryExtra ?>"><?= $total_page ?></a>
            </li>
          <?php endif; ?>

          <!-- Next -->
          <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
            <a class="page-link" aria-label="Berikutnya" href="<?= $page >= $total_page ? '#' : ('?halaman=mahasiswa&page=' . ($page + 1) . $queryExtra) ?>">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>

      <small class="text-muted">
        Menampilkan <?= $start + 1 ?> - <?= min($start + $limit, $total_data) ?> dari <?= $total_data ?> data
      </small>
    </div>
    <?php endif; ?>

  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeleteLabel"><i class="fas fa-trash-alt"></i> Konfirmasi Hapus</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus data mahasiswa <strong id="deleteName"></strong>?</p>
        <p class="mb-0 text-danger small">Semua data terkait (surat dan sertifikat) juga akan terhapus!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <a href="#" class="btn btn-danger" id="confirmDeleteYes">Ya, Hapus</a>
      </div>
    </div>
  </div>
 </div>

<script>
  (function(){
    // Delete confirmation modal logic
    var pendingHref = null;
    function openConfirmModal(anchor){
      var name = anchor.getAttribute('data-name') || '';
      var href = anchor.getAttribute('href');
      pendingHref = href;
      var nameEl = document.getElementById('deleteName');
      if (nameEl) nameEl.textContent = name;
      if (window.jQuery && jQuery('#confirmDeleteModal').modal) {
        jQuery('#confirmDeleteModal').modal('show');
      } else {
        // Fallback to native confirm
        if (window.confirm('Yakin ingin menghapus data mahasiswa ' + name + '?\nSemua data terkait (surat dan sertifikat) juga akan terhapus!')) {
          window.location.href = href;
        }
      }
    }

    function wireDeleteButtons(){
      var btns = document.querySelectorAll('.btn-delete');
      for (var i=0;i<btns.length;i++){
        (function(btn){
          btn.addEventListener('click', function(ev){
            ev.preventDefault();
            openConfirmModal(btn);
          });
        })(btns[i]);
      }
    }

    function wireModalYes(){
      var yes = document.getElementById('confirmDeleteYes');
      if (!yes) return;
      yes.addEventListener('click', function(ev){
        ev.preventDefault();
        if (pendingHref) window.location.href = pendingHref;
      });
    }

    if (document.readyState === 'loading'){
      document.addEventListener('DOMContentLoaded', function(){
        wireDeleteButtons();
        wireModalYes();
      });
    } else {
      wireDeleteButtons();
      wireModalYes();
    }
  })();
 </script>

<!-- Enhanced CSS for Desktop Scroll Table and Mobile View -->
<style>
/* Search toolbar */
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
.search-toolbar{background:#fff;border:1px solid #e6eef2;border-radius:12px;padding:12px;box-shadow:0 6px 20px rgba(1,154,165,0.06)}
.search-row{display:flex;gap:10px;flex-wrap:wrap;align-items:stretch}
.search-input-wrap{position:relative;flex:1 1 380px}
.search-input-wrap i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6b7a86}
.search-input{width:100%;height:42px;padding:10px 12px 10px 36px;border:1px solid #e6eef2;border-radius:10px;background:#f9fbfc;transition:all .2s ease}
.search-input:focus{outline:none;border-color:var(--pln-secondary);background:#fff;box-shadow:0 0 0 4px rgba(1,154,165,.12)}
.search-select-wrap{flex:0 0 200px}
.search-select{width:100%;height:42px;padding:10px 12px;border:1px solid #e6eef2;border-radius:10px;background:#fff}
.search-select:focus{outline:none;border-color:var(--pln-secondary);box-shadow:0 0 0 4px rgba(1,154,165,.12)}
.search-actions{display:flex;gap:8px;align-items:center}
@media (max-width:768px){
  .search-select-wrap{flex:1 1 200px}
  .search-actions{flex:1 1 180px;justify-content:flex-end}
}

/* Desktop Table Horizontal Scroll Styling */
.thead-dark{
      background: linear-gradient(135deg, 
      var(--pln-primary) 0%,
      var(--pln-secondary) 100%) !important;
}

.table-responsive {
  background: white;
  border-radius: 8px;
  overflow-x: auto;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.table-responsive::-webkit-scrollbar {
  height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: var(--pln-secondary);
  border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: var(--pln-primary);
}

/* Compact Table Header Styling */
.table thead th {
  white-space: nowrap;
  line-height: 1.1;
  border-bottom: 2px solid #dee2e6;
}

.table thead th small {
  display: block;
  margin-top: 2px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.table thead th i {
  margin-bottom: 2px;
  opacity: 0.8;
}

/* Sticky columns styling */
.table tbody tr:hover td {
  background-color: #f8f9fa;
}

.table tbody tr:hover td[style*="position: sticky"] {
  background-color: #f8f9fa !important;
}

/* Gap utility for older Bootstrap versions */
.d-flex.gap-1 > * + * {
  margin-left: 0.25rem;
}

/* Mobile Card Styling */
.mobile-card {
  border: 1px solid #e3e6f0;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  margin-bottom: 15px;
  overflow: hidden;
}

.mobile-card .card-header {
  background: linear-gradient(135deg, var(--pln-primary), var(--pln-secondary));
  color: white;
  border-radius: 0;
  border: none;
  padding: 12px 15px;
  font-size: 0.9rem;
}

.mobile-card .card-header .btn {
  color: white;
  border-color: rgba(255,255,255,0.3);
  background: rgba(255,255,255,0.1);
  min-width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: 4px;
}

.mobile-card .card-header .btn:hover {
  background: rgba(255,255,255,0.2);
  border-color: rgba(255,255,255,0.5);
  color: white;
}

.mobile-card .card-header .btn-success {
  background: rgba(40, 167, 69, 0.8);
  border-color: rgba(40, 167, 69, 0.8);
}

.mobile-card .card-header .btn-success:hover {
  background: rgba(40, 167, 69, 1);
  border-color: rgba(40, 167, 69, 1);
}

.mobile-card .card-header .btn-danger {
  background: rgba(220, 53, 69, 0.8);
  border-color: rgba(220, 53, 69, 0.8);
}

.mobile-card .card-header .btn-danger:hover {
  background: rgba(220, 53, 69, 1);
  border-color: rgba(220, 53, 69, 1);
}

.mobile-card .card-body {
  padding: 15px;
  font-size: 0.85rem;
}

.mobile-card .badge-pill {
  padding: 4px 8px;
  font-size: 0.75rem;
  white-space: normal;
  word-wrap: break-word;
}

.mobile-card small {
  font-weight: 600;
  color: #6c757d;
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.mobile-card .btn-sm {
  padding: 4px 8px;
  font-size: 0.75rem;
  margin: 2px;
}

/* Responsive adjustments */
@media (max-width: 991px) {
  .mobile-card .card-body {
    padding: 12px;
  }

  .mobile-card .card-header {
    padding: 10px 12px;
    font-size: 0.85rem;
  }
  
  .mobile-card .card-header .btn {
    min-width: 28px;
    height: 28px;
    font-size: 0.8rem;
  }
}

@media (max-width: 576px) {
  .mobile-card .card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
  
  .mobile-card .card-header > div:last-child {
    align-self: flex-end;
  }
}
</style>
