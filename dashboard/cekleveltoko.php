<?php require_once "../config/config.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>" >
    <link rel="stylesheet" href="<?=base_url('assets/datatables/jquery.dataTables.min.css');?>" >
    <script src="<?=base_url('assets/js/jquery.js');?>"></script> 

    <title>RotteBakery</title>
  </head>
  <body>

    <div class="container" style="margin-top: 200px;">
       <center> <h4>Akun anda bisa mengakses beberapa toko, pilih toko yang mau diakses sekarang!</h4></center>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="proses.php" method="POST">
                <center>
                        <button style="width: 30%;height:100px" value="2" class="btn btn-outline-primary" name="toko" onclick="return confirm('Apakah anda yakin?')">Toko A</button> 
                        <button style="width: 30%;height:100px" value="3" class="btn btn-outline-primary" name="toko" onclick="return confirm('Apakah anda yakin?')">Toko B</button> 
                </center>
                </form>
            </div>
        </div>
    </div>

    
    <script src="<?=base_url('assets/js/popper.min.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>
    
  </body>
</html>