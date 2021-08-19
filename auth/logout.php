<?php  
require_once "../config/config.php";
	
	unset($_SESSION['user']);
	unset($_SESSION['login']);
	session_unset();
	session_destroy();
	echo "<script>window.location='".base_url('auth/login.php')."'</script>";
?>