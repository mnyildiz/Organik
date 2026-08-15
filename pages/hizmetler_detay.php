<?php
$query_rsDetay = sprintf("SELECT * FROM tablo_hizmetler WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error($Conn));
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);
 
$query_rsListe = "SELECT * FROM tablo_hizmetler ORDER BY RAND() LIMIT 5";
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
 ?>
  <section class="banner">
      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['ResimBuyuk']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
      <div class="container">
        
          <div class="box">
           
          <h4><?php echo $row_rsDetay['Baslik2']; ?></h4>
          </div>
          <div class="bottom">
              <img src="<?php echo $SiteURL ?>img/arrow-bottom.png" alt="">
          </div>
      </div>
  </section>
     
     
     <div class="about-top services-top">
           <?php require_once('inc/social.php'); ?>

         <div class="container">
             <div class="left" data-aos="fade-right">
             
                    <div class="box first">
                        <?php echo $row_rsDetay['Veri1']; ?>
                    </div>
                    <div class="box">
                        <?php echo $row_rsDetay['Veri2']; ?>
                    </div>
                    <div class="box">
                        <?php echo $row_rsDetay['Veri3']; ?>
                    </div>
                    <div class="box">
                   		<?php echo $row_rsDetay['Veri4']; ?>
                    </div>
             </div>
             <div class="right" data-aos="fade-left">
                 <div class="box">
                     <?php echo $row_rsDetay['Veri5']; ?>
                 </div>
                 <div class="box">
                     <?php echo $row_rsDetay['Veri6']; ?>
                 </div>
                 <div class="box">
                     <?php echo $row_rsDetay['Veri7']; ?>
                 </div>
             </div>
         </div>
     </div>
  <div class="services-page">
      <div class="container">
          <div class="s-menu" data-aos="fade-up">
              <ul>
              <?php if($row_rsDetay['BaslikTab1']){ ?>
                  <li class="active"><a href="#"><?php echo $row_rsDetay['BaslikTab1'] ?></a></li>
               <?php }?>
               <?php if($row_rsDetay['BaslikTab2']){ ?>
                  <li><a href="#"><?php echo $row_rsDetay['BaslikTab2'] ?></a></li>
               <?php }?>
               <?php if($row_rsDetay['BaslikTab3']){ ?>
                  <li><a href="#"><?php echo $row_rsDetay['BaslikTab3'] ?></a></li>
               <?php }?>
               <?php if($row_rsDetay['BaslikTab4']){ ?>
                  <li><a href="#"><?php echo $row_rsDetay['BaslikTab4'] ?></a></li>
               <?php }?>
               <?php if($row_rsDetay['BaslikTab5']){ ?>
                  <li><a href="#"><?php echo $row_rsDetay['BaslikTab5'] ?></a></li>
               <?php }?>
               </ul>
          </div>
          </div>
          <div class="services-tab">
              <?php if($row_rsDetay['BaslikTab1']){ ?>
              <div class="tab-content">
                 <span>01</span>
                  <div class="container">
                      <div class="left" data-aos="fade-right">
                          <?php echo $row_rsDetay['Veri8']; ?>
                      </div>
                  </div>
                  <div class="right" data-aos="fade-left">
                      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim3']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
                  </div>
              </div>
              <?php }?>
              <?php if($row_rsDetay['BaslikTab2']){ ?>
              <div class="tab-content">
                 <span>02</span>
                  <div class="container">
                      <div class="left">
                         <?php echo $row_rsDetay['Veri9']; ?>
                      </div>
                  </div>
                  <div class="right" >
                      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim3']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
                  </div>
              </div>
              <?php }?>
              <?php if($row_rsDetay['BaslikTab3']){ ?>
              <div class="tab-content">
                 <span>03</span>
                  <div class="container">
                      <div class="left" >
                          <?php echo $row_rsDetay['Veri10']; ?>
                      </div>
                  </div>
                  <div class="right" >
                      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim3']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
                  </div>
              </div>
              <?php }?>
              <?php if($row_rsDetay['BaslikTab4']){ ?>
              <div class="tab-content">
                 <span>04</span>
                  <div class="container">
                      <div class="left" >
                          <?php echo $row_rsDetay['Veri11']; ?>
                      </div>
                  </div>
                  <div class="right">
                      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim3']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
                  </div>
              </div>
              <?php }?>
              <?php if($row_rsDetay['BaslikTab5']){ ?>
              <div class="tab-content">
                 <span>05</span>
                  <div class="container">
                      <div class="left">
                          <?php echo $row_rsDetay['Veri12']; ?>
                      </div>
                  </div>
                  <div class="right" data-aos="fade-left">
                      <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim3']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
                  </div>
              </div>
              <?php }?>
              <div class="services-social">
                 <div class="container">
                      <ul>
                          <li><a target="_blank" class="share facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo url("hizmetler_detay",$row_rsDetay['ID']) ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-facebook"></i></a></li>
                         <li><a target="_blank" class="share twitter" href="https://twitter.com/intent/tweet?text=<?php echo strip_tags($row_rsDetay['Baslik']); ?>. <?php echo url("hizmetler_detay",$row_rsDetay['ID']) ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-twitter"></i></a></li>
                          <li><a target="_blank" class="share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo url("hizmetler_detay",$row_rsDetay['ID']) ?>&title=<?php echo strip_tags($row_rsDetay['Baslik']); ?>" data-text="Bunu Paylaş"><i class="demo-icon icon-linkedin"></i></a></li>
                          
  
                     </ul>
                 </div>
              </div>
          </div>
      
  </div>
    
     
     <?php require_once('inc/services-bottom.php'); ?>
     <?php require_once('inc/bottom-social.php'); ?>