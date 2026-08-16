<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  $deleteSQL = sprintf("DELETE FROM tablo_danismanlar WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());
  admin_cevirileri_sil('danismanlar', $_GET['ID']);
  seoURLSil("danismanlar_detay",$_GET['ID']);
  $Url = $AdminURL."index.php?sayfa=danismanlar";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
				
  $insertSQL = sprintf("INSERT INTO tablo_danismanlar SET Resim=%s, Baslik=%s, Unvan=%s, Veri1=%s, Veri2=%s, Veri3=%s, Veri4=%s, Veri5=%s, Veri6=%s, SiraNo=%s",
                       escape($Resim, "text"),
                       escape($_POST['Baslik'], "text"),
                       escape($_POST['Unvan'], "text"),
                       escape($_POST['Veri1'], "text"),
                       escape($_POST['Veri2'], "text"),
					   escape($_POST['Veri3'], "text"),
					   escape($_POST['Veri4'], "text"),
					   escape($_POST['Veri5'], "text"),
					   escape($_POST['Veri6'], "text"),
                        escape($_POST['SiraNo'], "int"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
  
  $kayitID = mysqli_insert_id($Conn);
  seoURLKaydet("danismanlar_detay",$kayitID,$_POST['Baslik'],$_POST['Description']);
  admin_cevirileri_kaydet('danismanlar', $kayitID);
  admin_url_cevirilerini_kaydet('danismanlar_detay', $kayitID);
    
  $Url = $AdminURL."index.php?sayfa=danismanlar";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
		
  $updateSQL = sprintf("UPDATE tablo_danismanlar SET Resim=%s, Baslik=%s, Unvan=%s, Veri1=%s, Veri2=%s, Veri3=%s, Veri4=%s, Veri5=%s, Veri6=%s, SiraNo=%s WHERE ID=%s",
                       escape($Resim, "text"),
                       escape($_POST['Baslik'], "text"),
                       escape($_POST['Unvan'], "text"),
                       escape($_POST['Veri1'], "text"),
                       escape($_POST['Veri2'], "text"),
					   escape($_POST['Veri3'], "text"),
					   escape($_POST['Veri4'], "text"),
					   escape($_POST['Veri5'], "text"),
					   escape($_POST['Veri6'], "text"),
                        escape($_POST['SiraNo'], "int"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  
  seoURLKaydet("danismanlar_detay",$_POST['ID'],$_POST['Baslik'],$_POST['Description']); 
  admin_cevirileri_kaydet('danismanlar', $_POST['ID']);
  admin_url_cevirilerini_kaydet('danismanlar_detay', $_POST['ID']);
   
    
  $Url = $AdminURL."index.php?sayfa=danismanlar";	
  yonlendir_($Url);
}

$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_danismanlar WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

$query_rsSeo = sprintf("SELECT * FROM tablo_url WHERE Sayfa = 'danismanlar_detay' AND ID = %s", escape($ID, "int"));
$rsSeo = mysqli_query($Conn, $query_rsSeo) or die(mysqli_error());
$row_rsSeo = mysqli_fetch_assoc($rsSeo);
$totalRows_rsSeo = mysqli_num_rows($rsSeo);
?>
<?php  $SayfaTitle = "Danışmanlar"; ?>
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
              <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="bilgilerim">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                      
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Resim</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim" id="Resim">
                                	<label class="custom-file-label" for="Resim">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                     
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Adı Soyadı</label>
                        <div class="col-sm-10">
                          <input name="Baslik" type="text" required class="form-control" value="<?php echo $row_rsDetay['Baslik']; ?>">
                        </div>
                      </div>
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unvan</label>
                        <div class="col-sm-10">
                          <input name="Unvan" type="text" required class="form-control" value="<?php echo $row_rsDetay['Unvan']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telefon</label>
                        <div class="col-sm-10">
                          <input name="Veri1" type="text" class="form-control" value="<?php echo $row_rsDetay['Veri1']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input name="Veri2" type="text" class="form-control" value="<?php echo $row_rsDetay['Veri2']; ?>">
                        </div>
                      </div>
                       
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Eğitim</label>
                        <div class="col-sm-10">
                          <textarea name="Veri3" class="form-control editor"><?php echo $row_rsDetay['Veri3']; ?></textarea>
                        </div>
                      </div>
                      
                  
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sertifikalar</label>
                        <div class="col-sm-10">
                          <textarea name="Veri4" class="form-control editor"><?php echo $row_rsDetay['Veri4']; ?></textarea>
                        </div>
                      </div>
                      
                     
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Uzmanlık Alanları</label>
                        <div class="col-sm-10">
                          <textarea name="Veri5" class="form-control editor"><?php echo $row_rsDetay['Veri5']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Yer Aldığı Projeler</label>
                        <div class="col-sm-10">
                          <textarea name="Veri6" class="form-control editor"><?php echo $row_rsDetay['Veri6']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SiraNo</label>
                        <div class="col-sm-10">
                          <input name="SiraNo" type="text" class="form-control" placeholder="SiraNo" value="<?php echo $row_rsDetay['SiraNo']; ?>">
                        </div>
                      </div>
                      
                      <?php admin_ceviri_sekmeleri('danismanlar', $ID, array(
                        'Baslik' => 'Adı Soyadı',
                        'Unvan' => 'Unvan',
                        'Veri1' => 'Telefon',
                        'Veri2' => 'E-posta',
                        'Veri3' => array('Eğitim', 'editor'),
                        'Veri4' => array('Sertifikalar', 'editor'),
                        'Veri5' => array('Uzmanlık Alanları', 'editor'),
                        'Veri6' => array('Yer Aldığı Projeler', 'editor')
                      ), 'danismanlar_detay'); ?>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Kaydet</button>
                        </div>
                      </div>
                        <?php if ($totalRows_rsDetay>0){ ?>
                            <input type="hidden" name="islem" value="guncelle">
                        <?php }else { ?>
                        	<input type="hidden" name="islem" value="kaydet">
                        <?php }?>
                        <input type="hidden" name="ID" value="<?php echo $row_rsDetay['ID']; ?>">
                        <input type="hidden" name="ResimEski" value="<?php echo $row_rsDetay['Resim']; ?>">
                        
                        <input type="hidden" name="Link" value="<?php echo $row_rsDetay['Link']; ?>">
                    </form>
                  </div>
                <!-- /.tab-pane --><!-- /.tab-pane -->

                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
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
