              <?php
                session_start();
                require_once './connect.php';
                if (isset($_GET['search'])) {
                    $like = $_GET['search'];
                    $x = "`name` LIKE '%$like%'";
                    $_SESSION['search']['like'] = $like;
                } else {
                    $x = "`name` LIKE '%$like%'";
                }
                switch ($_GET['type']) {
                    case 'movie':
                        $y = "AND `type` = 'movie'";
                        $_SESSION['search']['type'] = "movie";
                        break;
                    case 'tvSeries':
                        $y = "AND `type` = 'tvSeries'";
                        $_SESSION['search']['type'] = "tvSeries";
                        break;
                    case '-':
                        $y = "";
                        $_SESSION['search']['type'] = "-";
                        break;
                }
                switch ($_GET['sort']) {
                    case 'rate':
                        $sort = "ORDER BY `rate` DESC";
                        $_SESSION['search']['sort'] = "rate";
                        break;
                    case 'imdb_rate':
                        $sort = "ORDER BY `imdb_rate` DESC";
                        $_SESSION['search']['sort'] = "imdb_rate";
                        break;
                    case 'a-z':
                        $sort = "ORDER BY `name` ASC";
                        $_SESSION['search']['sort'] = "a-z";
                        break;
                    case 'z-a':
                        $sort = "ORDER BY `name` DESC";
                        $_SESSION['search']['sort'] = "z-a";
                        break;
                }


                $sql = "SELECT * FROM `movies` WHERE $x AND `watched`=1 $y $sort";
                $_SESSION['search']['sql'] = $sql;
                header('location: ../watched.php');
                ?>