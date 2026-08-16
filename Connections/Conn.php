<?php
	error_reporting(0);
	
	if(!isset($_SESSION)){
		session_start();	
	}
	
	$hostname_Conn = "localhost";
	$database_Conn = "organik";
	$username_Conn = "root";
	$password_Conn = "1qaz.2021";
	$Conn = mysqli_connect($hostname_Conn, $username_Conn, $password_Conn, $database_Conn) or die(mysqli_connect_error()); 
 	
	mysqli_set_charset($Conn, "utf8");
	
	
	
	$AdminURL = "https://www.organikik.com.tr/admin/";
	$SiteURL = "https://www.organikik.com.tr/";
	$DOCUMENT_ROOT = "C:/WebSites/organik/";

	require_once(__DIR__.'/i18n.php');
	
	include('fn.php');
?>
