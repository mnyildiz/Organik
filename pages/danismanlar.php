<?php
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
       <div class="counselor-comment">
           <div class="comment">
               <div class="left">
                   <img class="top" src="<?php echo $SiteURL ?>img/comment-top.png" alt="">
                   <?php echo $row_rsMetinler['Metin7']; ?>
                    <img class="bottom" src="<?php echo $SiteURL ?>img/comment-bottom.png" alt="">
               </div>
               <div class="right">
                   <?php echo $row_rsMetinler['Metin8']; ?>
               </div>
           </div>
       </div>
  
        <div class="counselor-page">
            <?php require_once('inc/social.php'); ?>

            <div class="container">
                <div class="row">
                
                <?php do { ?>    
                
                <div class="col-lg-3" data-aos="fade-up">
                    <div class="c-box">
                        <a href="<?php echo url("danismanlar_detay",$row_rsListe['ID']) ?>">
                            <img src="<?php echo $SiteURL ?>uploads/<?php echo $row_rsListe['Resim']; ?>" alt="<?php echo $row_rsListe['Baslik']; ?>">
                        <div class="filter">
                            <div class="text">
                                <h4><?php echo $row_rsListe['Baslik']; ?></h4>
                                <p><?php echo $row_rsListe['Unvan']; ?></p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>   
             </div>
            </div>
        </div>
 <?php require_once('inc/bottom-social.php'); ?>