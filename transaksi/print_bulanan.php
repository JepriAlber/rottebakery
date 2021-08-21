<?php 
require_once "../config/config.php";
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$dataTransaksi = mysqli_query($con,"SELECT * FROM produk ORDER BY toko ASC") or die(mysqli_error($con));
$data = [];
while ($dt=mysqli_fetch_assoc($dataTransaksi)) {
    $data[]=$dt;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media print {
            .jarak {
                clear: both;
                page-break-after: always;
            }
        }
        table.static{
            position: relative;
            border: 1px solid black;
        }
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="jarak">
        <div class="form-group">
            <center><h2>LAPORAN TRANSAKSI BULANAN</h2></center>
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Toko</th>
                        <th>Stok Terjual</th>
                        <th>Total Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $total = 0;
                      $no=1; 
                      foreach ($data as $dataT) { 
                          ?>
                          <tr>
                              <td><?=$no++;?></td>
                              <td><?=$dataT['nama'];?> : <?=rupiah($dataT['harga']);?>/<?=$dataT['jenis'];?></td>
                              <td><?=$dataT['toko'];?></td>
                              <?php 
                               $dataStok = mysqli_query($con,"SELECT SUM(transaksi.stok_terjual) AS stokJ, SUM(transaksi.total_transaksi) AS totalT FROM transaksi,produk WHERE transaksi.produk_id=produk.produk_id AND transaksi.produk_id=$dataT[produk_id] AND produk.toko='$dataT[toko]' AND MONTH(transaksi.waktu)='$bulan' AND YEAR(transaksi.waktu)='$tahun'") or die(mysqli_error($con));
                                $dataS  = mysqli_fetch_assoc($dataStok); 
                                if ($dataS['stokJ'] > 0) { 
                                    echo"<td>$dataS[stokJ]</td>";
                                 }else{
                                    echo"<td>0</td>";
                                }

                                if ($dataS['totalT'] > 0) { 
                                    echo"<td>".rupiah($dataS['totalT'])."</td>";
                                 }else{
                                    echo"<td>0</td>";
                                }
                                $total = $total+$dataS['totalT'];
                              ?>
                              
                          </tr>
                    <?php  }?>
                    <td colspan="4">Total Transaksi Keseluruhan</td>
                    <td><?=rupiah($total);?></td>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>