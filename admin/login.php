<?php require_once('../Connections/Conn.php'); ?>
<?php 
if (isset($_POST['Email'])) {
  
  $Email = $_POST['Email'];
  $Parola = md5($_POST['Parola']);
	
	$query_rsLogin = sprintf("SELECT * FROM tablo_login WHERE Email = %s AND Parola = %s", escape($Email, "text"),escape($Parola, "text"));
	$rsLogin = mysqli_query($Conn, $query_rsLogin) or die(mysqli_error());
	$row_rsLogin = mysqli_fetch_assoc($rsLogin);
	$totalRows_rsLogin = mysqli_num_rows($rsLogin);
	if($totalRows_rsLogin>0){
		$_SESSION['UserID'] = $row_rsLogin['UserID'];
		mysqli_free_result($rsLogin);
		yonlendir($AdminURL."index.php");
	}else{
		yonlendir($AdminURL."login.php?girisHata=ok");
	}
}
if (isset($_POST['EmailParola'])) {
	
	$Email = $_POST['EmailParola'];
	$YeniParola = rand(100000,999999);

	$query_rsKontrol = sprintf("SELECT * FROM tablo_login WHERE Email = %s", escape($Email, "text"));
	$rsKontrol = mysqli_query($Conn, $query_rsKontrol) or die(mysqli_error());
	$row_rsKontrol = mysqli_fetch_assoc($rsKontrol);
	$totalRows_rsKontrol = mysqli_num_rows($rsKontrol);
	if($totalRows_rsKontrol>0){
		
		$Parola = md5($YeniParola);
	
  		$updateSQL = sprintf("UPDATE tablo_login SET Parola=%s WHERE UserID=%s",
                       escape($Parola, "text"),
                       escape($row_rsKontrol['UserID'], "int"));	
		$Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());		   
		
			$Mesaj 	=	"";
			$Mesaj .=	"Merhaba Sayın  <b>".$row_rsKontrol['Adi']."</b>,<br> Yeni parolanız aşağıdaki gibi oluşturulmuştur.<br><br>";
			$Mesaj .=	"E-mail Adresiniz:  <b>".$row_rsKontrol["Email"]."</b><br>";
			$Mesaj .=	"Yeni Parolanız :  <b>".$YeniParola."</b><br>";
			$Mesaj .=	'Giriş yapmak için <a href="'.$AdminURL.'login.php" target="_blank">tıklayın</a>';
			
			$kime		=	$row_rsKontrol["Email"];
			$kime_isim	=	"Organikik.com";
			$konu		= 	"Parola Hatirlatma";
			
			mailGonder($kime,$kime_isim,$konu,$Mesaj);			   
					   
					   	
		yonlendir($AdminURL."login.php?parolaGonderildi=ok");
		
	}else{
		yonlendir($AdminURL."login.php?parolaGonderHata=ok");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Giriş Ekranı</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once('css_js/css.php'); ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Yönetim</b> Paneli</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      	
	<?php if (isset($_GET["girisHata"])){ ?>
    <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Hata!</b> Giriş yapılamadı. Bilgilerinizi kontrol edip tekrar deneyiniz.
            </div>
    <?php } ?>
    <?php if (isset($_GET["parolaGonderHata"])){ ?>
    <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Hata!</b> E-mail adresiniz bulunamadı.
            </div>
    <?php } ?>
    <?php if (isset($_GET["parolaGonderildi"])){ ?>
    <div class="alert alert-success alert-dismissable">
                <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Başarılı!</b> Parolanız e-mail adresinize gönderilmiştir. Lütfen e-posta kutunuzu kontrol ediniz.
            </div>
    <?php } ?>
    
    
     <?php if (isset($_GET["parolaGonder"])){?>  
     <p class="login-box-msg">Lütfen kayıtlı e-mail adresinizi giriniz.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input name="EmailParola" required type="email" class="form-control" id="EmailParola" placeholder="Email Adresiniz Giriniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Parolamı Gönder</button>
          </div>
        </div>
        </form>
        
        <br>
            <br>
            
            <div class="social-auth-links text-center mb-3">
            <p><a href="login.php">Giriş Yapın</a></p>
        
        <?php }else { ?>
        <p class="login-box-msg">Lütfen giriş yapın.</p>
        	<form action="" method="post">
        <div class="input-group mb-3">
          <input name="Email" required type="email" class="form-control" id="Email" placeholder="Email Adresiniz Giriniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
       
        <div class="input-group mb-3">
          <input name="Parola" required type="password" class="form-control" id="Parola" placeholder="Parolanızı Giriniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
        </div>
        </form>
        
            <br>
            <br>
            
            <div class="social-auth-links text-center mb-3">
            <p><a href="login.php?parolaGonder=ok">Parolamı Unuttum?</a></p>
        
        <?php }?>
      

        
      </div>
    
    </div>
  </div>
</div>
<?php require_once('css_js/js.php'); ?>
</body>
</html>
