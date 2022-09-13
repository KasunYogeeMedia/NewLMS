<?php
session_start();
if(!isset($_SESSION['reid'])){
	header('location:http://yogeemedia.xyz/websites/atlas-lms/');
	exit();
}

$fullname = $_SESSION['fullname'];
$contactnumber = $_SESSION['contactnumber'];

?>