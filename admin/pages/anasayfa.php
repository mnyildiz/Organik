<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}
$query_rsBlog = "SELECT * FROM tablo_blog";
$rsBlog = mysqli_query($Conn, $query_rsBlog) or die(mysqli_error());
$row_rsBlog = mysqli_fetch_assoc($rsBlog);
$totalRows_rsBlog = mysqli_num_rows($rsBlog);

$query_rsIletisim = "SELECT * FROM tablo_iletisim";
$rsIletisim = mysqli_query($Conn, $query_rsIletisim) or die(mysqli_error());
$row_rsIletisim = mysqli_fetch_assoc($rsIletisim);
$totalRows_rsIletisim = mysqli_num_rows($rsIletisim);

$query_rsHaberler = "SELECT * FROM tablo_haberler";
$rsHaberler = mysqli_query($Conn, $query_rsHaberler) or die(mysqli_error());
$row_rsHaberler = mysqli_fetch_assoc($rsHaberler);
$totalRows_rsHaberler = mysqli_num_rows($rsHaberler);

$query_rsDanismanlar = "SELECT * FROM tablo_danismanlar";
$rsDanismanlar = mysqli_query($Conn, $query_rsDanismanlar) or die(mysqli_error());
$row_rsDanismanlar = mysqli_fetch_assoc($rsDanismanlar);
$totalRows_rsDanismanlar = mysqli_num_rows($rsDanismanlar);


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Anasayfa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Giriş Ekranı</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $totalRows_rsBlog ?></h3>

                <p>adet blog yazısı</p>
              </div>
              <div class="icon">
                <i class="fas fa-blog"></i>
              </div>
              <a href="<?php echo sayfa("blog") ?>" class="small-box-footer">daha fazla <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totalRows_rsIletisim ?></h3>

                <p>adet mesaj</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <a href="<?php echo sayfa("iletisim_mesajlari") ?>" class="small-box-footer">daha fazla <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $totalRows_rsDanismanlar ?></h3>

                <p>adet danışman</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="<?php echo sayfa("danismanlar") ?>" class="small-box-footer">daha fazla <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $totalRows_rsHaberler ?></h3>

                <p>adet haber</p>
              </div>
              <div class="icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <a href="<?php echo sayfa("haberler") ?>" class="small-box-footer">daha fazla <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
    
    
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">Son Mesajlar</h3>
        </div>
        <div class="card-body table-responsive">
        
       <?php 
		$query_rsSonMesajlar = "SELECT * FROM tablo_iletisim ORDER BY ID DESC LIMIT 5";
		$rsSonMesajlar = mysqli_query($Conn, $query_rsSonMesajlar) or die(mysqli_error());
		$row_rsSonMesajlar = mysqli_fetch_assoc($rsSonMesajlar);
		$totalRows_rsSonMesajlar = mysqli_num_rows($rsSonMesajlar);
	   ?>
        
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Adı Soyadı</th>
                      <th>Telefon</th>
                      <th>Email</th>
                      <th>Okundu?</th>
                      <th>Tarih</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if ($totalRows_rsSonMesajlar>0){ ?>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_rsSonMesajlar['ID']; ?></td>
                      <td><?php echo $row_rsSonMesajlar['AdiSoyadi']; ?></td>
                      <td><?php echo $row_rsSonMesajlar['Telefon']; ?></td>
                      <td><?php echo $row_rsSonMesajlar['Email']; ?></td>
                      <td>
						<?php if( $row_rsSonMesajlar['Okundu'] == 1) { ?>
                        	<i class="fa fa-circle text-success"/>
                        <?php } else { ?>
                        	<i class="fa fa-circle text-danger"/>
                        <?php } ?>
                      </td>
                      <td><?php echo tarih($row_rsSonMesajlar['KayitTarihi']); ?></td>
                      <td>
                        <a href="<?php echo sayfa("iletisim_mesajlari_detay") ?>&ID=<?php echo $row_rsSonMesajlar['ID']; ?>" class="btn btn-sm btn-success">Oku</a>
                        
                     </td>
                    </tr>
                    <?php } while ($row_rsSonMesajlar = mysqli_fetch_assoc($rsSonMesajlar)); ?>
                    <?php }else{  ?>
                    	<tr>
                      <td colspan="7">Henüz mesaj yok...</td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              
      </div>
      
      </div>
      </div>
      
      <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
    
      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Son Haberler</h3>
        </div>
        <div class="card-body table-responsive">
        
       <?php 
	   $query_rsHaberler = "SELECT * FROM tablo_haberler ORDER BY ID DESC LIMIT 5";
$rsHaberler = mysqli_query($Conn, $query_rsHaberler) or die(mysqli_error());
$row_rsHaberler = mysqli_fetch_assoc($rsHaberler);
$totalRows_rsHaberler = mysqli_num_rows($rsHaberler);
	   ?>
        
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Başlık</th>
                      <th><a href="<?php echo sayfa("haberler_detay") ?>" class="btn btn-sm btn-info">Yeni Haber</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_rsHaberler['ID']; ?></td>
                      <td><?php echo strip_tags($row_rsHaberler['Baslik']); ?></td>
                      <td>
                      <a href="<?php echo sayfa("haberler_detay") ?>&ID=<?php echo $row_rsHaberler['ID']; ?>" class="btn btn-sm btn-success">Detay</a></td>
                    </tr>
                    <?php } while ($row_rsHaberler = mysqli_fetch_assoc($rsHaberler)); ?>
                  </tbody>
                </table>
              </div>
              
      </div>
      </div>
      </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>