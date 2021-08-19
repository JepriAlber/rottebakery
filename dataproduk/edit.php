<?php
require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] !=0) {
    echo "<script>window.location='".base_url('auth/login.php')."'</script>";
  }else{
      $produk_id    = @$_GET['id'];
      $dataProduk   = mysqli_query($con,"SELECT * FROM produk WHERE produk_id=$produk_id");
?>
    <div class="container mt-2">
    <a href="data.php" class="btn-warning btn-sm btn mb-2">Kembali</a>
        <div class="row">
        <?php if (isset($_SESSION['pesan'])) { ?>
        <div class="alert <?=$_SESSION['kondisi'];?> alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>&times;</span>
            </button>
            <center><?=$_SESSION['pesan']; ?></center>
          </div>
        </div>
     <?php } unset($_SESSION['pesan']); unset($_SESSION['kondisi']); ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Edit Produk
                    </div>
                    <div class="card-body">
                        <?php 
                            while ($data=mysqli_fetch_assoc($dataProduk)) { ?>
                                <form action="proses.php" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" value="<?=$data['produk_id'];?>" name="produk_id">
                                        <label for="nama">Nama Produk</label>
                                        <input type="text" name="nama" id="nama" class="form-control" required value="<?=$data['nama'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-control" value="<?=$data['harga'];?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis">Jenis Kemasan</label>
                                        <select class="form-control" name="jenis" required>
                                            <option value="<?=$data['jenis'];?>"><?=$data['jenis'];?></option>
                                            <option value="Bungkus">Bungkus</option>
                                            <option value="Liter">Liter</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="text" name="stok" id="stok" class="form-control" value="<?=$data['stok'];?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="toko">Toko</label>
                                        <select class="form-control" name="toko" required>
                                            <option value="<?=$data['toko'];?>"><?=$data['toko'];?></option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <button class="btn-primary btn-block btn" onclick="return confirm('Apakah anda ingin melakukan perubahan?')" name="update">Simpan</button>
                                </form>
                    <?php    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
 require_once "../footer.php"; ?>