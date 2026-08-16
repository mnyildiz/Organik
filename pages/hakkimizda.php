  <section class="banner">
      <img src="<?php echo $SiteURL ?>img/about-page.png" alt="">
      <div class="container">
          <div class="box">
     
          <h4 data-aos="fade-down"><?php echo t('about.title') ?></h4>
          </div>
          <div class="bottom">
              <img src="<?php echo $SiteURL ?>img/arrow-bottom.png" alt="">
          </div>
      </div>
  </section>
     
     <div class="about-top">
           <?php require_once('inc/social.php'); ?>

         <div class="container">
             <div class="left" data-aos="fade-right">
                 <h3><?php echo t('about.company') ?></h3>
                    <?php echo $row_rsMetinler['Metin2']; ?>
                    
                    <h4><?php echo t('about.principles') ?></h4>
                    <?php echo $row_rsMetinler['Metin3']; ?>
             </div>
              
             
             <div class="right" id="parallax1" >
                 <video id="vid" width="100%" height="1000" playsinline  data-autopause="true" data-mute="true" data-loop="true"  autoplay muted data-fill-mode="fill" class="ms-slide-bgvideo" >
                
 
 <source src="<?php echo $SiteURL ?>/img/slider-video.MP4" type="video/mp4">
 
 <source src="movie.ogg" type="video/ogg">
 
<?php echo t('video.unsupported') ?>

</video>
              </div>
             
             
             
         </div>
     </div>
     <div class="about-page" data-aos="fade-right">
         <div class="container">
           
          		<?php echo $row_rsMetinler['Metin4']; ?>
         </div>
     </div>
     <div class="about-video"  data-aos="fade-left">
         <div class="container">
              <video id="vid" width="100%" height="" playsinline  data-autopause="true" data-mute="true" data-loop="true"  autoplay muted data-fill-mode="fill" class="ms-slide-bgvideo" >
                
 
 <source src="<?php echo $SiteURL ?>/img/about-video.mp4" type="video/mp4">
 
 <source src="movie.ogg" type="video/ogg">
 
<?php echo t('video.unsupported') ?>

</video>
        
         </div>
     </div>
     
     <?php require_once('inc/services-bottom.php'); ?>

       <?php require_once('inc/bottom-social.php'); ?>
