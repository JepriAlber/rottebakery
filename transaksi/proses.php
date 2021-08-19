<?php 
    if (isset($_POST['simpan'])) {
        require_once "../config/config.php";
        $pengguna_id        = $_SESSION['user_id'];
        $produk_id          = trim(mysqli_escape_string($con,$_POST['produk_id']));
        $stok_terjual       = trim(mysqli_escape_string($con,$_POST['stok_terjual']));
        $total_transaksi    = trim(mysqli_escape_string($con,$_POST['fixbayar']));

            $ambilStok = mysqli_query($con,"SELECT * FROM produk WHERE produk_id = $produk_id") or die(mysqli_error($con));
            $dataStokProduk = mysqli_fetch_assoc($ambilStok);
                $stokTerbaru = $dataStokProduk['stok'] -  $stok_terjual ;
                //ubah stok
                $updateProduk = mysqli_query($con,"UPDATE produk SET stok=$stokTerbaru WHERE produk_id = $produk_id ");

                    if ($updateProduk==TRUE) {
                            $simpanTransaksi = mysqli_query($con,"INSERT INTO transaksi(produk_id,pengguna_id,stok_terjual,total_transaksi)VALUE($produk_id,$pengguna_id,$stok_terjual,$total_transaksi)");
                                if ($simpanTransaksi) {
                                    header('location:transaksi.php');
                                    $_SESSION['pesan']		= "Data Pengguna berhasil diubah!";
                                    $_SESSION['kondisi']	= "alert-success";
                                }else{
                                    header('location:transaksi.php');
                                    $_SESSION['pesan']		= "Gagal melakukan transaksi";
                                    $_SESSION['kondisi']	= "alert-danger";
                                }
                        
                    } else {
                        header('location:transaksi.php');
                        $_SESSION['pesan']		= "Gagal melakukan transaksi";
                        $_SESSION['kondisi']	= "alert-danger";
                    }
            echo"<pre>";
        print_r($dataStokProduk['stok']); die();
        echo"</pre>";
    }
?>