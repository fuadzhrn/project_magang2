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
  <div class="card-header bg-info text-white">
    Data Mahasiswa
  </div>
  <div class="card-body">
    <a href="?halaman=sub-bidang" class="btn btn-info mb-3">Bidang</a>
    <a href="?halaman=mahasiswa&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
    <div class="mb-3">
      <a href="modul/data-mahasiswa/export-pdf.php" class="btn btn-danger btn-sm">Export PDF</a>
      <a href="modul/data-mahasiswa/export-excel.php" class="btn btn-success btn-sm">Export Excel</a>
    </div>

    <!-- Filter & Search -->
    <form method="get" class="mb-3">
      <input type="hidden" name="halaman" value="mahasiswa">
      <div class="input-group">
        <select name="filter_by" class="form-select" style="max-width: 150px;">
          <option value="all" <?= (isset($_GET['filter_by']) && $_GET['filter_by'] == 'all') ? 'selected' : '' ?>>Semua</option>
          <option value="nama" <?= (isset($_GET['filter_by']) && $_GET['filter_by'] == 'nama') ? 'selected' : '' ?>>Nama</option>
          <option value="instansi" <?= (isset($_GET['filter_by']) && $_GET['filter_by'] == 'instansi') ? 'selected' : '' ?>>Instansi</option>
          <option value="bidang" <?= (isset($_GET['filter_by']) && $_GET['filter_by'] == 'bidang') ? 'selected' : '' ?>>Bidang</option>
        </select>
        <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button class="btn btn-primary" type="submit">Cari</button>
      </div>
    </form>

    <!-- Table -->
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>NO</th>
        <th>Nama Mahasiswa</th>
        <th>Asal Instansi</th>
        <th>Bidang</th>
        <th>Tgl Masuk</th>
        <th>Tgl Keluar</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>

      <?php
      // Pagination setup
      $limit = 5;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $start = ($page - 1) * $limit;

      $search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
      $filter_by = isset($_GET['filter_by']) ? $_GET['filter_by'] : 'all';

      // WHERE condition
      switch ($filter_by) {
        case 'nama':
          $where = "WHERE pm.nama_mahasiswa LIKE '%$search%'";
          break;
        case 'instansi':
          $where = "WHERE pm.asal_instansi LIKE '%$search%'";
          break;
        case 'bidang':
          $where = "WHERE sb.nama_bidang LIKE '%$search%'";
          break;
        default:
          $where = $search ? "WHERE pm.nama_mahasiswa LIKE '%$search%' 
                            OR pm.asal_instansi LIKE '%$search%' 
                            OR sb.nama_bidang LIKE '%$search%'" : '';
      }

      // Hitung total data
      $result_total = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM peserta_magang pm
        JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
        $where
      ");
      $row_total = mysqli_fetch_assoc($result_total);
      $total_data = $row_total['total'];
      $total_page = ceil($total_data / $limit);

      // Ambil data sesuai halaman
      $result = mysqli_query($koneksi, "
        SELECT pm.*, sb.nama_bidang 
        FROM peserta_magang pm
        JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
        $where
        ORDER BY pm.id_mahasiswa DESC
        LIMIT $start, $limit
      ");

      $no = $start + 1;
      while ($data = mysqli_fetch_array($result)) :
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($data['nama_mahasiswa']) ?></td>
          <td><?= htmlspecialchars($data['asal_instansi']) ?></td>
          <td><?= htmlspecialchars($data['nama_bidang']) ?></td>
          <td><?= htmlspecialchars($data['tgl_masuk']) ?></td>
          <td><?= htmlspecialchars($data['tgl_keluar']) ?></td>
          <td><?= htmlspecialchars($data['status']) ?></td>
          <td>
            <a href="?halaman=mahasiswa&hal=edit&id=<?= $data['id_mahasiswa'] ?>" class="btn btn-success btn-sm">Edit</a>
            <a href="?halaman=mahasiswa&hal=hapus&id=<?= $data['id_mahasiswa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>

    <!-- Pagination -->
    <div class="text-center mt-3">
      <nav>
        <ul class="pagination justify-content-center">
          <?php
          $search_param = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
          $filter_param = isset($_GET['filter_by']) ? '&filter_by=' . urlencode($_GET['filter_by']) : '';
          ?>

          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=mahasiswa&page=<?= $page - 1 . $search_param . $filter_param ?>">← Sebelumnya</a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=mahasiswa&page=<?= $i . $search_param . $filter_param ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($page < $total_page): ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=mahasiswa&page=<?= $page + 1 . $search_param . $filter_param ?>">Berikutnya →</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>

  </div>
</div>
