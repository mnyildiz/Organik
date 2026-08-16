<?php 

if ((isset($_POST["islem"])) && ($_POST["islem"] == "iletisimkaydet")) {
	
   $AdiSoyadi = $_POST['AdiSoyadi'] ? $_POST['AdiSoyadi']:"Girilmedi";
   $Telefon = $_POST['Telefon'] ? $_POST['Telefon']:"";
   $Email = $_POST['Email'] ? $_POST['Email']:"Girilmedi";
   $Konu = $_POST['Konu'] ? $_POST['Konu']:"Girilmedi";
   $Mesaj = $_POST['Mesaj'] ? $_POST['Mesaj']:"Girilmedi";
   	
   $insertSQL = sprintf("INSERT INTO tablo_iletisim (AdiSoyadi, Telefon, Email, Konu, Mesaj) VALUES (%s, %s, %s, %s, %s)",
                       escape($AdiSoyadi, "text"),
                       escape($Telefon, "text"),
                       escape($Email, "text"),
                       escape($Konu, "text"),
                       escape($Mesaj, "text"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
  
	
	$Location = sayfa_linki('iletisim')."?iletisim=ok";
  	yonlendir($Location);
}
?>
