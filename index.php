<?php 

	require_once('Connections/Conn.php'); 
	
	require_once('phpInc/iletisim.php');

	$Link = $RouteLink;
	$SayfaKodu = route_sayfa_kodu($Link, $Dil);
	if ($Dil === 'tr') {
		$query_rsUrl = sprintf("SELECT * FROM tablo_url WHERE Link = %s", escape($Link, "text"));
	} elseif ($SayfaKodu) {
		$query_rsUrl = sprintf("SELECT u.*, c.Title AS CeviriTitle, c.Description AS CeviriDescription FROM tablo_url u LEFT JOIN tablo_url_ceviri c ON c.UrlID=u.UrlID AND c.DilKodu=%s AND c.YayinDurumu=1 WHERE u.Sayfa=%s ORDER BY u.UrlID LIMIT 1", escape($Dil, "text"), escape($SayfaKodu, "text"));
	} else {
		$query_rsUrl = sprintf("SELECT u.*, c.Title AS CeviriTitle, c.Description AS CeviriDescription FROM tablo_url_ceviri c INNER JOIN tablo_url u ON u.UrlID=c.UrlID WHERE c.DilKodu=%s AND c.Link=%s AND c.YayinDurumu=1 LIMIT 1", escape($Dil, "text"), escape($Link, "text"));
	}
	$rsUrl = mysqli_query($Conn, $query_rsUrl) or die(mysqli_error());
	$row_rsUrl = mysqli_fetch_assoc($rsUrl);
	$totalRows_rsUrl = mysqli_num_rows($rsUrl);
	
	if($totalRows_rsUrl>0){
		$SayfaKodu = $row_rsUrl['Sayfa'];
		$ID 	= $row_rsUrl['ID'];
		if ($Dil !== 'tr') {
			if (!empty($row_rsUrl['CeviriTitle'])) {
				$row_rsUrl['Title'] = $row_rsUrl['CeviriTitle'];
			}
			if (!empty($row_rsUrl['CeviriDescription'])) {
				$row_rsUrl['Description'] = $row_rsUrl['CeviriDescription'];
			}
		}
	}
	if(isset($SayfaKodu) && is_file('pages/'.$SayfaKodu.'.php')){
		$Sayfa = 'pages/'.$SayfaKodu.'.php';
	}else{
		yonlendir($SiteURL);
	}
?>
<!doctype html>
<html lang="<?php echo htmlspecialchars($Dil, ENT_QUOTES, 'UTF-8'); ?>">
<head>
<meta charset="utf-8">
    <title><?php echo $row_rsUrl['Title']; ?></title>
    <meta name="description" content="<?php echo $row_rsUrl['Description']; ?>">
	<link rel="canonical" href="<?php echo htmlspecialchars(aktif_sayfa_dil_linki($Dil), ENT_QUOTES, 'UTF-8'); ?>">
	<?php foreach ($DesteklenenDiller as $alternatifDil) {
		if (!dil_yayinda($alternatifDil)) continue;
		$alternatifLink = aktif_sayfa_dil_linki($alternatifDil, true);
		if ($alternatifLink) { ?>
	<link rel="alternate" hreflang="<?php echo $alternatifDil ?>" href="<?php echo htmlspecialchars($alternatifLink, ENT_QUOTES, 'UTF-8'); ?>">
	<?php }} ?>
	<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars(aktif_sayfa_dil_linki('tr'), ENT_QUOTES, 'UTF-8'); ?>">
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
	<?php echo popupAlert(t('contact.success_title'),t('contact.success'),"success");?>
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
