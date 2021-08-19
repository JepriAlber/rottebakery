<?php require_once "../config/config.php" ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>" >

    <title>login-RotteBakery</title>
  </head>
  <body>
    <div class="container mt-4">
    <div class="row">
      <div class="col">
        <center><h3>Login</h3></center>
      </div>
    </div>
    <?php  
              if (isset($_POST['login'])) {

                $username       = trim(mysqli_escape_string($con,$_POST['email']));
                $password       = sha1(trim(mysqli_escape_string($con,$_POST['password'])));

                    $data       = mysqli_query($con,"SELECT * FROM user WHERE email='$username' AND password='$password'") or die(mysqli_error($con));
                    $dataUser  = mysqli_fetch_assoc($data);
                   
                     if (mysqli_num_rows($data)>0) {
                       
                            $_SESSION['login']    = true;
                            $_SESSION['user_id']     = $dataUser['pengguna_id'];
                            $_SESSION['user']     = $dataUser['nama'];
                            $_SESSION['level']  = $dataUser['level'];
                            
                            echo "<script>window.location='".base_url()."'</script>";
                        }else { ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Login gagal!</strong> Password/Email Salah!
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                    </div>
                                </div>
                         <?php }
              } 
              
            ?>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=base_url('assets/js/jquery-3.2.1.slim.min.js');?>"></script>
    <script src="<?=base_url('assets/js/popper.min.js');?>"></script>
    <script src="<?=base_url('assetsjs/bootstrap.min.js');?>"></script>
  </body>
</html>