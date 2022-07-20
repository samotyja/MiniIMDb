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
              <h1 class="m-0">Przeglądaj IMDb</h1>
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
        <form method="GET" class="mb-5">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-8 offset-md-2">
                <div class="input-group">
                  <input type="text" name="search" class="form-control form-control-lg" value="<?php if (isset($_GET['search'])) {echo $_GET['search'];} ?>">
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
                  <option disabled value="-">-</option>
                  <option disabled value="movie">Film</option>
                  <option disabled value="tvSeries">Serial</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <hr>
        <div class="">
          <div class="row">
            <?php

            if (isset($_GET['search'])) {
              $q = $_GET['search'];
              $q = preg_replace('/\s+/', '%20', $q);
              $curl = curl_init();

                curl_setopt_array($curl, [
                  CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/find?q=$q",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => [
                    "x-rapidapi-host: imdb8.p.rapidapi.com",
                    "x-rapidapi-key: 0786eb12camshacf0a2c71fd38dcp17ea5bjsn741c2f755f02"
                  ],
                ]);

              $response = curl_exec($curl);
              $err = curl_error($curl);
              curl_close($curl);

              if ($err) {
                echo "cURL Error #:" . $err;
              }

              $arr = json_decode($response, true);
              $results = $arr['results'];

              foreach ($results as $key => $value) {
                if (isset($value['title'])) {
                  if (isset($value['image']['url'])) {
                    $image = $value['image']['url'];
                  }else{
                    $image = "Brak";
                  }

                  if (strlen($value['title']) > 18) {
                    $value['title'] = substr($value['title'], -0, 20) . "...";
                  }

                  switch ($value['titleType']) {
                    case 'tvSeries':
                      $titleType = "Serial";
                      break;
                    case 'movie':
                      $titleType = "Film";
                      break;
                    default:
                      $titleType = $value['titleType'];
                      break;
                  }

                  if (($titleType == 'Serial') && (isset($value['numberOfEpisodes']))) {
                    $durationDetails = '<i class="mr-2 fas fa-sort-numeric-up"></i>'.$value['numberOfEpisodes'].' Ilość odcinków';
                  }else{
                    $durationDetails = '<i class="mr-2 fas fa-sort-numeric-up"></i>'.$value['runningTimeInMinutes'].' minut';
                  }

                  if (($titleType == 'Serial') && (isset($value['seriesEndYear']))) {
                    $yearEnd = ' - '.$value['seriesEndYear'];
                  }else{
                    $yearEnd = '';
                  }

                  $url = $value['id'];
                  $title = $value['title'];
                  $year = $value['year'];

                  //geting movie id by url
                  $id = $url;
                  $id = substr($id, 7);
                  $id = substr($id, 0, -1);

                  echo <<<DESC
                  <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                      <div class="inner">
                        <div class="row">
                          <div class="col-sm-7">
                            <h3>$title</h3>
                            <i class="mr-2 fas fa-video"></i>$titleType<br>
                            $durationDetails<br><br>
                            <i class="mr-2 fas fa-calendar"></i>$year $yearEnd</p>
                          </div>
                          <!-- <div class="col-sm-4">
                          <br>
                          <br>
                            <img src="placeholder" alt="placeholder" loading="lazy" decoding="async" width="100" height="130">
                          </div> --!>
                          <div class="col-sm-4">
                          <br>
                          <br>
                            <a href="$image" target="_blank" style="color:red;">Zdjęcie</a>
                          </div>
                        </div>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="https://www.imdb.com$url" target="_blank" class="small-box-footer">Szczegóły</a>
                      <button onclick="location.href='./add_movie.php?imdb_id=$id&name=$title'" type="button" class="btn btn-block btn-success">DODAJ</button>
                    </div>
                  </div>    
DESC;
                }
              }
            }
          

            
            ?>
          </div>
        </div>
    </div><!-- /.Main content -->
  </div><!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php require_once '../elements/footer.php' ?>

  </div><!-- ./wrapper -->
</body>

</html>