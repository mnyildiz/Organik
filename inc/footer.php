<?php 
$query_rsListe = "SELECT * FROM tablo_hizmetler ORDER BY SiraNo";
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
                       <li><a href="<?php echo $SiteURL ?>hakkimizda">Hakkımızda</a></li>
                       <li><a href="<?php echo $SiteURL ?>danismanlar">Danışmanlar</a></li>
                       <li><a href="<?php echo $SiteURL ?>referanslar">Referanslar</a></li>
                       <li><a href="<?php echo $SiteURL ?>blog">Blog</a></li>
                       <li><a href="<?php echo $SiteURL ?>haberler">Haberler & Duyurular</a></li>
                       <li><a href="<?php echo $SiteURL ?>iletisim">İletişim</a></li>
                       
                   </ul>
                   
               </div>
               <div class="col-lg-3 footer-services">
                  <h4>Hizmetlerimiz</h4>
                   <ul>
               <?php do { ?>
                   <li>
                   	<a href="<?php echo url("hizmetler_detay",$row_rsListe['ID']) ?>">
                   		<?php echo $row_rsListe['Baslik']; ?>
                     </a>
                   </li>
                <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>        
                    
               </ul>
                   
               </div>
               <div class="col-lg-5 subs">
                   <h5>Organik’ten son gelişmeler için abone ol</h5>
                   
                   <form action="" onSubmit="return false;">
                        <input type="text" id="inputeBulten" name="inputeBulten" placeholder="E-Mail Adresi">
                        <button onClick="eBulten()">Abone Ol <i class="icon-right"></i></button>
                    </form>

                   
                    
                   <p><?php echo $EmailIletisim ?></p>
               </div>
           </div>
           <div class="kvkk-box">
               <a href="<?php echo $SiteURL ?>kvkk">KVK Politikası</a>
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
                       <p>©<?php echo date("Y") ?> | Organik Danışmanlık Hizmetleri. Tüm Hakları Saklıdır.</p>
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
										<?php echo popupAlert("Hata","Geçersiz e-mail adresi girdiniz.","warning");?>
									}else if(result == "kayitli"){
										<?php echo popupAlert("Hata","Bu e-mail adresi zaten kayıtlı.","warning");?>
										
									}else{
										$("#inputeBulten").val("");
										<?php echo popupAlert("Başarılı","E-mail adresiniz kaydedildi. Bundan sonra sitemizdeki bildirimlerden haberdar olacaksınız.","success");?>
										
									}
								}
							});	
						}
                    </script>