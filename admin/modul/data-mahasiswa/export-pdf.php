<?php
require_once 'dompdf/autoload.inc.php'; // pastikan ini betul

use Dompdf\Dompdf;

include "../../config/koneksi.php";

$dompdf = new Dompdf();

$html = '
<h3 style="text-align:center;">Data Mahasiswa Magang</h3>
<table border="1" cellspacing="0" cellpadding="6" width="100%">
<tr>
  <th>No</th>
  <th>Nama Mahasiswa</th>
  <th>Asal Instansi</th>
  <th>Bidang</th>
  <th>Tgl Masuk</th>
  <th>Tgl Keluar</th>
  <th>Status</th>
</tr>';

$no = 1;
$query = mysqli_query($koneksi, "
  SELECT pm.*, sb.nama_bidang 
  FROM peserta_magang pm
  JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
");

while ($data = mysqli_fetch_assoc($query)) {
  $html .= "<tr>
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

$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("data_mahasiswa.pdf", ["Attachment" => true]);
?>
