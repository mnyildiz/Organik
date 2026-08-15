<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
  
	$Resim = upload("../images/uploads/","Resim","ResimEski");
	
	$updateSQL = sprintf("UPDATE tablo_iletisim_bilgileri SET Adres=%s, Adres2=%s, TelNo=%s, FaxNo=%s, Email=%s, Facebook=%s, Twitter=%s, Youtube=%s, Instagram=%s, Linkedin=%s, Whatsapp=%s, Maps=%s, Maps2=%s, Resim=%s WHERE ID=%s",
                       escape($_POST['Adres'], "text"),
					   escape($_POST['Adres2'], "text"),
                       escape($_POST['TelNo'], "text"),
                       escape($_POST['FaxNo'], "text"),
                       escape($_POST['Email'], "text"),
                       escape($_POST['Facebook'], "text"),
                       escape($_POST['Twitter'], "text"),
                       escape($_POST['Youtube'], "text"),
                       escape($_POST['Instagram'], "text"),
					   escape($_POST['Linkedin'], "text"),
					   escape($_POST['Whatsapp'], "text"),
                       escape($_POST['Maps'], "text"),
                       escape($_POST['Maps2'], "text"),
					   escape($Resim, "text"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  
  $_SESSION['islemMesaj'] = "ok";
  
  $Url = $AdminURL."index.php?sayfa=iletisim_bilgileri";	
  yonlendir_($Url);
}

$query_rsIletisim = "SELECT * FROM tablo_iletisim_bilgileri";
$rsIletisim = mysqli_query($Conn, $query_rsIletisim) or die(mysqli_error());
$row_rsIletisim = mysqli_fetch_assoc($rsIletisim);
$totalRows_rsIletisim = mysqli_num_rows($rsIletisim);
?>
<?php $SayfaTitle = "İletişim Bilgileri" ?>
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
                        <label class="col-sm-2 col-form-label">Resim</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim" id="Resim">
                                	<label class="custom-file-label" for="Resim">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Adres 1</label>
                  <div class="col-sm-10">
                    <textarea name="Adres" class="form-control editor"><?php echo $row_rsIletisim['Adres']; ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Adres 2</label>
                  <div class="col-sm-10">
                    <textarea name="Adres2" class="form-control editor"><?php echo $row_rsIletisim['Adres2']; ?></textarea>
                  </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">TelNo</label>
                   <div class="col-sm-10">
                     <input name="TelNo" type="text" class="form-control" value="<?php echo $row_rsIletisim['TelNo']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">FaxNo</label>
                   <div class="col-sm-10">
                     <input name="FaxNo" type="text" class="form-control" value="<?php echo $row_rsIletisim['FaxNo']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Email</label>
                   <div class="col-sm-10">
                     <input name="Email" type="text" class="form-control" value="<?php echo $row_rsIletisim['Email']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Facebook</label>
                   <div class="col-sm-10">
                     <input name="Facebook" type="text" class="form-control" value="<?php echo $row_rsIletisim['Facebook']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Twitter</label>
                   <div class="col-sm-10">
                     <input name="Twitter" type="text" class="form-control" value="<?php echo $row_rsIletisim['Twitter']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Youtube</label>
                   <div class="col-sm-10">
                     <input name="Youtube" type="text" class="form-control" value="<?php echo $row_rsIletisim['Youtube']; ?>">
                   </div>
                </div>
                      
                 <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Instagram</label>
                   <div class="col-sm-10">
                     <input name="Instagram" type="text" class="form-control" value="<?php echo $row_rsIletisim['Instagram']; ?>">
                   </div>
                </div>
                
                <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Linkedin</label>
                   <div class="col-sm-10">
                     <input name="Linkedin" type="text" class="form-control" value="<?php echo $row_rsIletisim['Linkedin']; ?>">
                   </div>
                </div>
                
               <!-- <div class="form-group row">
                   <label class="col-sm-2 col-form-label">Whatsapp</label>
                   <div class="col-sm-10">
                     <input name="Whatsapp" type="text" class="form-control" value="<?php echo $row_rsIletisim['Whatsapp']; ?>">
                   </div>
                </div> -->
                      
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Merkez Maps</label>
                  <div class="col-sm-10">
                    <textarea name="Maps" rows="7" class="form-control"><?php echo $row_rsIletisim['Maps']; ?></textarea>
                  </div>
                </div>
				
				                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Ankara Maps</label>
                  <div class="col-sm-10">
                    <textarea name="Maps2" rows="7" class="form-control"><?php echo $row_rsIletisim['Maps2']; ?></textarea>
                  </div>
                </div>
                      
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Yeni Bilgilerimi Kaydet</button>
                  </div>
                </div>
                  <input type="hidden" name="islem" value="guncelle">
                  <input type="hidden" name="ID" value="<?php echo $row_rsIletisim['ID']; ?>">
                  <input type="hidden" name="ResimEski" value="<?php echo $row_rsIletisim['Resim']; ?>">
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