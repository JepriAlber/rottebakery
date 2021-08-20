<?php
    if (isset($_POST['simpan'])) {
        
        require_once "../config/config.php";
            $nama       = ucwords(trim(mysqli_escape_string($con,$_POST['nama'])));
            $stok       = trim(mysqli_escape_string($con,$_POST['stok']));
            $harga      = trim(mysqli_escape_string($con,$_POST['harga']));
            $jenis      = trim(mysqli_escape_string($con,$_POST['jenis']));
            $toko       = trim(mysqli_escape_string($con,$_POST['toko']));

                // ----------------------cek------------------------------------
                $cekDataProduk = mysqli_query($con,"SELECT * FROM produk WHERE nama='$nama' AND toko='$toko'");
                $cekData       = mysqli_fetch_assoc($cekDataProduk);
                        if (ubahString($nama) == ubahString($cekData['nama']) && $toko == $cekData['toko']) {
                            header('location:add.php');
                            $_SESSION['pesan']		= "Produk $nama sudah ada ditoko $toko";
                            $_SESSION['kondisi']	= "alert-warning";
                        }else{
                            $simpanData = mysqli_query($con,"INSERT INTO produk(nama,harga,jenis,stok,toko) VALUE('$nama',$harga,'$jenis',$stok,'$toko')");
                            if ($simpanData == TRUE) {
                                header('location:data.php');
                                $_SESSION['pesan']		= "Produk $nama berhasil ditambah!";
                                $_SESSION['kondisi']	= "alert-success";
                            } else {
                                header('location:add.php');
                                $_SESSION['pesan']		= "Produk $nama Gagal ditambah!";
                                $_SESSION['kondisi']	= "alert-danger";
                            }
                        }
            

    }elseif(isset($_POST['update'])){

        require_once "../config/config.php";
            $produk_id      = trim(mysqli_escape_string($con,$_POST['produk_id']));
            $nama           = ucwords(trim(mysqli_escape_string($con,$_POST['nama'])));
            $stok           = trim(mysqli_escape_string($con,$_POST['stok']));
            $harga          = trim(mysqli_escape_string($con,$_POST['harga']));
            $jenis          = trim(mysqli_escape_string($con,$_POST['jenis']));
            $toko           = trim(mysqli_escape_string($con,$_POST['toko']));

            $updateData = mysqli_query($con,"UPDATE produk SET nama='$nama',harga=$harga,jenis='$jenis',stok=$stok,toko='$toko' WHERE produk_id=$produk_id") or die(mysqli_error($con));

        if ($updateData == TRUE) {
            header('location:data.php');
            $_SESSION['pesan']		= "Berhasil melakukan perbaikan data!";
            $_SESSION['kondisi']	= "alert-success";
        } else {
            header('location:data.php');
            $_SESSION['pesan']		= "Gagal melakukan perbaikan data!";
            $_SESSION['kondisi']	= "alert-danger";
        }
    }
?>