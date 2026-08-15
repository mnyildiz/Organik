<?php

$query_rsListe = "SELECT * FROM tablo_referanslar ORDER BY SiraNo LIMIT 10";
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
<div class="bottom-social">
         <div class="container">
             <ul>
				<?php if ($facebook){ ?>
                <li><a href="<?php echo $facebook ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                <?php }?>
                <?php if ($linkedin){ ?>
                <li><a href="<?php echo $linkedin ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                <?php }?>
                <?php if ($twitter){ ?>
                <li><a href="<?php echo $twitter ?>" target="_blank"><i class="icon-twitter"></i></a></li>
                <?php }?>
                <?php if ($instagram){ ?>
                <li><a href="<?php echo $instagram ?>" target="_blank"><i class="icon-instagram"></i></a></li>
                <?php }?>
                <?php if ($youtube){ ?>
                <li><a href="<?php echo $youtube ?>" target="_blank"><i class="icon-youtube-play"></i></a></li>
                <?php }?>
                </ul>
         </div>
     </div>
     
     <div class="main-reference">
          <div class="container">
              <div class="reference-boxs">
              
               <?php do { ?>   
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
      </div>