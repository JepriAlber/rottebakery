<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] < 2) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{
    if ($_SESSION['level']==2) {
        $toko = "A";
    }elseif($_SESSION['level']==3){
        $toko = "B";
    }
        
?>
<div class="container">
    <h1>Toko : <?=$toko;?></h1>
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
             Transaksi Toko <strong><?=$toko; ?></strong>
          </div>
          <div class="card-body">
            
          <form action="proses.php" method="post">
            <div class="form-group">
                <label for="produk">Produk</label>
                <select name="produk_id" id="produk" class="form-control">
                    <option>-Pilih-</option>
                    <?php 
                        $dataProduk = mysqli_query($con,"SELECT * FROM produk WHERE toko='$toko'");
                        while ($produk = mysqli_fetch_assoc($dataProduk)) { ?>
                            <option value="<?=$produk['produk_id'];?>"><?=$produk['nama'];?> : <?=rupiah($produk['harga']) ?>/<?=$produk['jenis'];?></option>
                    <?php    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="form-stok">
                <label for="stok">Stok Tersedia</label>
                <div id="stok">
                </div>
            </div>
            <div id="nilaiharga" >

            </div>
            <div class="form-group"  id="form-stok_terjual">
                <label for="jumlah">Jumlah Dibeli</label>
                <input type="number" name="stok_terjual" id="stok_terjual" class="form-control">
            </div>
            <div class="form-group" id="form-total_pembelian">
                <label for="total_pembelian">Total Harga Asli</label>
                <input type="text" name="total_pembelian" id="total_pembelian" class="form-control" readonly>
            </div>
            <div class="form-group" id="form-tipe">
                <label for="tipe">Tipe Pembayaran</label>
                <select class="form-control" name="tipe" id="tipe" required>
                    <option>-Pilih-</option>
                    <option value="0">Cash</option>
                    <option value="0.15">Gopay (15%)</option>
                    <option value="0.05">Dana (5%)</option>
                </select>
            </div>
            <div class="form-group" id="form-fixbayar">
                <label for="fixbayar">Harga yang harus dibayar</label>
                <input type="text" name="fixbayar" id="fixbayar" class="form-control" readonly>
            </div>
            <div class="form-group" id="form-bayar">
                <label for="bayar">Bayar</label>
                <input type="text" name="bayar" id="bayar" class="form-control">
            </div>
            <div class="form-group" id="form-kembalian">
                <label for="kembalian">Kembalian</label>
                <input type="text" name="kembalian" id="kembalian" class="form-control" readonly>
            </div>

            <button class="btn btn-block btn-primary" name="simpan">Simpan</button>
          </form>
          
          </div>
        </div>
    </div>
  </div>
</div>
   <script>
       $('#form-stok').hide();
       $('#form-stok_terjual').hide();
       $('#form-total_pembelian').hide();
       $('#form-tipe').hide();
       $('#form-fixbayar').hide();
       $('#form-bayar').hide();
       $('#form-kembalian').hide();
                            
        $('#produk').change(function(){
            //variabel dari nilai combo box kota kabupaten
            var id_kokab = $('#produk').val();
            
            //menggunakan ajax untuk mengirim dan menerima data server
            $.ajax({
                type:"POST",
                dataType:"html",
                url:"datastok.php",
                data:"produk="+id_kokab,
                success:function(data){
                    $('#form-stok').show();
                    $('#form-stok_terjual').show();
                    $('#form-total_pembelian').show();
                    $('#form-tipe').show();
                    $('#form-fixbayar').show();
                    $('#form-bayar').show();
                    $('#form-kembalian').show();
                    $('#stok').html(data);
                }
            });
            $.ajax({
                type:"POST",
                dataType:"html",
                url:"datastok.php",
                data:"produkharga="+id_kokab,
                success:function(data){
                    $('#nilaiharga').html(data);
                }
            });
            
        });

        $( "#tipe").change(function() {
                var pembelian  = parseInt($("#total_pembelian").val());
                var tipe = parseFloat($("#tipe").val());
                var diskon = tipe * pembelian;
                var fixbayar = pembelian - diskon;
                $("#fixbayar").val(fixbayar);
            });

        $(document).ready(function() {
            
            $( "#stok_terjual").keyup(function() {
                var harga  = parseInt($("#harga").val());
                var stok_terjual = parseInt($("#stok_terjual").val());
                var total = harga * stok_terjual;
               
                $("#total_pembelian").val(total);
            });

           

            $( "#bayar").keyup(function() {
                var fixbayar  = parseInt($("#fixbayar").val());
                var bayar = parseInt($("#bayar").val());
                var total = bayar - fixbayar;
               
                $("#kembalian").val(total);
            });
    });
   </script>
<?php 
}
require_once "../footer.php"; ?>