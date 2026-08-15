<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  $deleteSQL = sprintf("DELETE FROM tablo_hizmetler WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());
  seoURLSil("hizmetler_detay",$_GET['ID']);
  $Url = $AdminURL."index.php?sayfa=hizmetler";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	$ResimBuyuk = upload("../uploads/","ResimBuyuk","ResimBuyukEski");
	$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
	$Resim3 = upload("../uploads/","Resim3","Resim3Eski");
	$Resim2Hover = upload("../uploads/","Resim2Hover","Resim2HoverEski");
				
  $insertSQL = sprintf("INSERT INTO tablo_hizmetler SET Resim=%s, ResimBuyuk=%s, Resim2=%s, Resim3=%s, Resim2Hover=%s, Baslik=%s, Baslik2=%s, Veri1=%s, Veri2=%s, Veri3=%s, Veri4=%s, Veri5=%s, Veri6=%s, Veri7=%s, Veri8=%s, Veri9=%s, Veri10=%s, Veri11=%s, Veri12=%s, BaslikTab1=%s, BaslikTab2=%s, BaslikTab3=%s, BaslikTab4=%s, BaslikTab5=%s, SiraNo=%s",
                       escape($Resim, "text"),
					   escape($ResimBuyuk, "text"),
					   escape($Resim2, "text"),
					   escape($Resim3, "text"),
					   escape($Resim2Hover, "text"),
                       escape($_POST['Baslik'], "text"),
					   escape($_POST['Baslik2'], "text"),
                       escape($_POST['Veri1'], "text"),
                       escape($_POST['Veri2'], "text"),
					   escape($_POST['Veri3'], "text"),
					   escape($_POST['Veri4'], "text"),
					   escape($_POST['Veri5'], "text"),
					   escape($_POST['Veri6'], "text"),
					   escape($_POST['Veri7'], "text"),
					   escape($_POST['Veri8'], "text"),
					   escape($_POST['Veri9'], "text"),
					   escape($_POST['Veri10'], "text"),
					   escape($_POST['Veri11'], "text"),
					   escape($_POST['Veri12'], "text"),
					   escape($_POST['BaslikTab1'], "text"),
					   escape($_POST['BaslikTab2'], "text"),
					   escape($_POST['BaslikTab3'], "text"),
					   escape($_POST['BaslikTab4'], "text"),
					   escape($_POST['BaslikTab5'], "text"),
                       escape($_POST['SiraNo'], "int"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
  
  seoURLKaydet("hizmetler_detay",mysqli_insert_id($Conn),$_POST['Baslik'],$_POST['Description']);
    
  $Url = $AdminURL."index.php?sayfa=hizmetler";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	$ResimBuyuk = upload("../uploads/","ResimBuyuk","ResimBuyukEski");
	$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
	$Resim3 = upload("../uploads/","Resim3","Resim3Eski");
	$Resim2Hover = upload("../uploads/","Resim2Hover","Resim2HoverEski");
	
	$updateSQL = sprintf("UPDATE tablo_hizmetler SET Resim=%s, ResimBuyuk=%s, Resim2=%s, Resim3=%s, Resim2Hover=%s, Baslik=%s, Baslik2=%s, Veri1=%s, Veri2=%s, Veri3=%s, Veri4=%s, Veri5=%s, Veri6=%s, Veri7=%s, Veri8=%s, Veri9=%s, Veri10=%s, Veri11=%s, Veri12=%s, BaslikTab1=%s, BaslikTab2=%s, BaslikTab3=%s, BaslikTab4=%s, BaslikTab5=%s, SiraNo=%s WHERE ID=%s",
                       escape($Resim, "text"),
					   escape($ResimBuyuk, "text"),
					   escape($Resim2, "text"),
					   escape($Resim3, "text"),
					   escape($Resim2Hover, "text"),
                       escape($_POST['Baslik'], "text"),
					   escape($_POST['Baslik2'], "text"),
                       escape($_POST['Veri1'], "text"),
                       escape($_POST['Veri2'], "text"),
					   escape($_POST['Veri3'], "text"),
					   escape($_POST['Veri4'], "text"),
					   escape($_POST['Veri5'], "text"),
					   escape($_POST['Veri6'], "text"),
					   escape($_POST['Veri7'], "text"),
					   escape($_POST['Veri8'], "text"),
					   escape($_POST['Veri9'], "text"),
					   escape($_POST['Veri10'], "text"),
					   escape($_POST['Veri11'], "text"),
					   escape($_POST['Veri12'], "text"),
					   escape($_POST['BaslikTab1'], "text"),
					   escape($_POST['BaslikTab2'], "text"),
					   escape($_POST['BaslikTab3'], "text"),
					   escape($_POST['BaslikTab4'], "text"),
					   escape($_POST['BaslikTab5'], "text"),	
                       escape($_POST['SiraNo'], "int"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  
  seoURLKaydet("hizmetler_detay",$_POST['ID'],$_POST['Baslik'],$_POST['Description']); 
   
    
  $Url = $AdminURL."index.php?sayfa=hizmetler";	
  yonlendir_($Url);
}

$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_hizmetler WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

$query_rsSeo = sprintf("SELECT * FROM tablo_url WHERE Sayfa = 'hizmetler-detay' AND ID = %s", escape($ID, "int"));
$rsSeo = mysqli_query($Conn, $query_rsSeo) or die(mysqli_error());
$row_rsSeo = mysqli_fetch_assoc($rsSeo);
$totalRows_rsSeo = mysqli_num_rows($rsSeo);
?>
<?php  $SayfaTitle = "Hizmetler"; ?>
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
                        <label class="col-sm-2 col-form-label">Liste Resim</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim" id="Resim">
                                	<label class="custom-file-label" for="Resim">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Detay Resim 1</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="ResimBuyuk" id="ResimBuyuk">
                                	<label class="custom-file-label" for="ResimBuyuk">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Detay Resim 2</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim3" id="Resim3">
                                	<label class="custom-file-label" for="Resim3">Resin Seç</label>
                                </div>
                        </div>
                      </div>
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Icon</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim2" id="Resim2">
                                	<label class="custom-file-label" for="Resim2">İcon Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Icon Hover</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim2Hover" id="Resim2Hover">
                                	<label class="custom-file-label" for="Resim2Hover">İcon Hover Seç</label>
                                </div>
                        </div>
                      </div>
                     
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Başlık</label>
                        <div class="col-sm-10">
                          <input name="Baslik" type="text" required class="form-control" value="<?php echo $row_rsDetay['Baslik']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Başlık 2</label>
                        <div class="col-sm-10">
                          <input name="Baslik2" type="text" required class="form-control" value="<?php echo $row_rsDetay['Baslik2']; ?>">
                        </div>
                      </div>
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SiraNo</label>
                        <div class="col-sm-10">
                          <input name="SiraNo" type="text" class="form-control" placeholder="SiraNo" value="<?php echo $row_rsDetay['SiraNo']; ?>">
                        </div>
                      </div>
                   <?php for($i=1;$i<=7;$i++){?>   
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kutu <?php echo $i ?></label>
                        <div class="col-sm-10">
                          <textarea name="Veri<?php echo $i ?>" class="form-control editor"><?php echo $row_rsDetay['Veri'.$i]; ?></textarea>
                        </div>
                      </div>
                      <?php }?>
                      
                      <?php for($i=8;$i<=12;$i++){?>   
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tab <?php echo $i-7 ?> Başlık</label>
                        <div class="col-sm-10">
                          <input name="BaslikTab<?php echo $i-7 ?>" type="text" class="form-control" value="<?php echo $row_rsDetay['BaslikTab'.($i-7)]; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tab <?php echo $i-7 ?> İçerik</label>
                        <div class="col-sm-10">
                          <textarea name="Veri<?php echo $i ?>" class="form-control editor"><?php echo $row_rsDetay['Veri'.$i]; ?></textarea>
                        </div>
                      </div>
                      <?php }?>
                       
                      
                      
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
                        <input type="hidden" name="ResimBuyukEski" value="<?php echo $row_rsDetay['ResimBuyuk']; ?>">
                        <input type="hidden" name="Resim2Eski" value="<?php echo $row_rsDetay['Resim2']; ?>">
                        <input type="hidden" name="Resim3Eski" value="<?php echo $row_rsDetay['Resim3']; ?>">
                        <input type="hidden" name="Resim2HoverEski" value="<?php echo $row_rsDetay['Resim2Hover']; ?>">
                        
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