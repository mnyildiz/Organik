<?php 
	
	require("../Connections/Conn.php");
	
if (isset($_POST["EbultenEmail"])) {
	
	$Email = $_POST['EbultenEmail'];
		
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
		die("gecersiz");
	}else{
		
		$query_rsKontrol = sprintf("SELECT * FROM tablo_ebulten WHERE Email = %s", escape($Email, "text"));
		$rsKontrol = mysqli_query($Conn, $query_rsKontrol) or die(mysqli_error($Conn));
		$row_rsKontrol = mysqli_fetch_assoc($rsKontrol);
		$totalRows_rsKontrol = mysqli_num_rows($rsKontrol);
	
		if($totalRows_rsKontrol == 0){
			
		  $insertSQL = sprintf("INSERT INTO tablo_ebulten (Email) VALUES (%s)",
							   escape($Email, "text"));
		  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error($Conn));
		  die($Result1);
		  echo "basarili";
		
		}else{
			
			echo "kayitli"; 
			
		}
	}
	}
?>