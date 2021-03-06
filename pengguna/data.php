<?php require_once "../header.php"; 
if (!isset($_SESSION['user']) && !isset($_SESSION['login']) || $_SESSION['level'] !=0) {
  echo "<script>window.location='".base_url('auth/login.php')."'</script>";
}else{
$dataPengguna = mysqli_query($con,"SELECT * FROM user WHERE level !=0") or die(mysqli_error($con));
    $data = [];
        while ($dt=mysqli_fetch_assoc($dataPengguna)) {
            $data[]=$dt;
        }

?>
<div class="container">
    <a href="<?=base_url('pengguna/add.php');?>" class="btn btn-primary btn-sm mt-3 mb-3">Tambah Pengguna</a>
  
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
              Data Pengguna Aplikasi
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="datapengguna">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                      <?php
                      $no=1; 
                      foreach ($data as $dataPeng) { ?>
                          <tr>
                              <td><?=$no++;?></td>
                              <td><?=$dataPeng['nama'];?></td>
                              <td><?=$dataPeng['email'];?></td>
                <?php if ($dataPeng['level']==1) { ?>
                              <td>Super User (Toko A & B)</td>
                 <?php      }elseif($dataPeng['level']==2){ ?>
                               <td>User (Toko A)</td>
                <?php }elseif($dataPeng['level']==3){ ?>
                               <td>User (Toko B)</td>
                <?php } ?>
                              <td align="center">
                                  <a href="transaksi_dilakukan.php?id=<?=$dataPeng['pengguna_id'];?>&nama=<?=$dataPeng['nama'];?>" class="btn btn-primary btn-sm">Transaksi yg Dilakukan</a> |
                                  <a href="edit.php?id=<?=$dataPeng['pengguna_id'];?>" class="btn btn-warning btn-sm">Edit</a> |
                                  <a href="delete.php?id=<?=$dataPeng['pengguna_id'];?>" onclick="return confirm('Apakah yakin hapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
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
          $('#datapengguna').DataTable();
        } );
		</script>
<?php 
}
require_once "../footer.php"; ?>