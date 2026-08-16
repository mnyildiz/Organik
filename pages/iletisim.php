   <div class="banner-top">
       <div class="banner-title">
           
           <h4><?php echo t('contact.title') ?></h4>

       </div>
       </div>
        <?php 
			$active1 =  "";
			$active2 =  "";
			
			if(isset($_GET["maps"]) && $_GET["maps"] == "2"){
				$divMaps =  $maps2;
				$active2 =  "active";
			}else{
				$divMaps =  $maps;
				$active1 =  "active";
			}
			?>
    <div class="contact-banner">
        <div class="left" data-aos="fade-right">
            <div class="box first adress1 <?php echo $active1 ?>" style="cursor:pointer" onClick="MapsChance('1');">
                 <?php echo $Adres ?>
            </div>
            <div class="box adress2 <?php echo $active2 ?>" style="cursor:pointer" onClick="MapsChance('2');">
                 <?php echo $Adres2 ?>
            </div>
           
        </div>
        <div class="right" data-aos="fade-left" id="divMaps"><?php echo $divMaps ?></div>
           


        </div>
         
         <div class="contact-page">
             <div class="container">
                <img src="<?php echo $SiteURL ?>img/contact-bottom.png" alt="">
                 <h4><?php echo t('contact.form_title') ?></h4>
                 <form action="" method="post">
                     <div class="row">
                         <div class="col-lg-8" data-aos="fade-right">
                             <div class="form-group half">
                                <input type="text" name="AdiSoyadi" required placeholder="<?php echo t('contact.name') ?>">
                             </div>
                             <div class="form-group half h-right">
                                 <input name="Email" required type="email" placeholder="<?php echo t('contact.email') ?>">
                             </div>
                             <div class="form-group">
                                 <input type="text" name="Konu" placeholder="<?php echo t('contact.subject') ?>">
                             </div>
                             <div class="form-group">
                                 <textarea name="Mesaj" required placeholder="<?php echo t('contact.message') ?>"></textarea>
                             </div>
                             <div class="form-group">
                                 <button><?php echo t('contact.send') ?></button>
                             </div>
                         </div>
                         <div class="col-lg-4" data-aos="fade-left">
                             <div class="contact-social" >
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
                     </div>
                     <input type="hidden" name="islem" value="iletisimkaydet">
                 </form>
             </div>
         </div>
        
     
		<div class="contact-btm-social">
		    <?php require_once('inc/bottom-social.php'); ?>
		</div>
     
	 <script>
     	function MapsChance(i){
			 
			document.location = "<?php echo sayfa_linki('iletisim') ?>?maps="+i;
		}
     </script>
