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
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" >
    <link rel="icon" href="../../img/favicon.png">
    <title>Admin</title>
  </head>
  <body>
    <!-- star nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
  <a class="navbar-brand" href="#">A-dmin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?halaman=home">Home <span class="sr-only">(current)</span></a>
      </li>
         <li class="nav-item">
        <a class="nav-link" href="?halaman=mahasiswa">Data Mahasiswa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=balasan_surat">Permintaan Surat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=sertifikat-mhs">Sertifikat</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="?halaman=ulasan-mhs">Ulasan</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  </div>
</nav>
<!-- end nav -->
 <!-- awal container-->
  <div class="container">