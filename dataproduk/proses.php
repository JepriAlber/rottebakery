<?php
    if (isset($_POST['simpan'])) {
        require_once "../config/config.php";
            $pengguna_id = $_SESSION['user_id'];
            $nama   = trim(mysqli_escape_string($con,$_POST['nama']));
            $stok   = trim(mysqli_escape_string($con,$_POST['stok']));
            $harga   = trim(mysqli_escape_string($con,$_POST['harga']));
            $jenis   = trim(mysqli_escape_string($con,$_POST['jenis']));
            $toko   = trim(mysqli_escape_string($con,$_POST['toko']));
            
        $simpanData = mysqli_query($con,"INSERT INTO produk(nama,harga,jenis,stok,toko,pengguna_id) VALUE('$nama',$harga,'$jenis',$stok,'$toko','$pengguna_id')");
        if ($simpanData == TRUE) {
            header('location:data.php');
            $_SESSION['pesan']		= "Data berhasil ditambah!";
            $_SESSION['kondisi']	= "alert-success";
        } else {
            header('location:add.php');
            $_SESSION['pesan']		= "Data gagal ditambah!";
            $_SESSION['kondisi']	= "alert-danger";
        }
    }
?>