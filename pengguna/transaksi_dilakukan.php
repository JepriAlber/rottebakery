<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] != 0) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{
$pengguna_id = @$_GET['id'];
$nama = @$_GET['nama'];
$dataTransaksi = mysqli_query($con,"SELECT produk.nama,produk.toko,transaksi.* FROM produk,transaksi WHERE produk.produk_id=transaksi.produk_id AND transaksi.pengguna_id=$pengguna_id ORDER BY transaksi.waktu DESC") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataTransaksi)) {
            $data[]=$dt;
        }
        
?>
<div class="container">
    <a href="data.php" class="btn btn-warning mt-2 mb-2 btn-sm">Kembali</a>
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
              Data Transaksi <strong><?=$nama;?></strong>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="datatransaksi">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Sok Terjual</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Toko</th>
                    <th scope="col">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                      <?php
                      $no=1; 
                      foreach ($data as $dataT) { ?>
                          <tr>
                              <td><?=$no++;?></td>
                              <td><?=$dataT['nama'];?></td>
                              <td><?=$dataT['stok_terjual'];?></td>
                              <td><?=rupiah($dataT['total_transaksi'])?></td>
                              <td><?=$dataT['toko'];?></td>
                              <td><?=date('d-m-y H:i:s',strtotime($dataT['waktu']));?></td>
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
          $('#datatransaksi').DataTable();
        } );
		</script>
<?php 
}
require_once "../footer.php"; ?>