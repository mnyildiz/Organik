<?php 

	require_once('Connections/Conn.php'); 
	
	require_once('phpInc/iletisim.php');

	$Link = "anasayfa";
	if (isset($_GET['Link'])) {
	  $Link = $_GET['Link'];
	}
	$query_rsUrl = sprintf("SELECT * FROM tablo_url WHERE Link = %s", escape($Link, "text"));
	$rsUrl = mysqli_query($Conn, $query_rsUrl) or die(mysqli_error());
	$row_rsUrl = mysqli_fetch_assoc($rsUrl);
	$totalRows_rsUrl = mysqli_num_rows($rsUrl);
	
	if($totalRows_rsUrl>0){
		$Sayfa  = $row_rsUrl['Sayfa'];
		$ID 	= $row_rsUrl['ID'];
	}
	if(is_file('pages/'.$Sayfa.'.php')){
		$Sayfa = 'pages/'.$Sayfa.'.php';
	}else{
		yonlendir($SiteURL);
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title><?php echo $row_rsUrl['Title']; ?></title>
    <meta name="description" content="<?php echo $row_rsUrl['Description']; ?>">
   	<?php require_once('inc/css.php'); ?>
    <?php echo $row_rsAyar['Metalar']; ?>
</head>
<body>
   <?php require_once('inc/header.php'); ?>
    <main>
   		<?php include $Sayfa;?>
   </main>
   <?php require_once('inc/footer.php'); ?>
   <?php require_once('inc/js.php'); ?>
   <?php if (isset($_GET["iletisim"])){ ?>  
    <script>
	<?php echo popupAlert("Başarılı","Mesajınız Alınmıştır. En kısa zamanda sizinle iletişime geçeceğiz.","success");?>
 </script>
	<?php }?>
	
	
	
	<script>
    
           if (document.documentElement.clientWidth > 1023) {
            $(document).ready(function () {
                var initScrollTop = $(window).scrollTop();
                $(window).scroll(function () {
                    var scrollTop = $(window).scrollTop();
                    $("#parallax1").css({'margin-top': (-scrollTop / 75) + '%'});
                });
            });

        }
    
    </script>
</body>
</html>