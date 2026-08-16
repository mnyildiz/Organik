<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
  	
	
	$Resim1 = upload("../uploads/","Resim1","Resim1Eski");
	$Resim2 = upload("../uploads/","Resim2","Resim2Eski");
	$Resim3 = upload("../uploads/","Resim3","Resim3Eski");
	
	
	$updateSQL = sprintf("UPDATE tablo_ayarlar SET Baslik=%s, Aciklama=%s, Metalar=%s, Resim1=%s, Resim2=%s, Resim3=%s WHERE ID=%s",
                       escape($_POST['Baslik'], "text"),
                       escape($_POST['Aciklama'], "text"),
                       escape($_POST['Metalar'], "text"),
					   escape($Resim1, "text"),
					   escape($Resim2, "text"),
					   escape($Resim3, "text"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  admin_cevirileri_kaydet('ayarlar', $_POST['ID']);
  
  $updateSQL = sprintf("UPDATE tablo_url SET Title=%s, `Description`=%s WHERE UrlID=%s",
                       escape($_POST['Title'], "text"),
                       escape($_POST['Description'], "text"),
                       escape($_POST['UrlID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  admin_url_cevirilerini_kaydet('anasayfa', 0);
  
  $_SESSION['islemMesaj'] = "ok";
  
  $Url = $AdminURL."index.php?sayfa=ayarlar";	
  yonlendir_($Url);
}

$query_rsAyar = "SELECT * FROM tablo_ayarlar";
$rsAyar = mysqli_query($Conn, $query_rsAyar) or die(mysqli_error());
$row_rsAyar = mysqli_fetch_assoc($rsAyar);
$totalRows_rsAyar = mysqli_num_rows($rsAyar);


$query_rsUrl = "SELECT * FROM tablo_url WHERE Sayfa='anasayfa'";
$rsUrl = mysqli_query($Conn, $query_rsUrl) or die(mysqli_error());
$row_rsUrl = mysqli_fetch_assoc($rsUrl);
$totalRows_rsUrl = mysqli_num_rows($rsUrl);
?>
<?php $SayfaTitle = "Ayarlar" ?>
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
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Site Title</label>
                        <div class="col-sm-10">
                          <input name="Title" type="text" class="form-control" value="<?php echo $row_rsUrl['Title']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Site Description</label>
                        <div class="col-sm-10">
                          <input name="Description" type="text" class="form-control" value="<?php echo $row_rsUrl['Description']; ?>">
                        </div>
                      </div>
                      
                   <!--   
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ana Sayfa Hakkımızda Resim</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim1" id="Resim1">
                                	<label class="custom-file-label" for="Resim1">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hakkımda Sayfası Resim1</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim2" id="Resim2">
                                	<label class="custom-file-label" for="Resim2">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hakkımda Sayfası Resim2</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim3" id="Resim3">
                                	<label class="custom-file-label" for="Resim3">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hakkımda Sayfası Resim3</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim4" id="Resim4">
                                	<label class="custom-file-label" for="Resim4">Resim Seç</label>
                                </div>
                        </div>
                      </div> 
                      
                     
                      
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Hakkımızda Başlık</label>
                        <div class="col-sm-10">
                          <input name="Baslik" type="text" class="form-control" value="<?php echo $row_rsAyar['Baslik']; ?>">
                        </div>
                      </div>
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Hakkımızda Tanıtım</label>
                        <div class="col-sm-10">
                          <textarea name="Aciklama" rows="5" class="form-control"><?php echo $row_rsAyar['Aciklama']; ?></textarea>
                        </div>
                      </div>
                      -->
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Metalar<br>(Google Analytics, Yandex Metrica vs.)</label>
                        <div class="col-sm-10">
                          <textarea name="Metalar" rows="10" class="form-control"><?php echo $row_rsAyar['Metalar']; ?></textarea>
                        </div>
                      </div>
                      
                      <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Metin 2</label>
                        <div class="col-sm-10">
                          <textarea name="Metalar" rows="5" class="form-control"><?php echo $row_rsAyar['Metalar']; ?></textarea>
                        </div>
                      </div>
                      
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Anasayfa Metin</label>
                        <div class="col-sm-10">
                          <textarea name="Metin3" rows="5" class="form-control"><?php echo $row_rsAyar['Metin3']; ?></textarea>
                        </div>
                      </div>
                      
                      
                      
                       <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Footer Metin</label>
                        <div class="col-sm-10">
                          <textarea name="Metin4" rows="5" class="form-control"><?php echo $row_rsAyar['Metin4']; ?></textarea>
                        </div>
                      </div>   -->
                      
                      <?php admin_ceviri_sekmeleri('ayarlar', $row_rsAyar['ID'], array(
                        'Baslik' => 'Başlık',
                        'Aciklama' => array('Açıklama', 'editor')
                      ), 'anasayfa', 0); ?>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Kaydet</button>
                        </div>
                      </div>
                        <input type="hidden" name="islem" value="guncelle">
                        <input type="hidden" name="ID" value="<?php echo $row_rsAyar['ID']; ?>">
                        <input type="hidden" name="UrlID" value="<?php echo $row_rsUrl['UrlID']; ?>">
                        <input type="hidden" name="Resim1Eski" value="<?php echo $row_rsAyar['Resim1']; ?>">
                        <input type="hidden" name="Resim2Eski" value="<?php echo $row_rsAyar['Resim2']; ?>">
                        <input type="hidden" name="Resim3Eski" value="<?php echo $row_rsAyar['Resim3']; ?>">
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
