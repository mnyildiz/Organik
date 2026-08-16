<?php
$query_rsListe = i18n_select_sql('blog', "b.Slider = 'Evet'", 'b.Tarih DESC', '5');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
   <div class="banner-top">
       <div class="banner-title">
           <h4><?php echo t('page.blog') ?></h4>
       </div>
       </div>
   <?php if (!isset($_GET["tumunuGoster"])){ ?>    
  <section class="banner-slider">
       <div class="swiper mySwiper">
           <div class="swiper-wrapper">
              
               <?php if ($totalRows_rsListe > 0) do { ?>     
                <div class="swiper-slide">
                   <div class="box">
                       <a href="<?php echo url("blog_detay",$row_rsListe['ID']) ?>">
                           <div class="left">
                       <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                       </div>
                   <div class="right">
                       <h4 data-swiper-parallax="-300"><?php echo $row_rsListe['Baslik']; ?></h4>
                        <p data-swiper-parallax="-500"><?php echo $row_rsListe['KisaBilgi']; ?></p>
                        <span data-swiper-parallax="-700">
                            <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt="">
                            Organik
                        </span>
                        <i class="icon-right" data-swiper-parallax="-900"></i>
                   </div>
                       </a>
                   </div>
               </div>
           <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>     
            </div>
           <div class="swiper-button-next"></div>
           <div class="swiper-button-prev"></div>
       </div>
  </section>
  <?php }?>
  <?php
 if (!isset($_GET["tumunuGoster"])){
	$query_rsListe = i18n_select_sql('blog', '', 'b.Tarih DESC', '6');
 }else{
	 $query_rsListe = i18n_select_sql('blog', '', 'b.Tarih DESC');
 }
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
  <div class="blog-page">
<div class="container">
       	<?php require_once('inc/social.php'); ?>

          <h3><?php echo t('page.blog') ?> <span>+</span></h3>
          <div class="row">
             
             <?php if ($totalRows_rsListe > 0) do { ?> 
             
              <div class="col-lg-4">
                  <div class="box" data-aos="fade-up">
                      <a href="<?php echo url("blog_detay",$row_rsListe['ID']) ?>">
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
              <?php echo $row_rsMetinler['Metin9']; ?>
          </div>
          <div class="comment-img" data-aos="fade-left">
             <?php echo $row_rsMetinler['Metin10']; ?>
             
          </div>
      </div>
  </div>
  <?php

if (!isset($_GET["tumunuGoster"])){
	$query_rsListe = i18n_select_sql('blog', '', 'b.Tarih DESC', '6,6');
 }else{
	 $query_rsListe = i18n_select_sql('blog', '', 'b.Tarih DESC');
 }
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
<div class="blog-page btm">

        
         <div class="container">
              <div class="row">
              <?php if ($totalRows_rsListe > 0) do { ?> 
             
              <div class="col-lg-4">
                  <div class="box" data-aos="fade-up">
                      <a href="<?php echo url("blog_detay",$row_rsListe['ID']) ?>">
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
              <a href="<?php echo sayfa_linki('blog') ?>?tumunuGoster=ok">
                  <img src="<?php echo $SiteURL ?>img/more.svg" alt="">
              <p><?php echo t('common.more') ?></p>
              </a>
     
      </div>
         </div>
  </div>
     <?php }?>
     
   
    <?php require_once('inc/bottom-social.php'); ?>
  
