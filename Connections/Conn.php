<?php
	// ------------------------------------------------------------
	// TEST MODU ANAHTARI
	// Connections/TEST_ORTAMI adinda bos bir dosya varsa site test
	// modunda calisir. Canli sunucuda bu dosya OLMAMALIDIR.
	// ------------------------------------------------------------
	$isTest = is_file(__DIR__.'/TEST_ORTAMI');

	if(!isset($_SESSION)){
		session_start();	
	}

	if($isTest){
		// Test: hatalari ekranda goster
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		// Test: arama motorlari indekslemesin
		header('X-Robots-Tag: noindex, nofollow');

		// Test veritabani (canli DB'ye ASLA baglanmaz)
		// 127.0.0.1: Windows'ta "localhost" once IPv6 denedigi icin yavaslatabilir
		$hostname_Conn = "127.0.0.1";
		$database_Conn = "organik_staging";
		$username_Conn = "organik_test";
		$password_Conn = "TEST_PAROLASI_BURAYA";

		// Test adresi: tarayicidaki host + port neyse onu kullanir
		// (orn. http://www.organikik.com.tr:8081/)
		$testHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		$testScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
		$SiteURL = $testScheme."://".$testHost."/";
		$AdminURL = $SiteURL."admin/";
		$DOCUMENT_ROOT = str_replace('\\', '/', dirname(__DIR__)).'/';
	}else{
		error_reporting(0);

		$hostname_Conn = "localhost";
		$database_Conn = "organik";
		$username_Conn = "root";
		$password_Conn = "1qaz.2021";

		$AdminURL = "https://www.organikik.com.tr/admin/";
		$SiteURL = "https://www.organikik.com.tr/";
		$DOCUMENT_ROOT = "C:/WebSites/organik/";
	}

	$Conn = mysqli_connect($hostname_Conn, $username_Conn, $password_Conn, $database_Conn) or die(mysqli_connect_error()); 
 	
	mysqli_set_charset($Conn, "utf8");

	require_once(__DIR__.'/i18n.php');
	
	include('fn.php');
?>
