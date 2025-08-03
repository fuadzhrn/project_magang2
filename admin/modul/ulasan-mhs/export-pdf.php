<?php
require_once 'dompdf/autoload.inc.php'; // pastikan ini betul

use Dompdf\Dompdf;

// DATA
include "../../config/koneksi.php";

$html = '<h3>Data Ulasan Mahasiswa</h3>';
$html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Instansi</th>
  <th>Rating</th>
  <th>Ulasan</th>
</tr>';

$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY id DESC");
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
      <td>{$no}</td>
      <td>" . htmlspecialchars($row['nama']) . "</td>
      <td>" . htmlspecialchars($row['instansi']) . "</td>
      <td>" . htmlspecialchars($row['rating']) . "</td>
      <td>" . htmlspecialchars($row['ulasan']) . "</td>
    </tr>";
    $no++;
}
$html .= '</table>';

// RENDER PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape'); // atau portrait
$dompdf->render();
$dompdf->stream("ulasan-magang.pdf", ["Attachment" => false]); // tampilkan di browser
?>
