<?php
session_start();
require_once './connect.php';
$id = $_GET['id'];
$watched = $_GET['watched'];

if ($_GET['delete']=="Usuń") {
    $stmt = $connect->prepare("DELETE FROM `movies` WHERE `movies`.`id` =$id");
    $stmt->execute();
    $connect->close();
    $_SESSION['ok'] = "Usunięto pozycję z listy!";
    header("location: ../pages/");
    exit;
}

if (isset($watched)) {
    switch ($watched) {
        case 'yes':
            $stmt = $connect->prepare("UPDATE `movies` SET `watched` = '1' WHERE `movies`.`id` = $id");
                $stmt->execute();
                $connect->close();
                $_SESSION['ok'] = "Oznaczono film jako obejrzany!";
                header("location: ../pages/movie.php?movie=$id");
            break;

        case 'no':
            $stmt = $connect->prepare("UPDATE `movies` SET `watched` = '0' WHERE `movies`.`id` = $id");
                $stmt->execute();
                $connect->close();
                $_SESSION['ok'] = "Oznaczono film jako nie obejrzany!";
                header("location: ../pages/movie.php?movie=$id");
            break;
    }
}


?>