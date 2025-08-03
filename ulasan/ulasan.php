<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/PLN/style/style.css?v=<?php echo time(); ?>">
      <link rel="stylesheet" href="/PLN/style/ulasan1.css?v=<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../img/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
  <section class="testimonial-section">
  <div class="testimonial-container">

    <!-- Kolom Kiri -->
    <div class="testimonial-intro animate__animated animate__lightSpeedInLeft ">
      <p class="testimonial-label"></p>
      <h2 class="testimonial-heading">
        Apa Kata Peserta Magang di PT PLN UID Sulselrabar?
      </h2>
      <p class="testimonial-description">
        Berikut cerita dan pengalaman langsung dari peserta magang di PLN UID Sulselrabar.
      </p>
      <a href="msk-ulasan.php" class="testimonial-button">Bagikan Ceritamu</a>
    </div>

   <!-- Kolom Kanan (scroll ke bawah) -->
<?php
include "../admin/config/koneksi.php";

// Ambil semua data ulasan
$query = mysqli_query($koneksi, "SELECT * FROM testimoni ORDER BY tanggal DESC");

$kolomTengah = [];
$kolomKanan = [];
$i = 0;

// Bagi jadi dua kolom
while ($row = mysqli_fetch_assoc($query)) {
    if ($i % 2 == 0) {
        $kolomTengah[] = $row;
    } else {
        $kolomKanan[] = $row;
    }
    $i++;
}

// Deteksi mobile
$is_mobile = preg_match('/(android|iphone|ipad)/i', $_SERVER['HTTP_USER_AGENT']);
?>

<!-- Kolom Tengah -->
<div class="testimonial-column">
  <div class="testimonial-scroll-wrapper">
    <div class="testimonial-scroll <?= $is_mobile ? 'no-scroll' : '' ?>">
      <?php foreach ($kolomTengah as $row): ?>
        <div class="testimonial-card">
          <div class="testimonial-rating">★ <?= number_format($row['rating'], 1) ?></div>
          <p class="testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
          <p class="testimonial-name"><?= htmlspecialchars($row['nama']) ?></p>
          <p class="testimonial-role"><?= htmlspecialchars($row['instansi']) ?></p>
        </div>
      <?php endforeach; ?>

      <?php if (!$is_mobile): ?>
        <!-- Duplikat hanya untuk desktop -->
        <?php foreach ($kolomTengah as $row): ?>
          <div class="testimonial-card">
            <div class="testimonial-rating">★ <?= number_format($row['rating'], 1) ?></div>
            <p class="testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
            <p class="testimonial-name"><?= htmlspecialchars($row['nama']) ?></p>
            <p class="testimonial-role"><?= htmlspecialchars($row['instansi']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Kolom Kanan -->
<div class="testimonial-column">
  <div class="testimonial-scroll-wrapper">
    <div class="testimonial-scroll-down <?= $is_mobile ? 'no-scroll' : '' ?>">
      <?php foreach ($kolomKanan as $row): ?>
        <div class="testimonial-card">
          <div class="testimonial-rating">★ <?= number_format($row['rating'], 1) ?></div>
          <p class="testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
          <p class="testimonial-name"><?= htmlspecialchars($row['nama']) ?></p>
          <p class="testimonial-role"><?= htmlspecialchars($row['instansi']) ?></p>
        </div>
      <?php endforeach; ?>

      <?php if (!$is_mobile): ?>
        <!-- Duplikat hanya untuk desktop -->
        <?php foreach ($kolomKanan as $row): ?>
          <div class="testimonial-card">
            <div class="testimonial-rating">★ <?= number_format($row['rating'], 1) ?></div>
            <p class="testimonial-text"><?= htmlspecialchars($row['ulasan']) ?></p>
            <p class="testimonial-name"><?= htmlspecialchars($row['nama']) ?></p>
            <p class="testimonial-role"><?= htmlspecialchars($row['instansi']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>



  </div>
</section>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/typeit@8.7.1/dist/index.umd.js"></script>
<script>
 document.addEventListener("DOMContentLoaded", function () {
  new TypeIt(".testimonial-label", {
    strings: ["Cerita Mereka"],
    speed: 100,
    loop: true,
    deleteSpeed: 100,
    nextStringDelay: 1500
  }).go();
});

</script>
<script>
  AOS.init();
</script>
</html>