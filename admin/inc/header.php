<?php 
$UserID = "-1";
if (isset($_SESSION['UserID'])) {
  $UserID = $_SESSION['UserID'];
}

$query_rsProfil = sprintf("SELECT * FROM tablo_login WHERE UserID = %s", escape($UserID, "int"));
$rsProfil = mysqli_query($Conn, $query_rsProfil) or die(mysqli_error());
$row_rsProfil = mysqli_fetch_assoc($rsProfil);
$totalRows_rsProfil = mysqli_num_rows($rsProfil);

$Unvan = $row_rsProfil['Unvan'];
$Adi = $row_rsProfil['Adi'];
$Soyadi = $row_rsProfil['Soyadi'];
$Resim = $row_rsProfil['Resim'];
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo sayfa("anasayfa") ?>" class="nav-link">Anasayfa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo sayfa("profilim") ?>" class="nav-link">Profilim</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $AdminURL ?>logout.php" class="btn btn-danger">Çıkış Yap</a>
      </li>
    </ul>
     
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="<?php echo $SiteURL ?>">
          <i class="fas fa-home"></i> Siteye Git
        </a>
      </li>
    </ul>
  </nav>
<?php
mysqli_free_result($rsProfil);
?>
