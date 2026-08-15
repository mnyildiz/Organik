<?php 
$query_rsDetay = sprintf("SELECT * FROM tablo_blog WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error($Conn));
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);
 
$query_rsListe = "SELECT * FROM tablo_blog ORDER BY RAND() LIMIT 5";
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
 ?>

   <div class="banner-top blog-top">
       <div class="banner-title">
           
          <h6 data-aos="fade-right"><?php echo $row_rsDetay['Baslik']; ?></h6>
          <h3 data-aos="fade-left"><img src="<?php echo $SiteURL ?>img/blog-logo.png" alt=""> BLOG</h3>
       </div>
       </div>
      
       
       <div class="blog-detail">
      
             <?php require_once('inc/social.php'); ?>
          
               <div class="row">
                   <div class="col-lg-8">
                   <div class="left">
                         <img class="large" src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim']; ?>" alt="">
                           <span>
                           <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt="">
                           <?php echo $row_rsDetay['Baslik']; ?>
                           </span>
                       <div class="text">
                           <?php echo $row_rsDetay['Detay']; ?>
                        <div class="services-social blog-social">
            
                      <ul>
                          <li><a target="_blank" class="share facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo url("blog_detay",$row_rsDetay['ID']) ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-facebook"></i></a></li>
                         <li><a target="_blank" class="share twitter" href="https://twitter.com/intent/tweet?text=<?php echo strip_tags($row_rsDetay['Baslik']); ?>. <?php echo url("blog_detay",$row_rsDetay['ID']) ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-twitter"></i></a></li>
                          <li><a target="_blank" class="share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo url("blog_detay",$row_rsDetay['ID']) ?>&title=<?php echo strip_tags($row_rsDetay['Baslik']); ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-linkedin"></i></a></li>
                          
  
                     </ul>
            
              </div>
                       </div>
                       
                   </div>
                      
                   </div>
                   <div class="col-lg-4">
                       <div class="right" data-aos="fade-left">
                           <h3>BLOG <span>+</span></h3>
                           
                          <?php do { ?>    
                           
                           <div class="blog-box">
                               <a href="<?php echo url("blog_detay",$row_rsListe['ID']) ?>">
                                    <h5><?php echo $row_rsListe['Baslik']; ?></h5>
                                    <p><?php echo $row_rsListe['KisaBilgi']; ?></p>
                                    <span>
                                        <img src="<?php echo $SiteURL ?>img/blog-icon.svg" alt=""> Organik
                                    </span>
                                     <i class="icon-right"></i>
                               </a>
                           </div>
                           
                       <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>     
                           
                          
                           
                       </div>
                   </div>
           
           </div>
        
       </div>

    <?php require_once('inc/bottom-social.php'); ?>
