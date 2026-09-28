<?php

$query_rsListe = i18n_select_sql('referanslar', '', 'b.SiraNo, b.ID');
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
     
      <?php if ($totalRows_rsListe > 0) { ?>
      <div class="main-reference">
          <div class="container">
              <div class="reference-boxs reference-carousel" aria-label="<?php echo t('page.references') ?>">
                  <div class="swiper reference-swiper">
                      <div class="swiper-wrapper">
                          <?php $referansIndex = 0; do { ?>
                          <?php if ($referansIndex % 10 === 0) { ?>
                          <div class="swiper-slide"><div class="reference-grid">
                          <?php } ?>
                              <div class="reference-box">
                                  <div class="reference-logo">
                                      <img src="<?php echo $SiteURL ?>uploads/<?php echo htmlspecialchars(!empty($row_rsListe['Resim2']) ? $row_rsListe['Resim2'] : $row_rsListe['Resim'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars((string) $row_rsListe['Baslik'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                                  </div>
                              </div>
                          <?php $referansIndex++; if ($referansIndex % 10 === 0 || $referansIndex === $totalRows_rsListe) { ?>
                          </div></div>
                          <?php } ?>
                          <?php } while ($row_rsListe = mysqli_fetch_assoc($rsListe)); ?>
                      </div>
                  </div>
                  <?php if ($totalRows_rsListe > 10) { ?>
                  <button type="button" class="reference-prev" aria-label="<?php echo t('references.previous') ?>"><i class="icon-right" aria-hidden="true"></i></button>
                  <button type="button" class="reference-next" aria-label="<?php echo t('references.next') ?>"><i class="icon-right" aria-hidden="true"></i></button>
                  <?php } ?>
              </div>
          </div>
      </div>
      <?php } ?>
