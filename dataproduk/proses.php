<?php
    if (isset($_POST['simpan'])) {
        
        require_once "../config/config.php";
            $nama   = trim(mysqli_escape_string($con,$_POST['nama']));
            $stok   = trim(mysqli_escape_string($con,$_POST['stok']));
            $harga   = trim(mysqli_escape_string($con,$_POST['harga']));
            $jenis   = trim(mysqli_escape_string($con,$_POST['jenis']));
            $toko   = trim(mysqli_escape_string($con,$_POST['toko']));
            
        $simpanData = mysqli_query($con,"INSERT INTO produk(nama,harga,jenis,stok,toko) VALUE('$nama',$harga,'$jenis',$stok,'$toko')");
        if ($simpanData == TRUE) {
            header('location:data.php');
            $_SESSION['pesan']		= "Data berhasil ditambah!";
            $_SESSION['kondisi']	= "alert-success";
        } else {
            header('location:add.php');
            $_SESSION['pesan']		= "Data gagal ditambah!";
            $_SESSION['kondisi']	= "alert-danger";
        }

    }elseif(isset($_POST['update'])){

        require_once "../config/config.php";
            $produk_id   = trim(mysqli_escape_string($con,$_POST['produk_id']));
            $nama   = trim(mysqli_escape_string($con,$_POST['nama']));
            $stok   = trim(mysqli_escape_string($con,$_POST['stok']));
            $harga   = trim(mysqli_escape_string($con,$_POST['harga']));
            $jenis   = trim(mysqli_escape_string($con,$_POST['jenis']));
            $toko   = trim(mysqli_escape_string($con,$_POST['toko']));

            $updateData = mysqli_query($con,"UPDATE produk SET nama='$nama',harga=$harga,jenis='$jenis',stok=$stok,toko='$toko' WHERE produk_id=$produk_id") or die(mysqli_error($con));

        if ($updateData == TRUE) {
            header('location:data.php');
            $_SESSION['pesan']		= "Berhasil melakukan perbaikan data!";
            $_SESSION['kondisi']	= "alert-success";
        } else {
            header('location:add.php');
            $_SESSION['pesan']		= "Gagal melakukan perbaikan data!";
            $_SESSION['kondisi']	= "alert-danger";
        }
    }
?>