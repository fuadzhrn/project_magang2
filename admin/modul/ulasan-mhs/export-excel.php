<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data-ulasan.xls");

include "../../config/koneksi.php"; // Pastikan path ini benar

echo "<table border='1'>
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Instansi</th>
  <th>Rating</th>
  <th>Ulasan</th>
  <th>Tanggal</th>
</tr>";

$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY tanggal DESC, id DESC");
while ($row = mysqli_fetch_array($query)) {
  $tglRaw = $row['tanggal'] ?? '';
  $tgl = '';
  if (!empty($tglRaw)) {
    $ts = strtotime($tglRaw);
    $tgl = $ts ? date('d/m/Y H:i', $ts) : $tglRaw;
  }
  echo "<tr>
    <td>{$no}</td>
    <td>" . htmlspecialchars($row['nama']) . "</td>
    <td>" . htmlspecialchars($row['instansi']) . "</td>
    <td>" . htmlspecialchars($row['rating']) . "</td>
    <td>" . htmlspecialchars($row['ulasan']) . "</td>
    <td>" . htmlspecialchars($tgl) . "</td>
  </tr>";
  $no++;
}

echo "</table>";
?>
