<?php
require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) && $_SESSION['level'] !==0) {
    echo "<script>window.location='".base_url('auth/login.php')."'</script>";
  }else{
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
                        Tambah Pengguna Aplikasi
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama Pengguna</label>
                                <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level" required>
                                    <option>-Pilih-</option>
                                    <option value="1">Super User (Toko A & B)</option>
                                    <option value="2">User (Toko A)</option>
                                    <option value="3">User (Toko B)</option>
                                </select>
                            </div>
                            <button class="btn-primary btn-block btn" onclick="return confirm('Apakah anda yakin menambah produk ini?')" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
 require_once "../footer.php"; ?>