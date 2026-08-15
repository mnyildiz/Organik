<?php

$Title = "-1";
if (isset($_GET['Title'])) {
  $Title = $_GET['Title'];
}

$Arama = array();

$query_rsListe = sprintf("SELECT * FROM tablo_blog WHERE Baslik LIKE %s", escape("%" . $Title . "%", "text"));
$results = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
foreach($results as $result){
 	$Arama[] = array(
				"Url"=>url("blog_detay",$result['ID']),
				"Baslik"=>$result['Baslik'],
				"KisaBilgi"=>$result['KisaBilgi']
				);
}

$query_rsListe = sprintf("SELECT * FROM tablo_haberler WHERE Baslik LIKE %s", escape("%" . $Title . "%", "text"));
$results = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
foreach($results as $result){
 	$Arama[] = array(
				"Url"=>url("haberler_detay",$result['ID']),
				"Baslik"=>$result['Baslik'],
				"KisaBilgi"=>$result['KisaBilgi']
				);
}

$query_rsListe = sprintf("SELECT * FROM tablo_hizmetler WHERE Baslik LIKE %s", escape("%" . $Title . "%", "text"));
$results = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
foreach($results as $result){
	$Arama[] = array(
				"Url"=>url("hizmetler_detay",$result['ID']),
				"Baslik"=>$result['Baslik'],
				"KisaBilgi"=>$result['Veri1']
				);
}

$query_rsListe = sprintf("SELECT * FROM tablo_danismanlar WHERE Baslik LIKE %s", escape("%" . $Title . "%", "text"));
$results = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
foreach($results as $result){
	$Arama[] = array(
				"Url"=>url("danismanlar_detay",$result['ID']),
				"Baslik"=>$result['Baslik'],
				"KisaBilgi"=>$result['Unvan']
				);
}
	
?>
   <div class="banner-top">
       <div class="banner-title">
           
           <h4>Arama Sonuçları</h4>
           
       </div>
       </div>
  <div class="blog-page">
<div class="container">
       	<?php require_once('inc/social.php'); ?>

           
          <div class="row">
             <?php if (count($Arama)>0){ ?>
             <?php foreach($Arama as $result){ ?> 
             
              <div class="col-lg-4">
                  <div class="box" data-aos="fade-up">
                      <a href="<?php echo $result["Url"] ?>">
                          <h4><?php echo $result['Baslik']; ?></h4>
                           <p><?php echo $result['KisaBilgi']; ?></p>
                        <span>
                            <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt="">
                            Organik
                        </span>
                        <i class="icon-right"></i>
                      </a>
                  </div>
              </div>
              
              <?php } ?> 
              
              <?php }else{  ?>
              		<div class="col-lg-12">
                  <div class="box" data-aos="fade-up">
                      <a href="#">
                          <h4>Aramanıza göre sonuç bulunamadı...</h4>
                           <p><?php echo $result['KisaBilgi']; ?></p>
                         
                        <i class="icon-right"></i>
                      </a>
                  </div>
              </div>
              <?php }?>
              
      </div>
</div>
  </div>
  
   
     
   
    <?php require_once('inc/bottom-social.php'); ?>
       