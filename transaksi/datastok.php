<?php 
require_once "../config/config.php";
if(isset($_POST['produk'])){
    $produk = $_POST['produk'];
        $dataKodes = mysqli_query($con,"SELECT * FROM produk WHERE produk_id=$produk"); 
        $data      = mysqli_fetch_assoc($dataKodes);
        ?>
    <input type="number" id="nilai_stok" name="stok" value="<?=$data['stok'];?>" class="form-control" readonly>
<?php
}else if(isset($_POST['produkharga'])){
    $produkharga = $_POST['produkharga'];
        $dataKodes = mysqli_query($con,"SELECT * FROM produk WHERE produk_id=$produkharga"); 
        $data      = mysqli_fetch_assoc($dataKodes);
        ?>
    <input type="hidden" id="harga" name="harga" value="<?=$data['harga'];?>" class="form-control">
<?php
}
?>