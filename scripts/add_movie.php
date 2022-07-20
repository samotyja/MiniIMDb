<?php
session_start();

$imdb_id = $_GET['imdb_id'];

//API start

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=$imdb_id&currentCountry=US",
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
    $_SESSION['error'] = "cURL Error #:" . $err;;
    header("location: ../");
} else {
    
    //JSON to array
    $arrmovie = json_decode($response, true);
    $name = $arrmovie['title']['title'];
    $year = $arrmovie['title']['year'];
    $titleType = $arrmovie['title']['titleType'];
    $image = $arrmovie['title']['image']['url'];
    if (isset($arrmovie['ratings']['rating'])) {
        $imdbRate = $arrmovie['ratings']['rating'];
    }else{
        $imdbRate = 0;
    }
    $watched = $_GET['watched'];
    $userRate = $_GET['rate'];
    $userNotes = $_GET['notes'];

   
    
    require_once './connect.php';
    $sql = "INSERT INTO `movies` (`imdb_id`, `name`, `year`, `type`, `icon`, `imdb_rate`, `watched`, `rate`, `notes`) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssssss", $imdb_id, $name, $year, $titleType, $image, $imdbRate, $watched, $userRate, $userNotes);
    if ($stmt->execute()) {
        $_SESSION['ok'] = 'Dodano film "' . $arrmovie['title']['title'] . '" z ' . $arrmovie['title']['year'] . " roku!";
        $connect->close();
        header("location: ../");
        exit();
    } else {
        $_SESSION['error'] = "Wystopił błąd przy dodawaniu filmu do bazy :c";
        header("location: ../");
    }
}
?>