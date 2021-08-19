<?php  
	if (isset($_GET['id'])) {
		require_once "../config/config.php";
		$id 		= $_GET['id'];
		$result 	= mysqli_query($con,"DELETE FROM produk WHERE produk_id =$id")or die (mysqli_error($con));
			if ($result == TRUE) {
				header('location:data.php');
				$_SESSION['pesan']		= "Data berhasil dihapus!";
				$_SESSION['kondisi']	= "alert-success";
			}else{
				header('location:data.php');
				$_SESSION['pesan']		= "Data gagal dihapus!";
				$_SESSION['kondisi']	= "alert-danger";
			}
	}
?>