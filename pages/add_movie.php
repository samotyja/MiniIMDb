<?php require_once '../elements/head.php'; ?>

<!-- BS Stepper -->
<link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">


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
              <h1 class="m-0"><?php echo $_GET['name']?></h1>
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
              <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Obejrzany?</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#information-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Notatki</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <form method="GET" action="../scripts/add_movie.php">
                      <input type="hidden" name="imdb_id" value="<?php echo $_GET['imdb_id']?>">
                    <div class="form-group">
                        <label>Obejrzany?</label>
                        <select name="watched" class="custom-select">
                          <option value="0">Nie</option>
                          <option value="1">Tak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ocena</label>
                        <select name="rate" class="custom-select">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                    </div>
                      <button class="btn btn-primary prevent" onclick="stepper.next()">Następny</button>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                    <div class="form-group">
                        <label>Notatki (max 300 znaków)</label>
                        <textarea name="notes" maxlength="300" class="form-control" rows="3" placeholder="Wpisz swoje notatki..." style="height: 114px;"></textarea>
                    </div>
                      <button class="btn btn-primary prevent" onclick="stepper.previous()">Poprzedni</button>
                      <button type="submit" class="btn btn-primary">Zapisz</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
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

    <!-- BS-Stepper -->
    <script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>

  </div>
  <!-- ./wrapper -->
</body>
<script>
    const btnStart = [...document.querySelectorAll('button.prevent')];

    for(i=0, len=btnStart.length; i<len; i++){
        btnStart[i].addEventListener('click', function(e){e.preventDefault();});
    }

    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
</script>
</html>