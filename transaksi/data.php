<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] < 2) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{
    if ($_SESSION['level']==2) {
        $toko = "A";
    }elseif($_SESSION['level']==3){
        $toko = "B";
    }
$dataTransaksi = mysqli_query($con,"SELECT produk.nama,transaksi.* FROM produk,transaksi WHERE produk.produk_id=transaksi.produk_id AND produk.toko='$toko' ORDER BY transaksi.waktu DESC") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataTransaksi)) {
            $data[]=$dt;
        }
        
?>
<div class="container">
    <h1>Toko : <?=$toko;?></h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
      Print Laporan
    </button>
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
              Data Transaksi Toko <strong><?=$toko; ?></strong>
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
                              <td><?=$dataT['total_transaksi'];?></td>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="print.php" method="POST">
          <div class="form-group">
            <label for="dari">Dari Tanggal</label>
            <input type="date" name="dari" id="dari" class="form-control">
          </div>
          <input type="hidden" name="toko" value="<?=$toko;?>">
          <div class="form-group">
            <label for="sampai">Sampai</label>
            <input type="date" name="sampai" id="sampai" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" target="_blank" name="print">Print</button>
      </div>
      </form>
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