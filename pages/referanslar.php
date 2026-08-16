<?php
$query_rsListe = i18n_select_sql('referanslar', '', 'b.SiraNo');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>

   <section class="banner">
      <img src="<?php echo $SiteURL ?>img/reference-banner.png" alt="">
      <div class="container">
          <div class="box" >
            
          <h4 data-aos="fade-down"><?php echo t('page.references') ?></h4>
          </div>
          <div class="bottom">
              <img src="<?php echo $SiteURL ?>img/arrow-bottom.png" alt="">
          </div>
      </div>
  </section>
        
        
          <div class="main-reference reference-page">
           <?php require_once('inc/social.php'); ?>

          <div class="container">
              <div class="reference-boxs">
              
               <?php if ($totalRows_rsListe > 0) do { ?>   
                  <div class="reference-box" data-aos="fade-up">
                  	<div class="first">
                  	    <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>" >
                  	</div>
                  	<div class="last">
                  	    <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim2']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                  	</div>
              	</div>
              
              <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>  
              
              
        
          </div>
      </div>
         <div class="contact-bottom">
             <img src="<?php echo $SiteURL ?>img/reference-bottom.png" alt="">
         </div>
         <div class="reference-btm">
               <?php require_once('inc/bottom-social.php'); ?>
         </div>
    </div>
