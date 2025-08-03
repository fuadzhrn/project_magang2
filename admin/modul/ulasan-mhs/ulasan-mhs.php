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
  <div class="card-header bg-info text-white">Data Ulasan Mahasiswa</div>
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
    <a href="export-pdf.php" class="btn btn-danger btn-sm">Export PDF</a>
    <a href="/PLN/admin/modul/ulasan-mhs/export-excel.php" class="btn btn-success btn-sm" target="_blank">Export Excel</a>
    </div>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mahasiswa</th>
          <th>Instansi</th>
          <th>Rating</th>
          <th>Ulasan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
            <?php
            $no = $start + 1;
            while ($data = mysqli_fetch_array($query)) :
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
                <td><?= htmlspecialchars($data['instansi']) ?></td>
                <td><?= htmlspecialchars($data['rating']) ?></td>
                <td><?= htmlspecialchars($data['ulasan']) ?></td>
                <td>
                <a href="?halaman=ulasan-mhs&hal=hapus&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
          <a class="page-link" href="?halaman=ulasan-mhs&page=<?= $page - 1 ?>">← Sebelumnya</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_page; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
          <a class="page-link" href="?halaman=ulasan-mhs&page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($page < $total_page): ?>
        <li class="page-item">
          <a class="page-link" href="?halaman=ulasan-mhs&page=<?= $page + 1 ?>">Berikutnya →</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

  </div>
</div>