<?php
include "../../config/koneksi.php"; // pastikan path-nya sesuai

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_mahasiswa.xls");

echo "<table border='1'>
<tr>
  <th>No</th>
  <th>Nama Mahasiswa</th>
  <th>Asal Instansi</th>
  <th>Bidang</th>
  <th>Tgl Masuk</th>
  <th>Tgl Keluar</th>
  <th>Status</th>
</tr>";

$no = 1;
$query = mysqli_query($koneksi, "
  SELECT pm.*, sb.nama_bidang 
  FROM peserta_magang pm
  JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
");

while ($data = mysqli_fetch_assoc($query)) {
  echo "<tr>
    <td>$no</td>
    <td>".htmlspecialchars($data['nama_mahasiswa'])."</td>
    <td>".htmlspecialchars($data['asal_instansi'])."</td>
    <td>".htmlspecialchars($data['nama_bidang'])."</td>
    <td>".$data['tgl_masuk']."</td>
    <td>".$data['tgl_keluar']."</td>
    <td>".$data['status']."</td>
  </tr>";
  $no++;
}

echo "</table>";
?>
