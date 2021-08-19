<?php 
    if (isset($_POST['toko'])) {
        
    session_start();
        if ($_POST['toko'] == 2) {
            $_SESSION['level']=2;
            header('location:../transaksi/transaksi.php');
        }elseif($_POST['toko']==3){
            $_SESSION['level']=3;
            header('location:../transaksi/transaksi.php');
        }else{
            header('location:cekleveltoko.php');
        }
    }
?>