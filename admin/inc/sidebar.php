<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!--<a href="index.php" class="brand-link">
      <img src="<?php echo $AdminURL ?>dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Yönetim Paneli</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $AdminURL ?>uploads/img/<?php echo $Resim ?>" class="img-circle elevation-2" alt="<?php echo $Adi ?>">
        </div>
        <div class="info">
          <a href="<?php echo sayfa("profilim") ?>" class="d-block">Merhaba <?php echo $Adi ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Anasayfa
                
              </p>
            </a>
            
          </li>
          
           
            <li class="nav-item">
            <a href="<?php echo sayfa("hakkimda") ?>" class="nav-link">
              <i class="far fa-building nav-icon"></i>
              <p>
                Hakkımızda
              </p>
            </a>
          
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                İçerikler
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo sayfa("haberler") ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Haberler
                      </p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="<?php echo sayfa("blog") ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Blog
                      </p>
                    </a>
                  </li>
                  
                                    <li class="nav-item">
                    <a href="<?php echo sayfa("danismanlar") ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Danışmanlar
                      </p>
                    </a>
                  </li>

          
                  <li class="nav-item">
                    <a href="<?php echo sayfa("referanslar") ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Referanslar
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo sayfa("hizmetler") ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Hizmetler
                      </p>
                    </a>
                  </li>
                  
                  
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo sayfa("ayarlar") ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Site Ayarları
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo sayfa("url") ?>" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>Sayfa URL ve SEO</p>
            </a>
          </li>
          
          
          
          
          
          <li class="nav-item">
            <a href="<?php echo sayfa("iletisim_bilgileri") ?>" class="nav-link">
              <i class="nav-icon fas fa-fax"></i>
              <p>
                İletişim Bilgileri
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo sayfa("ebulten") ?>" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                E-Bülten
                
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo sayfa("iletisim_mesajlari") ?>" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                İletişim Mesajları
                
              </p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="<?php echo sayfa("slider") ?>" class="nav-link">
              <i class="nav-icon fas fa-play"></i>
              <p>
                Slayt Gösterisi
              </p>
            </a>
          </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
