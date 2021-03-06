<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] !=0) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{
$dataProduk = mysqli_query($con,"SELECT * FROM produk") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataProduk)) {
            $data[]=$dt;
        }

?>
<div class="container">
    <a href="<?=base_url('dataproduk/add.php');?>" class="btn btn-primary btn-sm mt-3 mb-3">Tambah Produk</a>
  
    <div class="row">
          <div class="col">
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
    </div>

    <div class="row">
    <div class="col">
        <div class="card">
          <div class="card-header">
            Produk
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataproduk">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Toko</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                      <?php
                      $no=1; 
                      foreach ($data as $datapro) { ?>
                          <tr>
                              <td><?=$no++;?></td>
                              <td><?=$datapro['nama'];?></td>
                              <td><?=$datapro['stok'];?></td>
                              <td><?=rupiah($datapro['harga']);?>/<?=$datapro['jenis'];?></td>
                              <td><?=$datapro['toko'];?></td>
                              <td>
                                  <a href="addstok.php?id=<?=$datapro['produk_id'];?>" class="btn btn-primary btn-sm">Tambah Stok</a> |
                                  <a href="edit.php?id=<?=$datapro['produk_id'];?>" class="btn btn-warning btn-sm">Edit</a> |
                                  <a href="delete.php?id=<?=$datapro['produk_id'];?>" onclick="return confirm('Apakah yakin hapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
                              </td>
                          </tr>
                    <?php  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
        $(document).ready( function () {
          $('#dataproduk').DataTable();
        } );
		</script>
<?php 
}
require_once "../footer.php"; ?>