<?php 
$query_rsDetay = sprintf("SELECT * FROM tablo_danismanlar WHERE ID = %s", escape($ID, "int"));
$rsDetay = mysqli_query($Conn, $query_rsDetay) or die(mysqli_error($Conn));
$row_rsDetay = mysqli_fetch_assoc($rsDetay);
$totalRows_rsDetay = mysqli_num_rows($rsDetay);
 
$query_rsListe = "SELECT * FROM tablo_danismanlar ORDER BY SiraNo";
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
 ?>
   <div class="banner-top">
       <div class="banner-title">
           <h4>DANIŞMANLAR</h4>
       </div>
       </div>
      <div class="counselor-top">
          <?php require_once('inc/social.php'); ?>

          <div class="row">
              <div class="col-lg-8">
                  <div class="left">
              <div class="name">
                  	<h2><?php echo $row_rsDetay['Baslik']; ?></h2>
              		<p><?php echo $row_rsDetay['Unvan']; ?></p>
              </div>
              <div class="box" data-aos="fade-up">
                  <h5><a href="mailto:<?php echo $row_rsDetay['Veri2']; ?>"><img src="<?php echo $SiteURL ?>img/envelope.svg" alt=""> <span><?php echo $row_rsDetay['Veri2']; ?> </span></a></h5>
                  <h5><img src="<?php echo $SiteURL ?>img/phone.svg" alt=""> <span><?php echo $row_rsDetay['Veri1']; ?> </span></h5>
              </div>
              <div class="box education" data-aos="fade-up">
                <img class="bottom" src="<?php echo $SiteURL ?>img/arrow-bottom.png" alt="">
                 <div class="icon">
                     <img src="<?php echo $SiteURL ?>img/egitim.svg" alt="">
                     <p>Eğitim</p>
                 </div>
                 <div class="content">
                     <?php echo $row_rsDetay['Veri3']; ?>
                 </div>
                 
              </div>
              <?php if( $row_rsDetay['Veri4'] !=""){ ?>
             <div class="box" data-aos="fade-up">
                 <div class="icon">
                     <img src="<?php echo $SiteURL ?>img/sertifika.svg" alt="">
                     <p>Sertifikalar</p>
                 </div>
                 <div class="content">
                        <?php echo $row_rsDetay['Veri4']; ?>
                     </div>
              </div>
              <?php }?>
              <?php if( $row_rsDetay['Veri5'] !=""){ ?>
              <div class="box" data-aos="fade-up">
                 <div class="icon">
                     <img src="<?php echo $SiteURL ?>img/uzman.svg" alt="">
                     <p>Uzmanlık <br>Alanları</p>
                 </div>
                 <div class="content">
                    <?php echo $row_rsDetay['Veri5']; ?>
                 </div>
              </div>
              <?php }?>
              <?php if( $row_rsDetay['Veri6'] !=""){ ?>
              <div class="box last" data-aos="fade-up">
                 <div class="icon">
                     <img src="<?php echo $SiteURL ?>img/proje.svg" alt="">
                     <p>Yer Aldığı <br>Projeler</p>
                 </div>
                 <div class="content">
                    <?php echo $row_rsDetay['Veri6']; ?>
                 </div>
              </div>
              <?php }?>
          </div>
              </div>
              <div class="col-lg-4">
                  <div class="right" data-aos="fade-left">
              <div class="img">
                  <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsDetay['Resim']; ?>" alt="<?php echo $row_rsDetay['Baslik']; ?>">
              <div class="filter"></div>
              </div>
              <div class="counselor-menu">
                 <h3>DANIŞMANLAR<span>+</span></h3>
                  <ul>
                  <?php do { ?> 
                      <li>
                      		<a href="<?php echo url("danismanlar_detay",$row_rsListe['ID']) ?>">
					  			<?php echo $row_rsListe['Baslik']; ?>
                        	</a>
                        </li>
                      <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>   
                       
                  </ul>
              </div>
          </div>
             
              </div>
          </div>
          
      </div>
  
      <?php require_once('inc/bottom-social.php'); ?>