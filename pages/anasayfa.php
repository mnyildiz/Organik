  <?php

$query_rsSlider = i18n_select_sql('slider', '', 'b.SiraNo ASC');
$rsSlider = mysqli_query($Conn, $query_rsSlider) or die(mysqli_error());
$row_rsSlider = mysqli_fetch_assoc($rsSlider);
$totalRows_rsSlider = mysqli_num_rows($rsSlider);
?>
      <section class="main-slider">
          <div class="swiper mySwiper">
              <div class="swiper-wrapper">
                 
               <?php if ($totalRows_rsSlider > 0) do { ?>  
                 
          <div class="swiper-slide">
              <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsSlider['Resim']; ?>" alt="">
              <div class="text">
                  <h5 data-aos="flip-left" data-aos-duration="1500"><?php echo $row_rsSlider['Baslik']; ?></h5>
              </div>
          </div>
                  
                 <?php } while ($row_rsSlider = mysqli_fetch_assoc($rsSlider)); ?>    
                  
                   
              </div>
              <div class="swiper-pagination"></div>
          </div>
      </section>
      
      <div class="main-about" >
         <?php require_once('inc/social.php'); ?>
           <div class="container">
              <div class="left" data-aos="fade-up" data-aos-duration="1500">
                 <div class="abt-img ">
                     <a href="<?php echo sayfa_linki('danismanlar') ?>"><img src="<?php echo $SiteURL ?>img/about-icon.svg" class="about-top fx" alt=""></a>
                     <a href="<?php echo sayfa_linki('danismanlar') ?>"><img src="<?php echo $SiteURL ?>img/about-icon-hover.svg" class="about-top hvr" alt=""></a>
                 </div>
                 
                 <a href="<?php echo sayfa_linki('hakkimizda') ?>">
                  <h3><?php echo t('nav.about') ?></h3>
                  <?php echo $row_rsMetinler['Metin0']; ?>
                  <i class="icon-right"></i></a>
              </div>
              <div class="right" id="parallax1">
                 <video id="vid" width="100%" height="1000"  data-autopause="true" data-mute="true" data-loop="true" playsinline  autoplay muted data-fill-mode="fill" class="ms-slide-bgvideo" >
                
 
 <source src="<?php echo $SiteURL ?>/img/organikvideo.mp4" type="video/mp4">
 
 <source src="movie.ogg" type="video/ogg">
 
<?php echo t('video.unsupported') ?>

</video>
              </div>
              
          </div>
   
              <img class="right-img" src="<?php echo $SiteURL ?>img/line.png" alt="">
          
      </div>
      <?php

$query_rsListe = i18n_select_sql('blog', '', 'b.Tarih DESC', '4');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
      <div class="main-blog">
          <div class="container">
              <div class="title" data-aos="fade-right" data-aos-duration="1000">
                  <img src="<?php echo $SiteURL ?>img/blog-logo.png" alt="">
                  <h3>BLOG</h3>
                  <a href="<?php echo sayfa_linki('blog') ?>"><i class="icon-right"></i> <?php echo t('home.show_all') ?></a>
              </div>
              <div class="left" data-aos="flip-right" data-aos-duration="1500">
                  <img src="<?php echo $SiteURL ?>img/main-blog-img.jpg" alt="">
              </div>
              <div class="right"  data-aos="fade-left" data-aos-duration="1000">
                  <div class="row">
                  
                  
                    <?php if ($totalRows_rsListe > 0) do { ?> 
                      <div class="col-lg-6">
                          <div class="box">
                             <a href="<?php echo url("blog_detay",$row_rsListe['ID']) ?>">
                                 <h4><?php echo $row_rsListe['Baslik']; ?></h4>
                           <p><?php echo $row_rsListe['KisaBilgi']; ?></p>
                                <i class="icon-right"></i>
                              </a>
                          </div>
                      </div>
                      
                  <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>     
                      
                      
                  </div>
              </div>
          </div>
      </div>
      <?php 
		$query_rsListe = i18n_select_sql('hizmetler', '', 'b.SiraNo');
		$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
		$row_rsListe = mysqli_fetch_assoc($rsListe);
		$totalRows_rsListe = mysqli_num_rows($rsListe);
	  ?>
      <div class="main-services">
          <div class="container">
             <h3 data-aos="fade-right" data-aos-duration="1500"><?php echo t('nav.services') ?></h3>
          </div>
          <div class="swiper mySwiper">
                      <div class="swiper-wrapper">
			 <?php if ($totalRows_rsListe > 0) do { ?> 
              <div class="swiper-slide">
                  <div class="box">
                      <a href="<?php echo url("hizmetler_detay",$row_rsListe['ID']) ?>">
                         
                         <img class="fix" src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim2']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                         <img class="hover" src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim2Hover']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                         
                           
                      <h5><?php echo $row_rsListe['Baslik']; ?></h5>
                      </a>
                  </div>
              </div>
              <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>
                           
                      </div>
                  </div>
      </div>
     <?php

$query_rsListe = i18n_select_sql('haberler', "b.Slider = 'Evet'", 'b.Tarih DESC', '5');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
      <div class="main-news">
          <div class="container">
              <h3 data-aos="fade-right" data-aos-duration="1500"><?php echo t('home.news') ?></h3>
              
              <div class="swiper mySwiper">
                  <div class="swiper-wrapper">
                    
                    <?php if ($totalRows_rsListe > 0) do { ?> 
                    <div class="swiper-slide">
                        <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                        <div class="box" >
                            <a href="<?php echo url("haberler_detay",$row_rsListe['ID']) ?>">
                                <h4 data-aos="fade-right" data-aos-duration="1500"><?php echo $row_rsListe['Baslik']; ?></h4>
                            <p data-aos="fade-right" data-aos-duration="1500"><?php echo $row_rsListe['KisaBilgi']; ?></p>
                            <span><small><?php echo t('home.go_to_news') ?></small><i class="icon-right"></i></span>
                            </a>
                        </div>
                    </div>
                    
                   <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>    
                    
                  </div>
                  <div class="swiper-pagination"></div>
              </div>
              <div class="all">
                  <a href="<?php echo sayfa_linki('haberler') ?>"><i class="icon-right"></i> <?php echo t('home.show_all') ?></a>
              </div>
          </div>
      </div>
       <?php require_once('inc/bottom-social.php'); ?>
