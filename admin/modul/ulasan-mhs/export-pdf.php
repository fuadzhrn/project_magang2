<?php
// Export PDF untuk Data Ulasan Mahasiswa (testimoni)

// 1) Koneksi DB (gunakan path absolut berbasis file ini)
include_once __DIR__ . '/../../config/koneksi.php';

// 2) Load Dompdf dari lokasi yang tersedia (prioritas: modul data-mahasiswa)
$dompdfLoaded = false;
$paths = [
  __DIR__ . '/../data-mahasiswa/dompdf/autoload.inc.php', // bundel dompdf di modul data-mahasiswa
  __DIR__ . '/dompdf/autoload.inc.php',                   // jika suatu saat ada di folder ini
  __DIR__ . '/../../../vendor/autoload.php',              // fallback composer vendor (jika ada)
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

// 3) Ambil data testimoni
// Gunakan kolom 'tanggal' (bukan 'created_at') sesuai struktur tabel yang dipakai di halaman publik
$result = mysqli_query($koneksi, "SELECT id, nama, instansi, rating, ulasan, tanggal FROM testimoni ORDER BY tanggal DESC, id DESC");

// 4) Susun HTML dengan CSS ringan
$today = date('d/m/Y H:i');
$rows = '';
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
  $nama = htmlspecialchars($row['nama'] ?? '', ENT_QUOTES, 'UTF-8');
  $instansi = htmlspecialchars($row['instansi'] ?? '', ENT_QUOTES, 'UTF-8');
  $rating = (int)($row['rating'] ?? 0);
  $rating = max(0, min(5, $rating));
  $ulasan = htmlspecialchars($row['ulasan'] ?? '', ENT_QUOTES, 'UTF-8');
  // Tanggal bisa bernama 'tanggal' pada tabel
  $tglRaw = $row['tanggal'] ?? '';
  // Opsional format tampilan jika berbentuk datetime standar
  $tgl = '';
  if (!empty($tglRaw)) {
    $ts = strtotime($tglRaw);
    $tgl = $ts ? date('d/m/Y H:i', $ts) : htmlspecialchars($tglRaw, ENT_QUOTES, 'UTF-8');
  }

  $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);

  $rows .= '<tr>
    <td style="text-align:center;">' . ($no++) . '</td>
    <td><strong>' . $nama . '</strong></td>
    <td>' . $instansi . '</td>
    <td style="text-align:center; color:#f1c40f;">' . $stars . '</td>
    <td>' . nl2br($ulasan) . '</td>
    <td style="text-align:center;">' . $tgl . '</td>
  </tr>';
}

$html = '<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<title>Export Ulasan Mahasiswa</title>
<style>
  @page { margin: 20px 20px; }
  body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color:#2c3e50; }
  .title { text-align:center; margin-bottom: 8px; font-size: 16px; font-weight: 700; color: #1d4c53; }
  .subtitle { text-align:center; margin: 0 0 14px; font-size: 11px; color:#666; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #dfe7ea; padding: 6px 8px; vertical-align: top; }
  thead th { background: #019AA5; color: #fff; font-size: 10px; text-transform: uppercase; }
  tbody tr:nth-child(even) { background: #fafcfd; }
  .small { font-size: 10px; color: #6b7a86; }
  .right { text-align: right; }
  .center { text-align: center; }
  .w-36 { width:36px; }
  .w-160 { width:160px; }
  .w-105 { width:105px; }
  .w-80 { width:80px; }
  .stars { color:#f1c40f; }
  .footer { margin-top: 8px; font-size: 10px; color:#6b7a86; }
  .footer .muted { color:#95a5a6; }
</style>
</head>
<body>
  <div class="title">Data Ulasan Mahasiswa</div>
  <div class="subtitle">Dicetak: ' . $today . '</div>
  <table>
    <thead>
      <tr>
        <th class="w-36 center">No</th>
        <th class="w-160">Nama</th>
        <th class="w-160">Instansi</th>
        <th class="w-80 center">Rating</th>
        <th>Ulasan</th>
        <th class="w-105 center">Tanggal</th>
      </tr>
    </thead>
    <tbody>
      ' . ($rows ?: '<tr><td colspan="6" style="text-align:center; padding:20px;">Tidak ada data</td></tr>') . '
    </tbody>
  </table>
  <div class="footer">Total: ' . (int)mysqli_num_rows($result) . ' ulasan <span class="muted">| PLN Admin</span></div>
</body>
</html>';

// 5) Render PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('ulasan_mahasiswa.pdf', ['Attachment' => true]);
exit;
?>
