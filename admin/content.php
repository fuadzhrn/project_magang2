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
     } elseif ($halaman == "sertifikat-mhs") {
        // echo "Tampil Halaman Modul Permintaan surat";
        include "modul/sertifikat/sertifikat-mhs.php";
    } elseif ($halaman == "balasan_surat") {
        // echo "Tampil Halaman Modul Permintaan surat";
        include "modul/balasan-surat/balasan_surat.php";
    } elseif ($halaman == "ulasan-mhs") {
        // echo "Tampil Halaman Modul Ulasan";
        include "modul/ulasan-mhs/ulasan-mhs.php";
    } else {
        include "modul/home.php";
    }
 ?>
