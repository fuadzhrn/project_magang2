<?php
// koneksi
include "../admin/config/koneksi.php";

// aksi hapus data
if (isset($_GET['hal']) && $_GET['hal'] == "hapus") {
    $hapus = mysqli_query($koneksi, "DELETE FROM peserta_magang WHERE id_mahasiswa='" . mysqli_real_escape_string($koneksi, $_GET['id']) . "'");
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses');
                document.location='?halaman=mahasiswa';
              </script>";
    }
}

// tampilkan data yang akan diedit
if (isset($_GET['hal']) && $_GET['hal'] == "edit") {
    $id_mahasiswa = mysqli_real_escape_string($koneksi, $_GET['id']);
    $tampil = mysqli_query($koneksi, "
        SELECT * FROM peserta_magang 
        WHERE id_mahasiswa = '$id_mahasiswa'
    ");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
        $vnama = htmlspecialchars($data['nama_mahasiswa']);
        $vasal = htmlspecialchars($data['asal_instansi']);
        $vid_bidang = $data['id_bidang'];
        $vtgl_masuk = $data['tgl_masuk'];
        $vtgl_keluar = $data['tgl_keluar'];
        $vstatus = $data['status'];
    }
}

// tombol simpan
if (isset($_POST['bsimpan'])) {
   $today = date('Y-m-d');

    if ($_POST['tgl_masuk'] > $today) {
        $status_auto = 'Belum Aktif';
    } elseif ($_POST['tgl_keluar'] <= $today) {
        $status_auto = 'Selesai';
    } else {
        $status_auto = 'Aktif';
    }

    $nama_mahasiswa = mysqli_real_escape_string($koneksi, $_POST['nama_mahasiswa']);
    $asal_instansi = mysqli_real_escape_string($koneksi, $_POST['asal_instansi']);
    $id_bidang = mysqli_real_escape_string($koneksi, $_POST['id_bidang']);
    $tgl_masuk = mysqli_real_escape_string($koneksi, $_POST['tgl_masuk']);
    $tgl_keluar = mysqli_real_escape_string($koneksi, $_POST['tgl_keluar']);

    if (@$_GET['hal'] == "edit") {
        // update data
        $ubah = mysqli_query($koneksi, "UPDATE peserta_magang SET
            nama_mahasiswa = '$nama_mahasiswa',
            asal_instansi = '$asal_instansi',
            id_bidang = '$id_bidang',
            tgl_masuk = '$tgl_masuk',
            tgl_keluar = '$tgl_keluar',
            status = '$status_auto'
            WHERE id_mahasiswa = '$_GET[id]'
        ");

        if ($ubah) {
            echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=mahasiswa';
                  </script>";
        } else {
            echo "<script>
                    alert('Ubah Data GAGAL!');
                    document.location='?halaman=mahasiswa';
                  </script>";
        }
    } else {
        // cek kuota
        $cek_kouta = mysqli_query($koneksi, "SELECT kouta FROM sub_bidang WHERE id_bidang = '$id_bidang'");
        $kouta = mysqli_fetch_array($cek_kouta)['kouta'];

        if ($kouta > 0) {
            // simpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO peserta_magang VALUES (
                '', 
                '$nama_mahasiswa', 
                '$asal_instansi', 
                '$id_bidang', 
                '$tgl_masuk', 
                '$tgl_keluar', 
                '$status_auto'
            )");

            if ($simpan) {
                echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=mahasiswa';
                </script>";
            } else {
                echo "<script>
                    alert('Simpan Data GAGAL!');
                    document.location='?halaman=mahasiswa';
                </script>";
            }
        } else {
            echo "<script>
                alert('Kuota penuh untuk bidang ini!');
                document.location='?halaman=mahasiswa';
            </script>";
        }
    }
}
?>


<!-- Formulir untuk Menambah atau Mengedit Data Mahasiswa -->
<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Mahasiswa
  </div>
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="nama_mahasiswa">Nama Mahasiswa</label>
        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= htmlspecialchars(@$vnama) ?>" required>
      </div>

      <div class="form-group">
        <label for="asal_instansi">Asal Instansi</label>
        <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="<?= htmlspecialchars(@$vasal) ?>" required>
      </div>

      <div class="form-group">
        <label for="id_bidang">Bidang</label>
        <select class="form-control" id="id_bidang" name="id_bidang" required>
          <option value="">-- Pilih Bidang --</option>
          <?php
          $bidang = mysqli_query($koneksi, "SELECT * FROM sub_bidang");
          while ($row = mysqli_fetch_array($bidang)) {
              $selected = (@$vid_bidang == $row['id_bidang']) ? 'selected' : '';
              echo "<option value='{$row['id_bidang']}' $selected>{$row['nama_bidang']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="tgl_masuk">Tanggal Masuk</label>
        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= @$vtgl_masuk ?>" required>
      </div>

      <div class="form-group">
        <label for="tgl_keluar">Tanggal Keluar</label>
        <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" value="<?= @$vtgl_keluar ?>" required>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
          <option value="Aktif" <?= (@$vstatus == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
          <option value="Belum Aktif" <?= (@$vstatus == 'Belum Aktif') ? 'selected' : '' ?>>Belum Aktif</option>
          <option value="Selesai" <?= (@$vstatus == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
        </select>
      </div>

      <button type="submit" name="bsimpan" class="btn btn-primary">Submit</button>
      <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>
