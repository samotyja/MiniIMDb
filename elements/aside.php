<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Mini IMDb</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Jakub Samotyja</a>
      </div>
    </div>
    <?php
    //active
    $url= $_SERVER['REQUEST_URI'];
    switch (true) {
      case stristr($url, 'index.php'):
        $a = "active";
        break;
      case stristr($url, 'watched.php'):
        $b = "active";
        break;
      case stristr($url, 'to_watch.php'):
        $c = "active";
        break;
      case stristr($url, 'imdb.php'):
        $d = "active";
        break;
    }
    ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Baza Filmowa
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php" class="nav-link <?php echo $a; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Strona Powitalna</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./imdb.php" class="nav-link <?php echo $d; ?>">
                <i class="far fa-circle nav-icon"></i>  
                <p>Przeglądaj IMDb</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./watched.php" class="nav-link <?php echo $b; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Obejrzane</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./to_watch.php" class="nav-link <?php echo $c; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Do obejrzenia</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
