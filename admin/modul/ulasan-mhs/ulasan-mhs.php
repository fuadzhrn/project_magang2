<?php
include "../admin/config/koneksi.php"; // pastikan koneksi disertakan

// Jika tombol hapus ditekan
if (isset($_GET['hal']) && $_GET['hal'] == 'hapus' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $hapus = mysqli_query($koneksi, "DELETE FROM testimoni WHERE id = $id");

    if ($hapus) {
        echo "<script>
                alert('✅ Ulasan berhasil dihapus');
                window.location.href = '?halaman=ulasan-mhs';
              </script>";
    } else {
        echo "<script>
                alert('❌ Gagal menghapus ulasan');
              </script>";
    }
}
?>



<div class="card mt-3">
  <div class="card-header bg-pln-secondary text-white">Data Ulasan Mahasiswa</div>
  <div class="card-body">
    <?php
            include "../admin/config/koneksi.php"; // koneksi

            // Atur jumlah data per halaman
            $limit = 5;

            // Cek halaman aktif (default halaman 1)
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $limit;

            // Ambil total data
            $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM testimoni");
            $total_row = mysqli_fetch_assoc($total_result);
            $total_data = $total_row['total'];

            // Hitung total halaman
            $total_page = ceil($total_data / $limit);

            // Ambil data untuk halaman ini
            $query = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY id DESC LIMIT $start, $limit");
?>
    <div class="mb-3">
  <a href="modul/ulasan-mhs/export-pdf.php" class="btn btn-danger btn-sm">Export PDF</a>
  <a href="modul/ulasan-mhs/export-excel.php" class="btn btn-success btn-sm" target="_blank">Export Excel</a>
    </div>

    <div class="table-responsive" style="background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
      <table class="table table-striped table-hover mb-0 align-middle">
        <thead class="thead-modern">
          <tr>
            <th style="min-width:60px; text-align:center;">No</th>
            <th style="min-width:180px;">Nama Mahasiswa</th>
            <th style="min-width:180px;">Instansi</th>
            <th style="min-width:110px; text-align:center;">Rating</th>
            <th style="min-width:300px;">Ulasan</th>
            <th style="min-width:110px; text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $no = $start + 1;
            while ($data = mysqli_fetch_array($query)) :
            ?>
            <tr>
              <td class="cell-center"><span class="badge badge-info"><?= $no++ ?></span></td>
              <td><strong><?= htmlspecialchars($data['nama']) ?></strong></td>
              <td><?= htmlspecialchars($data['instansi']) ?></td>
              <td class="cell-center" title="<?= (int)$data['rating'] ?>/5">
                <?php $r = max(0, min(5, (int)$data['rating'])); ?>
                <span class="rating-stars"><?= str_repeat('★', $r) . str_repeat('☆', 5 - $r) ?></span>
              </td>
              <td class="cell-ulasan"><?= nl2br(htmlspecialchars($data['ulasan'])) ?></td>
              <td class="cell-center">
                <a href="?halaman=ulasan-mhs&hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </td>
            </tr>
            <?php endwhile; ?>
            </tbody>

      </table>
    </div>

    <?php if ($total_page > 1): ?>
    <div class="text-center mt-3">
      <nav>
        <ul class="pagination pagination-modern justify-content-center">
          <!-- Prev -->
          <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" aria-label="Sebelumnya" href="<?= $page <= 1 ? '#' : ('?halaman=ulasan-mhs&page=' . ($page - 1)) ?>">&laquo;</a>
          </li>

          <!-- Page 1 -->
          <li class="page-item <?= 1 == $page ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=ulasan-mhs&page=1">1</a>
          </li>

          <?php if ($total_page >= 2 && $page <= 4): ?>
          <!-- Page 2 (near start) -->
          <li class="page-item <?= 2 == $page ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=ulasan-mhs&page=2">2</a>
          </li>
          <?php endif; ?>

          <?php if ($total_page == 3): ?>
            <!-- Only three pages total: show 3 -->
            <li class="page-item <?= 3 == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=ulasan-mhs&page=3">3</a>
            </li>
          <?php elseif ($total_page > 3): ?>
            <?php
              if ($page >= 3 && $page < $total_page) {
                if ($page > 3) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>'; 
                }
                echo '<li class="page-item active"><a class="page-link" href="?halaman=ulasan-mhs&page=' . $page . '">' . $page . '</a></li>';
                if ($page < ($total_page - 1)) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                }
              } else {
                if ($page <= 2 && $total_page > 3) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                } elseif ($page == $total_page && $total_page > 4) {
                  echo '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
                }
              }
            ?>
            <!-- Last page -->
            <li class="page-item <?= $total_page == $page ? 'active' : '' ?>">
              <a class="page-link" href="?halaman=ulasan-mhs&page=<?= $total_page ?>"><?= $total_page ?></a>
            </li>
          <?php endif; ?>

          <!-- Next -->
          <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
            <a class="page-link" aria-label="Berikutnya" href="<?= $page >= $total_page ? '#' : ('?halaman=ulasan-mhs&page=' . ($page + 1)) ?>">&raquo;</a>
          </li>
        </ul>
      </nav>
      <small class="text-muted">Menampilkan <?= $start + 1 ?> - <?= min($start + $limit, $total_data) ?> dari <?= $total_data ?> data</small>
    </div>
    <?php endif; ?>

  </div>
</div>

  <style>
  /* Table header styling */
  .thead-modern th{
    background: var(--pln-secondary);
    color: #fff;
    border-color: var(--pln-secondary);
    font-size: .85rem;
    text-transform: uppercase;
    letter-spacing: .3px;
  }

  /* Cells */
  .cell-center{ text-align:center; vertical-align: middle; }
  .cell-ulasan{ white-space: pre-wrap; word-wrap: break-word; max-width: 520px; }
  .rating-stars{ color: #f1c40f; font-size: .95rem; letter-spacing: 1px; }

  /* Pagination */
  .pagination-modern .page-link{ color:var(--pln-secondary); border-color:#dfe7ea; }
  .pagination-modern .page-item.active .page-link{ background:var(--pln-secondary); border-color:var(--pln-secondary); color:#fff; }
  .pagination-modern .page-item.disabled .page-link{ color:#6c757d; }
  </style>