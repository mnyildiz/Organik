<?php 
$query_rsListe = i18n_select_sql('hizmetler', '', 'b.SiraNo', '9');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
<div class="services-bottom" data-aos="fade-up">
         <div class="swiper mySwiper">
             <div class="swiper-wrapper">
                  <?php if ($totalRows_rsListe > 0) do { ?>
             <div class="swiper-slide">
             <div class="box">
                 <a href="<?php echo url("hizmetler_detay",$row_rsListe['ID']) ?>">
                     <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                 <div class="s-box">
                     <h4><?php echo $row_rsListe['Baslik2']; ?></h4>
                 </div>
                 </a>
             </div>
</div>
			 <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?> 
             </div>
         </div>
			 
            
              
     </div>
