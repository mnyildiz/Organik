<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['UrlID'])) && ($_GET['UrlID'] != "") && (isset($_GET['islemsil']))) {
  mysqli_query($Conn, 'DELETE FROM tablo_url_ceviri WHERE UrlID='.(int) $_GET['UrlID']);
  $deleteSQL = sprintf("DELETE FROM tablo_url WHERE UrlID=%s",
                       escape($_GET['UrlID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());

  $Url = $AdminURL."index.php?sayfa=url";	
  yonlendir_($Url);
}


$UrlID = "-1";
if (isset($_GET['UrlID'])) {
  $UrlID = $_GET['UrlID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_url WHERE UrlID = %s", escape($UrlID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
  $insertSQL = sprintf("INSERT INTO tablo_url (Link, Sayfa, Title, `Description`) VALUES (%s, %s, %s, %s)",
                       escape($_POST['Link'], "text"),
                       escape($_POST['Sayfa'], "text"),
                       escape($_POST['Title'], "text"),
                       escape($_POST['Description'], "text"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
  admin_url_cevirilerini_urlid_ile_kaydet(mysqli_insert_id($Conn));
  
  $_SESSION['islemMesaj'] = "Bilgileriniz güncellendi";
  
  $Url = $AdminURL."index.php?sayfa=url";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	
  $updateSQL = sprintf("UPDATE tablo_url SET Link=%s, Sayfa=%s, Title=%s, `Description`=%s WHERE UrlID=%s",
                       escape($_POST['Link'], "text"),
                       escape($_POST['Sayfa'], "text"),
                       escape($_POST['Title'], "text"),
                       escape($_POST['Description'], "text"),
                       escape($_POST['UrlID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  admin_url_cevirilerini_urlid_ile_kaydet($_POST['UrlID']);
  
  $_SESSION['islemMesaj'] = "Bilgileriniz güncellendi";
  
  $Url = $AdminURL."index.php?sayfa=url";	
  yonlendir_($Url);
}
?>
<?php  $SayfaTitle = "SEO Ayarları"; ?>
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
              <div class="card-body">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                      
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Link</label>
                   <div class="col-sm-10">
                     <input name="Link" type="text" required class="form-control" placeholder="Link" value="<?php echo $row_rsDetay['Link']; ?>">
                   </div>
                </div>
                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Sayfa</label>
                  <div class="col-sm-10">
                    <input name="Sayfa" type="text" required class="form-control" placeholder="Sayfa" value="<?php echo $row_rsDetay['Sayfa']; ?>">
                  </div>
                </div>
                      
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Title</label>
                   <div class="col-sm-10">
                     <input name="Title" type="text" required class="form-control" placeholder="Title" value="<?php echo $row_rsDetay['Title']; ?>">
                   </div>
                </div>
                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <input name="Description" type="text" class="form-control" placeholder="Description" value="<?php echo $row_rsDetay['Description']; ?>">
                  </div>
                </div>
                      
                      <?php admin_url_ceviri_sekmeleri(isset($row_rsDetay['Sayfa']) ? $row_rsDetay['Sayfa'] : '', isset($row_rsDetay['ID']) ? $row_rsDetay['ID'] : 0, isset($row_rsDetay['UrlID']) ? $row_rsDetay['UrlID'] : null); ?>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Kaydet</button>
                  </div>
                </div>
                  <?php if ($totalRows_rsDetay>0){ ?>
                      <input type="hidden" name="islem" value="guncelle">
                      <input type="hidden" name="UrlID" value="<?php echo $row_rsDetay['UrlID']; ?>">
                  <?php }else { ?>
                   	  <input type="hidden" name="islem" value="kaydet">
                  <?php }?>
                </form>
<!-- /.tab-pane --><!-- /.tab-pane -->

                  
                <!-- /.tab-pane -->                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
