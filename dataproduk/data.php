<?php require_once "../header.php"; 
$dataProduk = mysqli_query($con,"SELECT * FROM produk") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataProduk)) {
            $data[]=$dt;
        }

?>
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
    <a href="<?=base_url('dataproduk/add.php');?>" class="btn btn-primary btn-sm mb-3">Tambah Produk</a>
<div class="row">
  <div class="col">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Produk</th>
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
                <td><?=$no;?></td>
                <td><?=$datapro['nama'];?></td>
                <td><?=$datapro['harga'];?>/<?=$datapro['jenis'];?></td>
                <td><?=$datapro['toko'];?></td>
                <td>
                    <a href="">Edit</a>|
                    <a href="">Delete</a>
                </td>
            </tr>
      <?php  }?>
  </tbody>
</table>
  </div>
</div>
</div>
<?php require_once "../footer.php"; ?>