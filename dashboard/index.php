<?php 
require_once "../config/config.php";

    if ($_SESSION['level']==0) {
        header('location:../dataproduk/data.php');
    }
?>