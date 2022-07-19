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
              <h1 class="m-0">Do obejrzenia</h1>
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
        <form action="../scripts/search_no_watched.php" method="GET">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-8 offset-md-2">
                <div class="input-group">
                  <input type="text" name="search" class="form-control form-control-lg" value="<?php if (isset($_SESSION['search']['like'])) {echo $_SESSION['search']['like'];} ?>">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row offset-md-2">
              <div class="col-sm-1">
                <label>Typ:</label>
                <select onchange="this.form.submit()" name="type" class="form-control">
                  <option value="-" <?php if (isset($_SESSION['search']['type']) && $_SESSION['search']['type'] == "-") {
                                      echo "selected";
                                    } ?>>-</option>
                  <option value="movie" <?php if (isset($_SESSION['search']['type']) && $_SESSION['search']['type'] == "movie") {
                                          echo "selected";
                                        } ?>>Film</option>
                  <option value="tvSeries" <?php if (isset($_SESSION['search']['type']) && $_SESSION['search']['type'] == "tvSeries") {
                                              echo "selected";
                                            } ?>>Serial</option>
                </select>
              </div>
              <div class="col-sm-2">
                <label>Sortowanie:</label>
                <select onchange="this.form.submit()" name="sort" class="form-control">
                  <option value="rate" <?php if (isset($_SESSION['search']['sort']) && $_SESSION['search']['sort'] == "rate") {
                                          echo "selected";
                                        } ?>>Ocena Własna</option>
                  <option value="imdb_rate" <?php if (isset($_SESSION['search']['sort']) && $_SESSION['search']['sort'] == "imdb_rate") {
                                              echo "selected";
                                            } ?>>Ocena IMDb</option>
                  <option value="a-z" <?php if (isset($_SESSION['search']['sort']) && $_SESSION['search']['sort'] == "a-z") {
                                        echo "selected";
                                      } ?>>A-Z</option>
                  <option value="z-a" <?php if (isset($_SESSION['search']['sort']) && $_SESSION['search']['sort'] == "z-a") {
                                        echo "selected";
                                      } ?>>Z-A</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <br>
        <hr>
        <div class="">
          <div class="row">
            <?php
            require_once '../scripts/connect.php';
            if (isset($_SESSION['search'])) {
              $sql = $_SESSION['search']['sql'];
              $stmt = $connect->prepare("$sql");
              $stmt->execute();
              unset($_SESSION['search']);
            } else {
              $stmt = $connect->prepare("SELECT * FROM `movies` WHERE `watched`=0 ORDER BY `imdb_rate` DESC");
              $stmt->execute();
            }
            $result = $stmt->get_result();
            while ($row = mysqli_fetch_assoc($result)) {
              if (strlen($row['name']) > 18) {
                $name = substr($row['name'], -0, 20) . "...";
              } else {
                $name = $row['name'];
              }
              switch ($row['type']) {
                case 'tvSeries':
                  $type = "Serial";
                  break;

                default:
                  $type = "Film";
                  break;
              }
              echo <<<DESC
                <div class="col-lg-3 col-6">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <div class="row">
                        <div class="col-sm-7">
                          <h3>$name</h3>
                          <p><i class="fas fa-star"></i> - $row[imdb_rate]   IMDb<br><i class="fas fa-grin-stars"></i> - $row[rate] Własna</p>
                          <p><i class="fas fa-video"></i> - $type<br><i class="fas fa-calendar"></i> - $row[year]</p>
                        </div>
                        <!-- <div class="col-sm-4">
                        <br>
                        <br>
                          <img src="$row[icon]" alt="$row[name]" loading="lazy" decoding="async" width="100" height="130">
                        </div> --!>
                        <div class="col-sm-4">
                        <br>
                        <br>
                          <a href="$row[icon]" target="_blank" style="color:red;">Zdjęcie</a>
                        </div>
                      </div>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="movie.php?movie=$row[id]" class="small-box-footer">Szczegóły</a>
                  </div>
                </div>    
DESC;
            }
            ?>
          </div>
        </div>
    </div>
   </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->


  <!-- Main Footer -->
  <?php require_once '../elements/footer.php' ?>
  </div>
  <!-- ./wrapper -->
</body>

</html>