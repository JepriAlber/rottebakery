<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] != 0) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{

$dataTransaksi = mysqli_query($con,"SELECT produk.nama,produk.toko,user.nama as nama_user,transaksi.* FROM produk,transaksi,user WHERE produk.produk_id=transaksi.produk_id AND user.pengguna_id=transaksi.pengguna_id ORDER BY transaksi.waktu DESC") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataTransaksi)) {
            $data[]=$dt;
        }
        
?>
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm mt-2 mb-2" data-toggle="modal" data-target="#exampleModal">
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
              Data Transaksi Semua Toko
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="datatransaksi">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama User</th>
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
                              <td><?=$dataT['nama_user'];?></td>
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
        <form method="POST" id="printlaporan">
          <div class="form-group">
              <label for="jenis_laporan">Jenis Laporan:</label>
              <select class="form-control" name="jenis_laporan" id="jenis_laporan" required>
                  <option>-Pilih-</option>
                  <option value="harian">Harian</option>
                  <option value="bulan">Bulanan</option>
              </select>
          </div>
          <div class="harian"></div>
          <div class="bulan"></div>
          <div class="tahun"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="tombol" name="print">Print</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <script type="text/javascript">
        $(document).ready( function () {
          $('#datatransaksi').DataTable();
          $('#tombol').hide();
          $("#jenis_laporan").change(function(){
              var jenisLaporan = $("#jenis_laporan").val();
                if (jenisLaporan=="harian") {
                  $('.bulan2').remove();
                  $('.tahun1').remove();
                  $('#tombol').show();
                  var form ='<div class="harian2"><div class="form-group" id="form-dari"><label for="dari">Dari Tanggal</label><input type="date" name="dari" id="dari" class="form-control" required></div><div class="form-group" id="form-sampai"><label for="sampai">Sampai</label><input type="date" name="sampai" id="sampai" class="form-control" required></div></div>';

                  $("#printlaporan").attr("action","printpimpinan.php");
                  $('.harian').append(form);
                }else{
                  $('.harian2').remove();
                  $('#tombol').show();
                  var tahun = '<div class="tahun1"><div class="form-group"><label for="tahun">Tahun:</label><select class="form-control" name="tahun" id="tahun" required><option>-Pilih-</option><?php for($i=date('Y');$i>=2000;$i--): ?><option><?=$i;?></option><?php endfor; ?></select></div></div>';
                  var bulan = '<div class="bulan2"><div class="form-group"><label for="bulan">Bulan:</label><select class="form-control" name="bulan" id="bulan" required><option>-Pilih-</option><option value="01">Januari</option><option value="02">Februari</option><option value="03">Maret</option><option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option><option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option><option value="10">Oktober</option><option value="12">November</option><option value="12">Desember</option></select></div></div>';
                  $("#printlaporan").attr("action","print_bulanan.php");
                  $('.bulan').append(bulan);
                  $('.tahun').append(tahun);
                }
               
          });
        } );
		</script>
<?php 
}
require_once "../footer.php"; ?>