<?php 
require_once('../../Connections/Conn.php');
if ($_FILES['Resimmm']['name']) {
	if (!$_FILES['Resimmm']['error']) {
		$Resimmm = rand(10000,999999)."_".$_FILES["Resimmm"]["name"];
		move_uploaded_file($_FILES["Resimmm"]["tmp_name"],"../../uploads/".$Resimmm);
		echo $SiteURL.'uploads/' . $Resimmm;
	}else{
	  echo  'Dosya yukleme hatası:  '.$_FILES['Resimmm']['error'];
	}
}
?>