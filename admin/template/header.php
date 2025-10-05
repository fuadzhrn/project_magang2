<?php
session_start();
// mengatasi user langsung masuk tanpa log
if(empty($_SESSION['id_user']) or empty($_SESSION['username']))

{
    echo"<script>
                alert('Harap Login terlebih dahulu!!');
                document.location='login.php';
                </script>";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <!-- Modern Admin CSS -->
    <link rel="stylesheet" href="asset/css/admin-modern.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../../img/favicon.png">
    <title>PLN Admin Dashboard</title>
  </head>
  <body class="fade-in">
    <!-- Modern Navigation -->
    <nav class="navbar navbar-expand-lg navbar-modern">
        <div class="container-fluid">
          <a class="navbar-brand" href="?halaman=home">
            <img src= "asset/LOGO PLN.png" alt="PLN Logo" style="height: 50px; width: 50px; margin-right: 8px; border-radius:30px;" >
            PLN Admin
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarModern" aria-controls="navbarModern" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarModern">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link <?php echo (!isset($_GET['halaman']) || $_GET['halaman'] == 'home') ? 'active' : ''; ?>" href="?halaman=home">
                  <i class="fas fa-home"></i> Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'mahasiswa') ? 'active' : ''; ?>" href="?halaman=mahasiswa">
                  <i class="fas fa-users"></i> Data Mahasiswa
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'ulasan-mhs') ? 'active' : ''; ?>" href="?halaman=ulasan-mhs">
                  <i class="fas fa-star"></i> Ulasan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'galeri') ? 'active' : ''; ?>" href="?halaman=galeri">
                  <i class="fas fa-images"></i> Galeri
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'media') ? 'active' : ''; ?>" href="?halaman=media">
                  <i class="fas fa-image"></i> Media Situs
                </a>
              </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle"></i> 
                  <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
                  <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- end nav -->
    
    <!-- Main Container -->
    <div class="container-modern">