<?php require_once "config/config.php" ?>
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

    <title>Rotte</title>
  </head>
  <body>
  
        <?php 
            if ($_SESSION['level']==0) { ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="<?=base_url();?>">Rotte Bakery</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                  <a class="nav-item nav-link" href="<?=base_url('dataproduk');?>">Produk <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link" href="<?=base_url('pengguna');?>">Pengguna APP</a>
                  <a class="nav-item nav-link" href="<?=base_url('auth/logout.php');?>">Logout</a>
                  </div>
              </div>
            </nav>
         <?php   }else{ ?>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="<?=base_url();?>">Rotte Bakery</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="#">Transaksi <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link disabled" href="#">User</a>
                  <a class="nav-item nav-link disabled" href="<?=base_url('auth/logout.php');?>">Logout</a>
                  </div>
              </div>
            </nav>
       <?php  }
        ?>


    