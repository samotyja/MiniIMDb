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
                            <?php require_once '../scripts/movie_info.php';?>
                            <h1 class="m-0"><?php echo $row['name'] ?></h1>
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
                    if (isset($_SESSION['ok'])) {
                        echo <<<ALERT
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> $_SESSION[ok]</h5>
                        </div>
        ALERT;
                        unset($_SESSION['ok']);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img src="<?php echo $row['icon']; ?>" alt="<?php echo $row['name']; ?>" loading="lazy" decoding="async" width="350" height="450">
                                        <hr>
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>

                                    <p class="text-muted text-center"><?php echo $year; ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Ocena własna: </b>
                                            <span class="float-right" style="color:yellow"><?php echo $myRate; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Ocena IMDb: </b>
                                            <span class="float-right" style="color:yellow"><?php echo $IMDbRate; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Dodano: </b> <a class="float-right"><?php echo $row['date']; ?></a>
                                        </li>
                                    </ul>
                                    <form action="../scripts/movie_action.php" method="GET" class="row">
                                        <?php
                                        if ($row['watched'] == 0) {
                                            echo <<<BUTTON
                                            <div class="col-sm-6">
                                                <input type="hidden" name="id" value="$row[id]">
                                                <input type="hidden" name="watched" value="yes">
                                                <input type="submit" value="Obejrzane" class="btn btn-primary btn-block">
                                            </div>
        BUTTON;
                                        } else {
                                            echo <<<BUTTON
                                            <div class="col-sm-6">
                                                <input type="hidden" name="id" value="$row[id]">
                                                <input type="hidden" name="watched" value="no">
                                                <input type="submit" value="Nie Obejrzane" class="btn btn-primary btn-block">
                                            </div>
        BUTTON;
                                        }
                                        ?>
                                        <div class="col-sm-6">
                                            <input type="submit" value="Usuń" name="delete" class="btn btn-danger btn-block">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Szczegóły</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-clock mr-1"></i> Czas trwania filmu/jednego odcinka: </strong>
                                    <?php
                                    if (isset($arr['title']['runningTimeInMinutes'])) {
                                        $time = $arr['title']['runningTimeInMinutes'];
                                    }else{
                                        $time = "Brak danych";
                                    }
                                    ?>
                                    <p class="text-muted"><?php echo $time ?></p>

                                    <hr>
                                    <?php
                                    if ($arr['title']['titleType'] == "tvSeries") {
                                        echo <<<EPISODES
                                        <strong><i class="far fa-hourglass mr-1"></i> Ilość odcinków: </strong>

                                        <p class="text-muted">$count odcinki</p>
                                    
                                        <hr>
        EPISODES;
                                    }

                                    ?>

                                    <strong><i class="fas fa-theater-masks mr-1"></i> Typ: </strong>

                                    <p class="text-muted"><?php foreach ($arr['genres'] as $key) {
                                                                echo $key . ", ";
                                                            } ?></p>

                                    <hr>

                                    <strong><i class="far fa-file-alt mr-1"></i> Notatki</strong>

                                    <p class="text-muted"><?php echo $row['notes']; ?></p>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane">
                                            <!-- Post -->
                                            <?php
                                            if (isset($arr['plotOutline'])) {
                                                $plot_outline_text = $arr['plotOutline']['text'];
                                                echo <<<POST
                                                <div class="post">
                                                    <a href="#">Streszczenie</a>
                                                    <p>$plot_outline_text</p>
                                                </div>
        POST;
                                            }

                                            if (isset($arr['plotSummary'])) {
                                                $plot_summary_text = $arr['plotSummary']['text'];
                                                echo <<<POST
                                                <div class="post">
                                                    <a href="#">Przesłanka</a>
                                                    <p>$plot_summary_text</p>
                                                </div>
        POST;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div><!-- /.container-fluid -->
            </section><!-- /.content -->      
        </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php require_once '../elements/footer.php' ?>
    </div><!-- ./wrapper -->
</body>

</html>