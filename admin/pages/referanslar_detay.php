<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  $deleteSQL = sprintf("DELETE FROM tablo_referanslar WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error());

  $Url = $AdminURL."index.php?sayfa=referanslar";	
  yonlendir_($Url);
}


$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_referanslar WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
 		
  $insertSQL = sprintf("INSERT INTO tablo_referanslar (Resim, Resim2, Baslik, SiraNo) VALUES (%s, %s, %s, %s)",
                        escape($Resim, "text"),
						escape($Resim2, "text"),
                        escape($_POST['Baslik'], "text"),
                        escape($_POST['SiraNo'], "int"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error());
    
  $Url = $AdminURL."index.php?sayfa=referanslar";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	
	$Resim = upload("../uploads/","Resim","ResimEski");
	$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
 	
  $updateSQL = sprintf("UPDATE tablo_referanslar SET Resim=%s, Resim2=%s, Baslik=%s, SiraNo=%s WHERE ID=%s",
                       escape($Resim, "text"),
					   escape($Resim2, "text"),
                       escape($_POST['Baslik'], "text"),
                       escape($_POST['SiraNo'], "int"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
    
  $Url = $AdminURL."index.php?sayfa=referanslar";	
  yonlendir_($Url);
}
?>
<?php  $SayfaTitle = "Referanslar"; ?>
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
                        <label class="col-sm-2 col-form-label">Resim 1</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim" id="Resim">
                                	<label class="custom-file-label" for="Resim">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Resim 2</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim2" id="Resim2">
                                	<label class="custom-file-label" for="Resim2">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Başlık</label>
                        <div class="col-sm-10">
                          <input name="Baslik" type="text" class="form-control" placeholder="Baslik" value="<?php echo $row_rsDetay['Baslik']; ?>">
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
                        <input type="hidden" name="Resim2Eski" value="<?php echo $row_rsDetay['Resim2']; ?>">
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