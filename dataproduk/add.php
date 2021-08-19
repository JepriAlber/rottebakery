<?php require_once "../header.php"; ?>
    <div class="container">
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
        <div class="row">
            <div class="col">
            <form action="proses.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Jenis Kemasan</label>
                <select class="form-control" name="jenis">
                    <option>-Pili-</option>
                    <option value="Bungkus">Bungkus</option>
                    <option value="Liter">Liter</option>
                </select>
            </div>
            <div class="form-group">
                <label for="toko">Toko</label>
                <input type="text" name="toko" id="toko" class="form-control">
            </div>
            <button class="btn-primary btn-sm btn" name="simpan">Simpan</button>
        </form>
            </div>
        </div>
    </div>
<?php require_once "../footer.php"; ?>