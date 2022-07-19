<?php require_once '../elements/head.php'; ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <?php require_once '../elements/preloader.php' ?>

    <!-- Navbar -->
    <?php require_once '../elements/nav.php' ?>

    <!-- Main Sidebar Container -->
    <?php require_once '../elements/aside.php' ?>

    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
      <div class="content-header"><!-- Content Header (Page header) -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Witaj!</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Główna</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div><!-- /.content-header -->

      <section class="content"><!-- Main content -->
        <div class="container-fluid">
          <?php
          if(isset($_SESSION['ok'])){
            echo <<<ALERT
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-check"></i> $_SESSION[ok]</h5>
            </div>
ALERT;
            unset($_SESSION['ok']);
          }
          if(isset($_SESSION['error'])){
            echo <<<ALERT
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-check"></i> $_SESSION[error]</h5>
            </div>
ALERT;
            unset($_SESSION['error']);
          }
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Dodaj film z IMDb</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="./scripts/add_movie.php" method="GET">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">ID</label>
                      <input type="text" class="form-control" placeholder="Podaj ID filmu" name="imdb_id">
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">DODAJ</button>
                  </div>
                </form>
              </div>
            </div>


            <div class="col-md-6">
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Dodaj film z FilmWeb</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Koniec adresu URL (bez /film lub /serial)</label>
                      <input type="text" disabled class="form-control" id="" placeholder="Podaj koniec adresu URL">
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" disabled class="btn btn-primary">DODAJ</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->


  <!-- Main Footer -->
  <?php require_once '../elements/footer.php' ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>