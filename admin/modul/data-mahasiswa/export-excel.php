<?php
include "../../config/koneksi.php"; // pastikan path-nya sesuai

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_mahasiswa.xls");

// Filter opsional agar konsisten dengan listing
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$status_filter = isset($_GET['status']) ? mysqli_real_escape_string($koneksi, $_GET['status']) : '';
$bidang_filter = isset($_GET['bidang']) ? (int)$_GET['bidang'] : 0;
$conditions = [];
if ($search !== '') {
  $conditions[] = "(pm.nama_mahasiswa LIKE '%$search%' OR pm.asal_instansi LIKE '%$search%' OR sb.nama_bidang LIKE '%$search%' OR bs.nomor_surat LIKE '%$search%')";
}
if (in_array($status_filter, ['Aktif','Belum Aktif','Selesai'])) {
  $conditions[] = "pm.status = '$status_filter'";
}
if ($bidang_filter > 0) {
  $conditions[] = "pm.id_bidang = $bidang_filter";
}
$where = $conditions ? ('WHERE ' . implode(' AND ', $conditions)) : '';

echo "<table border='1'>
<tr>
  <th>No</th>
  <th>Nomor Surat</th>
  <th>Nama Mahasiswa</th>
  <th>Asal Instansi</th>
  <th>Sub Bidang</th>
  <th>Tgl Masuk</th>
  <th>Tgl Keluar</th>
  <th>Status</th>
  <th>Files</th>
</tr>";

$no = 1;
$query = mysqli_query($koneksi, "
  SELECT pm.*, sb.nama_bidang, bs.nomor_surat, bs.file_pdf AS balasan_file, ds.file_sertifikat
  FROM peserta_magang pm
  JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
  LEFT JOIN balasan_surat bs ON pm.nama_mahasiswa = bs.nama_pengirim AND pm.asal_instansi = bs.asal_instansi
  LEFT JOIN data_sertifikat ds ON pm.nama_mahasiswa = ds.nama_lengkap AND pm.asal_instansi = ds.asal_instansi
  $where
  ORDER BY pm.id_mahasiswa DESC
");

while ($data = mysqli_fetch_assoc($query)) {
  $tglMasuk = '';
  if (!empty($data['tgl_masuk'])) { $ts = strtotime($data['tgl_masuk']); $tglMasuk = $ts ? date('d/m/Y', $ts) : $data['tgl_masuk']; }
  $tglKeluar = '';
  if (!empty($data['tgl_keluar'])) { $ts2 = strtotime($data['tgl_keluar']); $tglKeluar = $ts2 ? date('d/m/Y', $ts2) : $data['tgl_keluar']; }
  $files = [];
  if (!empty($data['file_sertifikat'])) $files[] = 'Sertifikat';
  if (!empty($data['balasan_file'])) $files[] = 'Balasan';
  $filesTxt = $files ? implode(', ', $files) : '-';

  echo "<tr>
    <td>$no</td>
    <td>" . ($data['nomor_surat'] ? htmlspecialchars($data['nomor_surat']) : '-') . "</td>
    <td>" . htmlspecialchars($data['nama_mahasiswa']) . "</td>
    <td>" . htmlspecialchars($data['asal_instansi']) . "</td>
    <td>" . htmlspecialchars($data['nama_bidang']) . "</td>
    <td>" . htmlspecialchars($tglMasuk) . "</td>
    <td>" . htmlspecialchars($tglKeluar) . "</td>
    <td>" . htmlspecialchars($data['status']) . "</td>
    <td>" . htmlspecialchars($filesTxt) . "</td>
  </tr>";
  $no++;
}

echo "</table>";
?>
