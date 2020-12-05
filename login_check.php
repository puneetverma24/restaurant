<?php
session_start();
//$url = "http://theviralplus.com/gondiashop/login.php";
$url = "http://jobsali.website/anil/restaurant/login.php";
//$url = "http://project.test/gondiashop/login.php";
if ($_SESSION['status'] == 'success' ) {
} else {
    header( "Location:" . $url );
    die();
}
?>