<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

if ((isset($_GET['ID'])) && ($_GET['ID'] != "") && (isset($_GET['islemsil']))) {
  
   $deleteSQL = sprintf("DELETE FROM tablo_ebulten WHERE ID=%s",
                       escape($_GET['ID'], "int"));
  $Result1 = mysqli_query($Conn, $deleteSQL) or die(mysqli_error($Conn));
  
  $Url = $AdminURL."index.php?sayfa=ebulten";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "kaydet")) {
	
   $insertSQL = sprintf("INSERT INTO tablo_ebulten (Email) VALUES (%s)",
                       escape($_POST['Email'], "text"));
  $Result1 = mysqli_query($Conn, $insertSQL) or die(mysqli_error($Conn));
  
  $_SESSION['islemMesaj'] = "ok";   
  
  $Url = $AdminURL."index.php?sayfa=ebulten";	
  yonlendir_($Url);
}

if ((isset($_POST["islem"])) && ($_POST["islem"] == "guncelle")) {
	 
  $updateSQL = sprintf("UPDATE tablo_ebulten SET Email=%s WHERE ID=%s",
                       escape($_POST['Email'], "text"),
                       escape($_POST['ID'], "int"));
  $Result1 = mysqli_query($Conn, $updateSQL) or die(mysqli_error($Conn));
  
  $_SESSION['islemMesaj'] = "ok";
  
  $Url = $AdminURL."index.php?sayfa=ebulten";	
  yonlendir_($Url);
}

$ID = "-1";
if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
}

$query_rsDetay = sprintf("SELECT * FROM tablo_ebulten WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error($Conn));
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);
?>
<?php  $SayfaTitle = "E-bülten Listesi"; ?>
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
                        <label class="col-sm-2 col-form-label">E-mail Adresi</label>
                        <div class="col-sm-10">
                          <input name="Email" type="email" required class="form-control" value="<?php echo $row_rsDetay['Email']; ?>">
                        </div>
                      </div>
                      
                      
                       
                  
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