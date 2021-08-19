<?php require_once "config/config.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Rotte</title>
  </head>
  <body>
    <div class="container">
        <?php 
            if ($_SESSION['level']==0) { ?>
              <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="<?=base_url();?>">Rotte</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="#">Produk <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link disabled" href="#">User</a>
                  <a class="nav-item nav-link disabled" href="<?=base_url('auth/logout.php');?>">Logout</a>
                  </div>
              </div>
              </nav>
         <?php   }else{ ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="<?=base_url();?>">Rotte</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                  <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="#">Transaksi <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link disabled" href="#">Logout</a>
                  </div>
              </div>
              </nav>
       <?php  }
        ?>
    </div>

    