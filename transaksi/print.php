<?php 
require_once "../config/config.php";
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
$toko = $_POST['toko'];
$dataTransaksi = mysqli_query($con,"SELECT produk.nama,transaksi.* FROM produk,transaksi WHERE produk.produk_id=transaksi.produk_id AND produk.toko='$toko' AND waktu between '".$dari."' and '".$sampai."' ORDER BY transaksi.waktu DESC") or die(mysqli_error($con));

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
            <table class="static" align="center" rules="all" border="1px" style="width:95%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Stok Terjual</th>
                        <th>Transaksi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      $no=1; 
                      foreach ($dataTransaksi as $dataT) { ?>
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
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>