<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  $deleteSQL = sprintf("DELETE FROM tablo_iletisim WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());

  $Url = $AdminURL."index.php?sayfa=iletisim_mesajlari";	
  yonlendir_($Url);
}


$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_iletisim WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

if ($totalRows_rsDetay>0) {	
  $updateSQL = sprintf("UPDATE tablo_iletisim SET Okundu=%s WHERE ID=%s",
                       escape("1", "text"),
                       escape($row_rsDetay['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
}
?>
<?php  $SayfaTitle = "İletişim Mesajları"; ?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $SayfaTitle ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo sayfa("anasayfa") ?>">Anasayfa</a></li>
              <li class="breadcrumb-item active"><?php echo $SayfaTitle ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><?php echo $SayfaTitle ?></h3>

              
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
    <h5>Adı Soyadı: <?php echo $row_rsDetay['AdiSoyadi']; ?></h5>
    <h6>Telefon: <?php echo $row_rsDetay['Telefon']; ?></h6>
    <h6>E-mail: <?php echo $row_rsDetay['Email']; ?>
    <span class="mailbox-read-time float-right"><?php echo tarih($row_rsDetay['KayitTarihi']); ?></span></h6>
                  
              </div>
              <div class="mailbox-read-message">
                <p><?php echo $row_rsDetay['Mesaj']; ?></p>
              </div>
            </div>
            <div class="card-footer">
              
              <a href="<?php echo sayfa("iletisim_mesajlari_detay") ?>&ID=<?php echo $row_rsDetay['ID']; ?>&islemsil=ok" onClick="return confirm('Emin msiniz?')" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i> Sil</a>
              
              <a href="<?php echo sayfa("iletisim_mesajlari") ?>" class="btn btn-sm btn-default"><i class="fas fa-reply"></i> Geri Dön</a>
              
              
            </div>
          </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>