<?php
// Export PDF: Data Mahasiswa Magang

// 1) Koneksi DB
include_once __DIR__ . '/../../config/koneksi.php';

// 2) Load Dompdf dari lokasi yang tersedia
$dompdfLoaded = false;
$paths = [
  __DIR__ . '/dompdf/autoload.inc.php',          // bundel dompdf di folder ini
  __DIR__ . '/../../../vendor/autoload.php',     // fallback composer vendor (jika ada)
];
foreach ($paths as $p) {
  if (file_exists($p)) {
    require_once $p;
    $dompdfLoaded = true;
    break;
  }
}
if (!$dompdfLoaded) {
  header('HTTP/1.1 500 Internal Server Error');
  echo 'Dompdf tidak ditemukan. Pastikan dompdf tersedia di modul data-mahasiswa atau vendor composer.';
  exit;
}

use Dompdf\Dompdf;

// 3) Siapkan filter opsional agar konsisten dengan listing
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

// 4) Ambil data sesuai filter
$sql = "
  SELECT pm.*, sb.nama_bidang, 
         bs.nomor_surat, bs.file_pdf AS balasan_file,
         ds.file_sertifikat
  FROM peserta_magang pm
  JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang
  LEFT JOIN balasan_surat bs ON pm.nama_mahasiswa = bs.nama_pengirim AND pm.asal_instansi = bs.asal_instansi
  LEFT JOIN data_sertifikat ds ON pm.nama_mahasiswa = ds.nama_lengkap AND pm.asal_instansi = ds.asal_instansi
  $where
  ORDER BY pm.id_mahasiswa DESC
";
$result = mysqli_query($koneksi, $sql);

// 5) Susun HTML + CSS
$printedAt = date('d/m/Y H:i');
$rows = '';
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
  $nama = htmlspecialchars($row['nama_mahasiswa'] ?? '', ENT_QUOTES, 'UTF-8');
  $instansi = htmlspecialchars($row['asal_instansi'] ?? '', ENT_QUOTES, 'UTF-8');
  $bidang = htmlspecialchars($row['nama_bidang'] ?? '', ENT_QUOTES, 'UTF-8');
  $nosurat = htmlspecialchars($row['nomor_surat'] ?? '', ENT_QUOTES, 'UTF-8');
  $tglMasuk = '';
  if (!empty($row['tgl_masuk'])) { $ts = strtotime($row['tgl_masuk']); $tglMasuk = $ts ? date('d/m/Y', $ts) : htmlspecialchars($row['tgl_masuk'], ENT_QUOTES, 'UTF-8'); }
  $tglKeluar = '';
  if (!empty($row['tgl_keluar'])) { $ts2 = strtotime($row['tgl_keluar']); $tglKeluar = $ts2 ? date('d/m/Y', $ts2) : htmlspecialchars($row['tgl_keluar'], ENT_QUOTES, 'UTF-8'); }
  $status = htmlspecialchars($row['status'] ?? '', ENT_QUOTES, 'UTF-8');
  $files = [];
  if (!empty($row['file_sertifikat'])) $files[] = 'Sertifikat';
  if (!empty($row['balasan_file'])) $files[] = 'Balasan';
  $filesTxt = $files ? implode(', ', $files) : '-';

  $rows .= '<tr>
    <td class="center">' . ($no++) . '</td>
    <td>' . ($nosurat !== '' ? '<strong>' . $nosurat . '</strong>' : '-') . '</td>
    <td><strong>' . $nama . '</strong></td>
    <td>' . $instansi . '</td>
    <td>' . $bidang . '</td>
    <td class="center">' . $tglMasuk . '</td>
    <td class="center">' . $tglKeluar . '</td>
    <td class="center">' . $status . '</td>
    <td>' . $filesTxt . '</td>
  </tr>';
}

$total = (int)mysqli_num_rows($result);

$html = '<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Data Mahasiswa Magang</title>
<style>
  @page { margin: 18px 18px; }
  body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color:#2c3e50; }
  .title { text-align:center; margin-bottom: 6px; font-size: 16px; font-weight: 700; color:#1d4c53; }
  .subtitle { text-align:center; margin: 0 0 12px; font-size: 10px; color:#666; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #dfe7ea; padding: 6px 8px; vertical-align: top; }
  thead th { background: #019AA5; color: #fff; font-size: 10px; text-transform: uppercase; }
  tbody tr:nth-child(even) { background: #fafcfd; }
  .center { text-align: center; }
  .w-36 { width: 32px; }
  .w-120 { width: 120px; }
  .w-150 { width: 150px; }
  .w-90 { width: 90px; }
  .footer { margin-top: 8px; font-size: 10px; color:#6b7a86; }
  .muted { color:#95a5a6; }
</style>
</head>
<body>
  <div class="title">Data Mahasiswa Magang</div>
  <div class="subtitle">Dicetak: ' . $printedAt . '</div>
  <table>
    <thead>
      <tr>
        <th class="w-36 center">No</th>
        <th class="w-120">Nomor Surat</th>
        <th class="w-150">Nama</th>
        <th class="w-150">Instansi</th>
        <th class="w-150">Sub Bidang</th>
        <th class="w-90 center">Tgl Masuk</th>
        <th class="w-90 center">Tgl Keluar</th>
        <th class="w-90 center">Status</th>
        <th>Files</th>
      </tr>
    </thead>
    <tbody>
      ' . ($rows ?: '<tr><td colspan="9" class="center" style="padding:18px;">Tidak ada data</td></tr>') . '
    </tbody>
  </table>
  <div class="footer">Total: ' . $total . ' data <span class="muted">| PLN Admin</span></div>
</body>
</html>';

// 6) Render PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('data_mahasiswa.pdf', ['Attachment' => true]);
exit;
?>
