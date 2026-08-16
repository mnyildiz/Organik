<?php 
$query_rsListe = i18n_select_sql('hizmetler', '', 'b.SiraNo');
$rsListe = mysqli_query($Conn, $query_rsListe) or die(mysqli_error());
$row_rsListe = mysqli_fetch_assoc($rsListe);
$totalRows_rsListe = mysqli_num_rows($rsListe);
?>
<footer>
       <div class="container">
           <div class="row">
               <div class="col-lg-2 left">
                   <img src="<?php echo $SiteURL ?>img/footer-logo.svg" alt="">
                   
               </div>
               <div class="col-lg-2">
                   <ul>
                       <li><a href="<?php echo sayfa_linki('hakkimizda') ?>"><?php echo t('nav.about') ?></a></li>
                       <li><a href="<?php echo sayfa_linki('danismanlar') ?>"><?php echo t('nav.consultants') ?></a></li>
                       <li><a href="<?php echo sayfa_linki('referanslar') ?>"><?php echo t('nav.references') ?></a></li>
                       <li><a href="<?php echo sayfa_linki('blog') ?>"><?php echo t('nav.blog') ?></a></li>
                       <li><a href="<?php echo sayfa_linki('haberler') ?>"><?php echo t('nav.news_long') ?></a></li>
                       <li><a href="<?php echo sayfa_linki('iletisim') ?>"><?php echo t('nav.contact') ?></a></li>
                       
                   </ul>
                   
               </div>
               <div class="col-lg-3 footer-services">
                  <h4><?php echo t('nav.services') ?></h4>
                   <ul>
               <?php if ($totalRows_rsListe > 0) do { ?>
                   <li>
                   	<a href="<?php echo url("hizmetler_detay",$row_rsListe['ID']) ?>">
                   		<?php echo $row_rsListe['Baslik']; ?>
                     </a>
                   </li>
                <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>        
                    
               </ul>
                   
               </div>
               <div class="col-lg-5 subs">
                   <h5><?php echo t('footer.subscribe_title') ?></h5>
                   
                   <form action="" onSubmit="return false;">
                        <input type="text" id="inputeBulten" name="inputeBulten" placeholder="<?php echo t('footer.email_placeholder') ?>">
                        <button onClick="eBulten()"><?php echo t('footer.subscribe') ?> <i class="icon-right"></i></button>
                    </form>

                   
                    
                   <p><?php echo $EmailIletisim ?></p>
               </div>
           </div>
           <div class="kvkk-box">
               <a href="<?php echo sayfa_linki('kvkk') ?>"><?php echo t('footer.privacy') ?></a>
           </div>
           <div class="footer-social">
               <div class="left">
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
                <div class="right">
                       <p>©<?php echo date("Y") ?> | <?php echo t('footer.copyright') ?></p>
                   </div>
           </div>
       </div>
   </footer>
   <script>
                    	function eBulten(){
							$.ajax({
								url:"<?php echo $SiteURL ?>inc/eBulten.php",
								type:"POST",
								data:"EbultenEmail="+$("#inputeBulten").val(),
								success: function(result){
									if(result == "gecersiz"){
										<?php echo popupAlert(t('newsletter.invalid_title'),t('newsletter.invalid'),"warning");?>
									}else if(result == "kayitli"){
										<?php echo popupAlert(t('newsletter.invalid_title'),t('newsletter.exists'),"warning");?>
										
									}else{
										$("#inputeBulten").val("");
										<?php echo popupAlert(t('newsletter.success_title'),t('newsletter.success'),"success");?>
										
									}
								}
							});	
						}
                    </script>
