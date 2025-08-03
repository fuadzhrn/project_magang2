<?php
include "../admin/config/koneksi.php";

// Inisialisasi variabel form
$vnama_bidang = '';
$vkouta = '';
$vdeskripsi = '';

// Jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    $nama_bidang = $_POST['nama_bidang'];
    $kouta = $_POST['kouta'];
    $deskripsi = $_POST['deskripsi'];

    if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
        // Update data
        $ubah = mysqli_query($koneksi, "UPDATE sub_bidang SET 
            nama_bidang = '$nama_bidang',
            kouta = '$kouta',
            deskripsi = '$deskripsi'
            WHERE id_bidang = '$_GET[id]'");

        if ($ubah) {
            echo "<script>alert('Ubah Data Sukses');document.location='?halaman=sub-bidang';</script>";
        }
    } else {
        // Simpan data baru
        $simpan = mysqli_query($koneksi, "INSERT INTO sub_bidang (nama_bidang, kouta, deskripsi) 
            VALUES ('$nama_bidang', '$kouta', '$deskripsi')");

        if ($simpan) {
            echo "<script>alert('Simpan Data Sukses');document.location='?halaman=sub-bidang';</script>";
        }
    }
}

// Jika edit atau hapus
// Jika edit atau hapus
if (isset($_GET['hal'])) {
    $id_bidang = $_GET['id'];

    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM sub_bidang WHERE id_bidang = '$id_bidang'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vnama_bidang = $data['nama_bidang'];
            $vkouta = $data['kouta'];
            $vdeskripsi = $data['deskripsi'];
        }

    } elseif ($_GET['hal'] == "hapus") {
        // Cek apakah bidang ini masih digunakan oleh mahasiswa
        $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peserta_magang WHERE id_bidang = '$id_bidang'");
        $hasil = mysqli_fetch_assoc($cek);

        if ($hasil['total'] > 0) {
            echo "<script>alert('Gagal hapus! Masih ada mahasiswa yang terdaftar di bidang ini.');document.location='?halaman=sub-bidang';</script>";
        } else {
            $hapus = mysqli_query($koneksi, "DELETE FROM sub_bidang WHERE id_bidang = '$id_bidang'");
            if ($hapus) {
                echo "<script>alert('Hapus Data Sukses');document.location='?halaman=sub-bidang';</script>";
            } else {
                echo "<script>alert('Gagal menghapus data.');history.back();</script>";
            }
        }
    }
}

?>

























<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Bidang
  </div>
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="nama_bidang">Sub Bidang</label>
        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="<?= @$vnama_bidang ?>" required>
      </div>
      <div class="form-group">
        <label for="kouta_bidang">Kuota</label>
        <input type="number" class="form-control" id="kouta_bidang" name="kouta" value="<?= @$vkouta ?>" required>
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= @$vdeskripsi ?></textarea>
      </div>

      <button type="submit" name="bsimpan" class="btn btn-primary">Submit</button>
      <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Data Bidang
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hovered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Bidang</th>
          <th>Kuota</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $tampil = mysqli_query($koneksi, "SELECT * FROM sub_bidang ORDER BY id_bidang DESC");
        while ($data = mysqli_fetch_array($tampil)) :
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($data['nama_bidang']) ?></td>
            <td><?= htmlspecialchars($data['kouta']) ?></td>
            <td><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></td>
            <td>
              <a href="?halaman=sub-bidang&hal=edit&id=<?= $data['id_bidang'] ?>" class="btn btn-success btn-sm">Edit</a>
              <a href="?halaman=sub-bidang&hal=hapus&id=<?= $data['id_bidang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>


