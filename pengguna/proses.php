<?php 
    if (isset($_POST['simpan'])) {
        
        require_once "../config/config.php";
            $nama       = ucwords(trim(mysqli_escape_string($con,$_POST['nama'])));
            $email      = strtolower(trim(mysqli_escape_string($con,$_POST['email'])));
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
        
        require_once "../config/config.php";
        $pengguna_id    = trim(mysqli_escape_string($con,$_POST['pengguna_id']));
        $nama           = ucwords(trim(mysqli_escape_string($con,$_POST['nama'])));
        $email          = strtolower(trim(mysqli_escape_string($con,$_POST['email'])));
        $level          = trim(mysqli_escape_string($con,$_POST['level']));
            
            if ($_POST['password']==null) {
                $updatePeng = mysqli_query($con,"UPDATE user SET nama='$nama', email='$email',level=$level WHERE pengguna_id =$pengguna_id ") or die(mysqli_error($con));
                    if ($updatePeng == TRUE) {
                        header('location:data.php');
                        $_SESSION['pesan']		= "Data Pengguna berhasil diubah!";
                        $_SESSION['kondisi']	= "alert-success";
                    } else {
                        header('location:add.php');
                        $_SESSION['pesan']		= "Gagal melakukan perubahan data pengguna!";
                        $_SESSION['kondisi']	= "alert-danger";
                    }
            }else{
                $password   = sha1(trim(mysqli_escape_string($con,$_POST['password'])));
                $updatePeng2 = mysqli_query($con,"UPDATE user SET nama='$nama', email='$email',level=$level,password='$password' WHERE pengguna_id =$pengguna_id") or die(mysqli_error($con));
                    if ($updatePeng2 == TRUE) {
                        header('location:data.php');
                        $_SESSION['pesan']		= "Data Pengguna berhasil diubah!";
                        $_SESSION['kondisi']	= "alert-success";
                    } else {
                        header('location:add.php');
                        $_SESSION['pesan']		= "Gagal melakukan perubahan data pengguna!";
                        $_SESSION['kondisi']	= "alert-danger";
                    }

            }
    }else{
        header('location:data.php');
    }
?>