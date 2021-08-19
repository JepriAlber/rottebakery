<?php 
require_once "../config/config.php";

    if ($_SESSION['level']==0) {
        header('location:../dataproduk/data.php');
    }elseif($_SESSION['level']==2 || $_SESSION['level']==3){
        header('location:../transaksi/transaksi.php');
    }else{
        //lakukan pilihan untuk memilih toko yang di akses 
        header('location:cekleveltoko.php');
    }
?>