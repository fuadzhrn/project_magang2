<?php
@$halaman = $_GET['halaman'];
@$hal = $_GET['hal'];

if ($halaman == "mahasiswa") {
    if ($hal == "tambahdata" || $hal == "edit" || $hal == "hapus") {
        include "modul/data-mahasiswa/form-mahasiswa.php";
    } else {
        include "modul/data-mahasiswa/data-mahasiswa.php";
    }
    } elseif ($halaman == "sub-bidang") {
        include "modul/data-mahasiswa/data-sub-bidang.php";
    } elseif ($halaman == "ulasan-mhs") {
        // echo "Tampil Halaman Modul Ulasan";
        include "modul/ulasan-mhs/ulasan-mhs.php";
    } elseif ($halaman == "galeri") {
        include "modul/galeri/index.php";
    } elseif ($halaman == "media") {
        include "modul/media/index.php";
    } else {
        include "modul/home.php";
    }
 ?>
