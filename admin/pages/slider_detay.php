<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  $deleteSQL = sprintf("DELETE FROM tablo_slider WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());

  $Url = $AdminURL."index.php?sayfa=slider";	
  yonlendir_($Url);
}


$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_slider WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	//$Icon = upload("../uploads/","Icon","IconEski");
		
  $insertSQL = sprintf("INSERT INTO tablo_slider (Resim, Detay, Baslik, Baslik2, Link, SiraNo) VALUES (%s, %s, %s, %s, %s, %s)",
                       escape($Resim, "text"),
					   escape($_POST['Detay'], "text"),
                       escape($_POST['Baslik'], "text"),
					   escape($_POST['Baslik2'], "text"),
					   escape($_POST['Link'], "text"),
                       escape($_POST['SiraNo'], "int"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
    
  $Url = $AdminURL."index.php?sayfa=slider";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	//$Icon = upload("../uploads/","Icon","IconEski");
	
  $updateSQL = sprintf("UPDATE tablo_slider SET Resim=%s, Detay=%s, Baslik=%s, Baslik2=%s, Link=%s, SiraNo=%s WHERE ID=%s",
                       escape($Resim, "text"),
					   escape($_POST['Detay'], "text"),
                       escape($_POST['Baslik'], "text"),
					   escape($_POST['Baslik2'], "text"),
					   escape($_POST['Link'], "text"),
                       escape($_POST['SiraNo'], "int"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
    
  $Url = $AdminURL."index.php?sayfa=slider";	
  yonlendir_($Url);
}
?>
<?php  $SayfaTitle = "Slayt Gösterisi"; ?>
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
                      
                     <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Icon" id="Icon">
                                	<label class="custom-file-label" for="Icon">Icon Seç</label>
                                </div>
                        </div>
                      </div> -->
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Başlık 1</label>
                        <div class="col-sm-10">
                          <input name="Baslik" type="text" required class="form-control" placeholder="Baslik" value="<?php echo $row_rsDetay['Baslik']; ?>">
                        </div>
                      </div>
                      
                      <!--<div class="form-group row">
                        <label class="col-sm-2 col-form-label">Başlık 2</label>
                        <div class="col-sm-10">
                          <input name="Baslik2" type="text" required class="form-control" placeholder="Baslik 2" value="<?php echo $row_rsDetay['Baslik2']; ?>">
                        </div>
                      </div> -->
                      
                     <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Detay</label>
                        <div class="col-sm-10">
                          <input name="Detay" type="text" required class="form-control" placeholder="Detay" value="<?php echo $row_rsDetay['Detay']; ?>">
                        </div>
                      </div> -->
                      
                  
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input name="Link" type="text" class="form-control" placeholder="Link" value="<?php echo $row_rsDetay['Link']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">SiraNo</label>
                        <div class="col-sm-10">
                          <input name="SiraNo" type="text" class="form-control" placeholder="SiraNo" value="<?php echo $row_rsDetay['SiraNo']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Kaydet</button>
                        </div>
                      </div>
                        <?php if ($totalRows_rsDetay>0){ ?>
                            <input type="hidden" name="islem" value="guncelle">
                            <input type="hidden" name="ID" value="<?php echo $row_rsDetay['ID']; ?>">
                            
                        <?php }else { ?>
                        	<input type="hidden" name="islem" value="kaydet">
                            
                        <?php }?>
                        <input type="hidden" name="ResimEski" value="<?php echo $row_rsDetay['Resim']; ?>">
                            <input type="hidden" name="IconEski" value="<?php echo $row_rsDetay['Icon']; ?>">
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