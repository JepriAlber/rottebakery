<?php 
    if (isset($_POST['simpan'])) {
        
        require_once "../config/config.php";
            $nama       = trim(mysqli_escape_string($con,$_POST['nama']));
            $email      = trim(mysqli_escape_string($con,$_POST['email']));
            $password   = sha1(trim(mysqli_escape_string($con,$_POST['password'])));
            $level       = trim(mysqli_escape_string($con,$_POST['level']));

                $cekEmail   = mysqli_query($con,"SELECT email FROM user WHERE email='$email'") or die(mysqli_error($con));
                    if (mysqli_num_rows($cekEmail) > 0) {
                        header('location:add.php');
                        $_SESSION['pesan']		= "Email sudah pernah didaftarkan!";
                        $_SESSION['kondisi']	= "alert-warning";
                    }else{
                        $simpanPengguna = mysqli_query($con,"INSERT INTO user (nama,email,password,level) VALUE ('$nama','$email','$password',$level)");
                            if ($simpanPengguna == TRUE) {
                                header('location:data.php');
                                $_SESSION['pesan']		= "Pengguna berhasil ditambah!";
                                $_SESSION['kondisi']	= "alert-success";
                            } else {
                                header('location:add.php');
                                $_SESSION['pesan']		= "Gagal melakukan penambahan pengguna!";
                                $_SESSION['kondisi']	= "alert-danger";
                            }
                    }
    }elseif(isset($_POST['update'])){
        
    }
?>