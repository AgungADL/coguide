<?php
    // untuk di localhost
    $SERVER="localhost";
    $username="root";
    $password="";
    $dbname="coguide";

    // untuk di hosting di infinityfree (http://coguide.kesug.com/)
    // $SERVER="sql213.infinityfree.com";
    // $username="if0_38764951";
    // $password="coguide2025";
    // $dbname="if0_38764951_coguide";

    $koneksi=mysqli_connect($SERVER, $username, $password, $dbname);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        // Cuma untuk debug awal
        // echo "Koneksi berhasil!";
    }
?>