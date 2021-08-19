<?php 
//setting default timezone
date_default_timezone_set('Asia/jakarta'); 
session_start();

include_once "conn.php";

    $con = mysqli_connect($con['host'],$con['user'],$con['pass'],$con['db']);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    function base_url($url = null)
    {
        $base_url = "http://localhost/rottebakery";

            if ($url != null) {
                return $base_url."/".$url;
            }else{
                return $base_url;
            }
    }
    function generate_string($strength) {
        $input          = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length   = strlen($input);
        $random_string  = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[random_int(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        
        return $random_string;
    }
?>