<?php
$query_rsListe = "SELECT * FROM tablo_haberler WHERE Slider = 'Evet' ORDER BY Tarih DESC LIMIT 5";
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
   <div class="banner-top">
       <div class="banner-title">
          <h4>HABER <small>VE DUYURULAR</small></h4>
       </div>
       </div>
  
  <?php if (!isset($_GET["tumunuGoster"])){ ?>
  <div class="news-slider">

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                      <?php do { ?>      
                         
                         <div class="swiper-slide">
                            <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                            <div class="box">
                               <a href="<?php echo url("haberler_detay",$row_rsListe['ID']) ?>">
                                    <div class="top-new">
                                        <h4><?php echo $row_rsListe['Baslik']; ?></h4>
                                    </div>
                                    <div class="bottom-new">
                                        <p><?php echo $row_rsListe['KisaBilgi']; ?></p>
                                    <i class="icon-right"></i>
                                    </div>
                               </a>
                            </div>
                        </div>
                         
                       <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>  
                         
                    </div>
                    <div class="swiper-button-next"></div>
           <div class="swiper-button-prev"></div>
                </div>
        
        </div>
        <?php }?>
  <?php
 if (!isset($_GET["tumunuGoster"])){
 	$query_rsListe = "SELECT * FROM tablo_haberler WHERE Slider != 'Evet' ORDER BY Tarih DESC LIMIT 6";
 }else{
	 $query_rsListe = "SELECT * FROM tablo_haberler ORDER BY Tarih DESC";
 }
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
  <div class="blog-page">
<div class="container">
       	<?php require_once('inc/social.php'); ?>

          <h3>HABERLER <span>+</span></h3>
          <div class="row">
             
             <?php do { ?> 
             
              <div class="col-lg-4">
                  <div class="box" data-aos="fade-up">
                      <a href="<?php echo url("haberler_detay",$row_rsListe['ID']) ?>">
                          <h4><?php echo $row_rsListe['Baslik']; ?></h4>
                           <p><?php echo $row_rsListe['KisaBilgi']; ?></p>
                        <span>
                            <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt="">
                            Organik
                        </span>
                        <i class="icon-right"></i>
                      </a>
                  </div>
              </div>
              
              <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?> 
              
      </div>
</div>
  </div>
  <?php if (!isset($_GET["tumunuGoster"])){ ?>
  
  <div class="blog-comment" >
      <div class="container">
          <div class="comment-title" data-aos="fade-right">
              <?php echo $row_rsMetinler['Metin5']; ?>
          </div>
          <div class="comment-img" data-aos="fade-left">
            <?php echo $row_rsMetinler['Metin6']; ?>
     
          </div>
      </div>
  </div>
  
 <?php

if (!isset($_GET["tumunuGoster"])){
 	$query_rsListe = "SELECT * FROM tablo_haberler ORDER BY Tarih DESC LIMIT 6,6";
 }else{
	 $query_rsListe = "SELECT * FROM tablo_haberler ORDER BY Tarih DESC";
 }
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
<div class="blog-page btm">

        
         <div class="container">
              <div class="row">
              <?php do { ?> 
             
              <div class="col-lg-4">
                  <div class="box" data-aos="fade-up">
                      <a href="<?php echo url("haberler_detay",$row_rsListe['ID']) ?>">
                          <h4><?php echo $row_rsListe['Baslik']; ?></h4>
                           <p><?php echo $row_rsListe['KisaBilgi']; ?></p>
                        <span>
                            <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt="">
                            Organik
                        </span>
                        <i class="icon-right"></i>
                      </a>
                  </div>
              </div>
              
              <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?> 
               
               
          </div>
          <div class="all">
              <a href="<?php echo $SiteURL ?>haberler?tumunuGoster=ok">
                  <img src="<?php echo $SiteURL ?>img/more.svg" alt="">
              <p>Daha fazla göster</p>
              </a>
     
      </div>
         </div>
  </div>
     <?php }?>
    <?php require_once('inc/bottom-social.php'); ?>
