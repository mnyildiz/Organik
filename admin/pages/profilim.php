<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

$UserID = "-1";
if (isset($_SESSION['UserID'])) {
  $UserID = $_SESSION['UserID'];
}

$query_rsProfil = sprintf("SELECT * FROM tablo_login WHERE UserID = %s", escape($UserID, "int"));
$rsProfil = mysqli_query($Conn, $query_rsProfil) or die(mysqli_error());
$row_rsProfil = mysqli_fetch_assoc($rsProfil);
$totalRows_rsProfil = mysqli_num_rows($rsProfil);

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
  
	
	if ($_POST['Parola'] !="") {
	  	$Parola = md5($_POST['Parola']);
	}else{
		$Parola = $_POST['ParolaEski'];
	}
	
	$Resim = upload("./uploads/img/","Resim","ResimEski");
  
  $updateSQL = sprintf("UPDATE tablo_login SET Unvan=%s, Adi=%s, Soyadi=%s, Telefon=%s, Parola=%s, Email=%s, Resim=%s, Hakkimda=%s WHERE UserID=%s",
                       escape($_POST['Unvan'], "text"),
					   escape($_POST['Adi'], "text"),
                       escape($_POST['Soyadi'], "text"),
                       escape($_POST['Telefon'], "text"),
                       escape($Parola, "text"),
                       escape($_POST['Email'], "text"),
                       escape($Resim, "text"),
                       escape($_POST['Hakkimda'], "text"),
                       escape($_POST['UserID'], "int"));

  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error());
  
  $_SESSION['islemMesaj'] = "ok";
  
  $Url = $AdminURL."index.php?sayfa=profilim";	
  yonlendir_($Url);
}
?>
<?php $SayfaTitle = "Profilim" ?>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                
                <img src="<?php echo $AdminURL ?>uploads/img/<?php echo $Resim ?>" class="profile-user-img img-fluid img-circle" alt="<?php echo $Adi ?>">
                  
                </div>

                <h3 class="profile-username text-center"><?php echo $Adi ?> <?php echo $Soyadi ?></h3>

                <p class="text-muted text-center"><?php echo $Unvan ?></p>

                <!--<ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> -->

                <!--<a href="#" class="btn btn-primary btn-block"><b>Parola Sıfırla?</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Hakkımda</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <p class="text-muted">
                 <?php echo $row_rsProfil['Hakkimda']; ?>
                </p>

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#bilgilerim" data-toggle="tab">Bilgilerim</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="bilgilerim">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unvanım</label>
                        <div class="col-sm-10">
                          <input name="Unvan" type="text" required class="form-control" placeholder="Unvan" value="<?php echo $row_rsProfil['Unvan']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Adım</label>
                        <div class="col-sm-10">
                          <input name="Adi" type="text" required class="form-control" placeholder="Adım" value="<?php echo $row_rsProfil['Adi']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Soyadım</label>
                        <div class="col-sm-10">
                          <input name="Soyadi" type="text" required class="form-control" placeholder="Soyadım" value="<?php echo $row_rsProfil['Soyadi']; ?>">
                        </div>
                      </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email Adresim</label>
                        <div class="col-sm-10">
                          <input name="Email" type="email" required class="form-control" placeholder="Email Adresim" value="<?php echo $row_rsProfil['Email']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telefonum</label>
                        <div class="col-sm-10">
                          <input name="Telefon" type="text" required class="form-control" placeholder="Telefon" value="<?php echo $row_rsProfil['Telefon']; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hakkımda</label>
                        <div class="col-sm-10">
                          <textarea name="Hakkimda" class="form-control" placeholder="Hakkımda"><?php echo $row_rsProfil['Hakkimda']; ?></textarea>
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profil Resmim</label>
                        <div class="col-sm-10">
                              <div class="custom-file">
                                	<input type="file" class="custom-file-input" name="Resim" id="Resim">
                                	<label class="custom-file-label" for="Resim">Resim Seç</label>
                                </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Parolam</label>
                        <div class="col-sm-10">
                          <input name="Parola" type="password" class="form-control" placeholder="Yeni Parolam">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Yeni Bilgilerimi Kaydet</button>
                        </div>
                      </div>
                        <input type="hidden" name="islem" value="guncelle">
                        <input type="hidden" name="UserID" value="<?php echo $row_rsProfil['UserID']; ?>">
                        <input type="hidden" name="ParolaEski" value="<?php echo $row_rsProfil['Parola']; ?>">
                        <input type="hidden" name="ResimEski" value="<?php echo $row_rsProfil['Resim']; ?>">
                    </form>
                  </div>
                  
                  <!-- /.tab-pane -->
                  
                  <!-- /.tab-pane -->

                  
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