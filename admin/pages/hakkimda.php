<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
  	
	
	//$Resim1 = upload("../uploads/","Resim1","Resim1Eski");
	//$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
	//$Resim3 = upload("../uploads/","Resim3","Resim3Eski");
	//$Resim4 = upload("../uploads/","Resim4","Resim4Eski");
	
	
	$updateSQL = sprintf("UPDATE tablo_metinler SET Metin0=%s, Metin1=%s, Metin2=%s, Metin3=%s, Metin4=%s, Metin5=%s, Metin6=%s, Metin7=%s, Metin8=%s, Metin9=%s, Metin10=%s, Metin11=%s WHERE ID=%s",
                       escape($_POST['Metin0'], "text"),
					   escape($_POST['Metin1'], "text"),
                       escape($_POST['Metin2'], "text"),
                       escape($_POST['Metin3'], "text"),
                       escape($_POST['Metin4'], "text"),
					   escape($_POST['Metin5'], "text"),
					   escape($_POST['Metin6'], "text"),
					   escape($_POST['Metin7'], "text"),
					   escape($_POST['Metin8'], "text"),
					   escape($_POST['Metin9'], "text"),
					   escape($_POST['Metin10'], "text"),
					   escape($_POST['Metin11'], "text"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  
  $_SESSION['islemMesaj'] = "ok";
  
  $Url = $AdminURL."index.php?sayfa=hakkimda";	
  yonlendir_($Url);
}

$query_rsDetay = "SELECT * FROM tablo_metinler";
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error());
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);
?>
<?php $SayfaTitle = "Hakkımızda" ?>
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
    <?php if (isset($_SESSION['islemMesaj'])){ ?> 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Başarılı!</b> Bilgiler güncellendi.
            </div>
          </div>
          
        </div>
      </div>
    </section>
    <?php }?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header p-2">
                <?php echo $SayfaTitle ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                      
                      
                      
                      <!-- -->
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Metin</label>
                        <div class="col-sm-10">
                          <textarea name="Metin0" class="form-control editor"><?php echo $row_rsDetay['Metin0']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Organik Danışmanlık Hizmetleri</label>
                        <div class="col-sm-10">
                          <textarea name="Metin2" class="form-control editor"><?php echo $row_rsDetay['Metin2']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Temel İlkeler</label>
                        <div class="col-sm-10">
                          <textarea name="Metin3" class="form-control editor"><?php echo $row_rsDetay['Metin3']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Entegre Politikamız</label>
                        <div class="col-sm-10">
                          <textarea name="Metin4" class="form-control editor"><?php echo $row_rsDetay['Metin4']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Video Link</label>
                        <div class="col-sm-10">
                          <input name="Metin1" type="text" class="form-control" value="<?php echo $row_rsDetay['Metin1']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Haberler Sayfası Slogan 1</label>
                        <div class="col-sm-10">
                          <textarea name="Metin5" class="form-control editor"><?php echo $row_rsDetay['Metin5']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Haberler Sayfası Slogan 2</label>
                        <div class="col-sm-10">
                          <textarea name="Metin6" class="form-control editor"><?php echo $row_rsDetay['Metin6']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danışmanlar Sayfası Slogan 1</label>
                        <div class="col-sm-10">
                          <textarea name="Metin7" class="form-control editor"><?php echo $row_rsDetay['Metin7']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Danışmanlar Sayfası Slogan 2</label>
                        <div class="col-sm-10">
                          <textarea name="Metin8" class="form-control editor"><?php echo $row_rsDetay['Metin8']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Blog Sayfası Slogan 1</label>
                        <div class="col-sm-10">
                          <textarea name="Metin9" class="form-control editor"><?php echo $row_rsDetay['Metin9']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Blog Sayfası Slogan 2</label>
                        <div class="col-sm-10">
                          <textarea name="Metin10" class="form-control editor"><?php echo $row_rsDetay['Metin10']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KVKK</label>
                        <div class="col-sm-10">
                          <textarea name="Metin11" class="form-control editor"><?php echo $row_rsDetay['Metin11']; ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Kaydet</button>
                        </div>
                      </div>
                        <input type="hidden" name="islem" value="guncelle">
                        <input type="hidden" name="ID" value="<?php echo $row_rsDetay['ID']; ?>">
                        <input type="hidden" name="Resim1Eski" value="<?php echo $row_rsDetay['Resim1']; ?>">
                        <input type="hidden" name="Resim2Eski" value="<?php echo $row_rsDetay['Resim2']; ?>">
                        <input type="hidden" name="Resim3Eski" value="<?php echo $row_rsDetay['Resim3']; ?>">
                        <input type="hidden" name="Resim4Eski" value="<?php echo $row_rsDetay['Resim4']; ?>">
                    </form>
                 
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
  