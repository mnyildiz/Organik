<?php 
$query_rsHizmetler = "SELECT * FROM tablo_hizmetler ORDER BY SiraNo";
$rsHizmetler = mysqli_query($Conn, $query_rsHizmetler) or die(mysqli_error());
$row_rsHizmetler = mysqli_fetch_assoc($rsHizmetler);
$totalRows_rsHizmetler = mysqli_num_rows($rsHizmetler);
?>
<header>
       <div class="container">
           <div class="logo" >
               <a href="<?php echo $SiteURL ?>">
                   <img src="<?php echo $SiteURL ?>img/logo.svg" alt="">
               </a>
           </div>
           <div class="search">
               <i class="icon-search"></i>
           </div>
           <div class="search-box">
              <div class="clos">
                  <i class="icon-cancel"></i>
              </div>
               <div class="content">
                   <form method="get" action="<?php echo $SiteURL ?>arama">
                   	<input type="text" required minlength="3" name="Title" placeholder="Sitede Arayın...">
                   	<button><i class="icon-search"></i> ARA</button>
                   </form>
               </div>
           </div>
       </div>
       <div class="menu">
            <h5>MENU</h5>
            <div class="toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
       </div>
       <div class="menu-box">
           <div class="menu-list">
           <div class="list-box">
               <h4>MENU</h4>
           <ul class="first">
               <li><a href="<?php echo $SiteURL ?>hakkimizda">HAKKIMIZDA</a></li>
               <li><a href="#" class="open">HİZMETLERİMİZ</a>
               <ul>
               <?php do { ?>
                   <li>
                   	<a href="<?php echo url("hizmetler_detay",$row_rsHizmetler['ID']) ?>">
                   		<?php echo $row_rsHizmetler['Baslik']; ?>
                     </a>
                   </li>
                <?php } while ($row_rsHizmetler = mysqli_fetch_assoc($rsHizmetler)); ?>        
                    
               </ul>
               </li>
               <li><a href="<?php echo $SiteURL ?>referanslar">REFERANSLAR</a></li>
               <li><a href="<?php echo $SiteURL ?>haberler">HABERLER</a></li>
           </ul>
           </div>
           <ul>
               <li><a href="<?php echo $SiteURL ?>danismanlar">DANIŞMANLAR</a></li>
               <li><a href="<?php echo $SiteURL ?>blog">BLOG</a></li>
               <li><a href="<?php echo $SiteURL ?>iletisim">İLETİŞİM</a></li>
           </ul>
           <div class="bottom">
              <img src="<?php echo $SiteURL ?>img/blog-logo.png" alt="">
               <a href="mailto:<?php echo $EmailIletisim ?>"><?php echo $EmailIletisim ?></a>
           </div>
       </div>
       <div class="menu-social">
       
       <ul>
		<?php if ($facebook){ ?>
        <li><a href="<?php echo $facebook ?>" target="_blank"><i class="icon-facebook"></i></a><span>FACEBOOK</span></li>
        <?php }?>
        <?php if ($linkedin){ ?>
        <li><a href="<?php echo $linkedin ?>" target="_blank"><i class="icon-linkedin"></i></a><span>LINKEDIN</span></li>
        <?php }?>
        <?php if ($twitter){ ?>
        <li><a href="<?php echo $twitter ?>" target="_blank"><i class="icon-twitter"></i></a><span>TWITTER</span></li>
        <?php }?>
        <?php if ($instagram){ ?>
        <li><a href="<?php echo $instagram ?>" target="_blank"><i class="icon-instagram"></i></a><span>INSTAGRAM</span></li>
        <?php }?>
        <?php if ($youtube){ ?>
        <li><a href="<?php echo $youtube ?>" target="_blank"><i class="icon-youtube-play"></i></a><span>YOUTUBE</span></li>
        <?php }?>
</ul>
            
       </div>
       </div>
   </header>