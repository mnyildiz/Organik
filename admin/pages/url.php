<?php 
if(!isset($ACCESS)){
	die("ERROR!");
}

$maxRows_rsListe = 500;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_rsListe = $page * $maxRows_rsListe;
$query_rsListe = "SELECT * FROM tablo_url ORDER BY UrlID";			
$query_limit_rsListe = sprintf("%s LIMIT %d, %d", $query_rsListe, $startRow_rsListe, $maxRows_rsListe);
$rsListe = mysqli_query($Conn, $query_limit_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);

if (isset($_GET['toplam'])) {
  $toplam = $_GET['toplam'];
} else {
  $all_rsListe = mysqli_query($Conn, $query_rsListe);
  $toplam = mysqli_num_rows($all_rsListe);
}
$totalPages_rsListe = ceil($toplam/$maxRows_rsListe)-1;
?>
<?php  $SayfaTitle = "SEO Ayarları"; ?>
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
        <div class="card-body table-responsive p-0">
        
       
        
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Link</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th><a href="<?php echo sayfa("url_detay") ?>" class="btn btn-sm btn-info">Yeni Ekle</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do { ?>
                    <tr>
                      <td><?php echo $row_rsListe['UrlID']; ?></td>
                      <td><?php echo $row_rsListe['Link']; ?></td>
                      <td><?php echo $row_rsListe['Title']; ?></td>
                      <td><?php echo $row_rsListe['Description']; ?></td>
                      <td>
                        <a href="<?php echo sayfa("url_detay") ?>&UrlID=<?php echo $row_rsListe['UrlID']; ?>" class="btn btn-sm btn-success">Detay</a>
                        <a href="<?php echo sayfa("url_detay") ?>&UrlID=<?php echo $row_rsListe['UrlID']; ?>&islemsil=ok" onClick="return confirm('Emin msiniz?')" class="btn btn-sm btn-danger">Sil</a>
                     </td>
                    </tr>
                    <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>
                  </tbody>
                </table>
              </div>
               
      </div>
      
      </div>
      </div>
      </div>
      
    </section>
  </div>
 
