<?php 
$query_rsHizmetler = i18n_select_sql('hizmetler', '', 'b.SiraNo');
$rsHizmetler = mysqli_query($Conn, $query_rsHizmetler) or die(mysqli_error());
$row_rsHizmetler = mysqli_fetch_assoc($rsHizmetler);
$totalRows_rsHizmetler = mysqli_num_rows($rsHizmetler);
?>
<header>
       <div class="container">
           <div class="logo" >
               <a href="<?php echo sayfa_linki('anasayfa') ?>">
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
                   <form method="get" action="<?php echo sayfa_linki('arama') ?>">
	                   	<input type="text" required minlength="3" name="Title" placeholder="<?php echo t('search.placeholder') ?>">
	                   	<button><i class="icon-search"></i> <?php echo t('search.button') ?></button>
                   </form>
               </div>
           </div>
       </div>
       <nav class="language-switcher" aria-label="Language">
           <a href="<?php echo aktif_sayfa_dil_linki('tr') ?>"<?php if ($Dil === 'tr') echo ' class="active"'; ?>>TR</a>
           <?php if (dil_yayinda('en') || $Dil === 'en') { ?>
           <a href="<?php echo aktif_sayfa_dil_linki('en') ?>"<?php if ($Dil === 'en') echo ' class="active"'; ?>>EN</a>
           <?php } if (dil_yayinda('de') || $Dil === 'de') { ?>
           <a href="<?php echo aktif_sayfa_dil_linki('de') ?>"<?php if ($Dil === 'de') echo ' class="active"'; ?>>DE</a>
           <?php } ?>
       </nav>
       <div class="menu">
            <h5><?php echo t('menu') ?></h5>
            <div class="toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
       </div>
       <div class="menu-box">
           <div class="menu-list">
           <div class="list-box">
               <h4><?php echo t('menu') ?></h4>
           <ul class="first">
               <li><a href="<?php echo sayfa_linki('hakkimizda') ?>"><?php echo mb_strtoupper(t('nav.about'), 'UTF-8') ?></a></li>
               <li><a href="#" class="open"><?php echo mb_strtoupper(t('nav.services'), 'UTF-8') ?></a>
               <ul>
               <?php if ($totalRows_rsHizmetler > 0) do { ?>
                   <li>
                   	<a href="<?php echo url("hizmetler_detay",$row_rsHizmetler['ID']) ?>">
                   		<?php echo $row_rsHizmetler['Baslik']; ?>
                     </a>
                   </li>
                <?php } while ($row_rsHizmetler = mysqli_fetch_assoc($rsHizmetler)); ?>        
                    
               </ul>
               </li>
               <li><a href="<?php echo sayfa_linki('referanslar') ?>"><?php echo mb_strtoupper(t('nav.references'), 'UTF-8') ?></a></li>
               <li><a href="<?php echo sayfa_linki('haberler') ?>"><?php echo mb_strtoupper(t('nav.news'), 'UTF-8') ?></a></li>
           </ul>
           </div>
           <ul>
               <li><a href="<?php echo sayfa_linki('danismanlar') ?>"><?php echo mb_strtoupper(t('nav.consultants'), 'UTF-8') ?></a></li>
               <li><a href="<?php echo sayfa_linki('blog') ?>"><?php echo mb_strtoupper(t('nav.blog'), 'UTF-8') ?></a></li>
               <li><a href="<?php echo sayfa_linki('iletisim') ?>"><?php echo mb_strtoupper(t('nav.contact'), 'UTF-8') ?></a></li>
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
