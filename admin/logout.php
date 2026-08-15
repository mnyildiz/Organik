<?php require_once('../Connections/Conn.php'); ?>
<?php 
		$_SESSION['UserID'] = NULL;
		unset($_SESSION['UserID']);
		yonlendir($AdminURL."login.php");

?>