<?php  
    require_once "config/config.php";
    if (isset($_SESSION['user']) && isset($_SESSION['login'])) {
        echo "<script>window.location='".base_url('dashboard')."'</script>";
    }else{
       echo "<script>window.location='".base_url('auth/login.php')."'</script>";
    }
?>