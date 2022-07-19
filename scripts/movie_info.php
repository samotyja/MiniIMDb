<?php
require_once '../scripts/connect.php';

// Dane z bazy
$sql = "SELECT * FROM `movies` WHERE id = $_GET[movie]";
$stmt = $connect->prepare("$sql");
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
$imdb_id = $row['imdb_id'];

//Dane z API IMDb
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=$imdb_id&currentcountry=US",
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

//Rok zakończenie i początku jeśli to serial
if (isset($arr['title']['seriesEndYear'])) {
    $year = $arr['title']['seriesStartYear'] . " - " . $arr['title']['seriesEndYear'];
} else {
    $year = $arr['title']['year'];
}

//Ocena w ikonach
require_once '../scripts/stars_rate.php';

//Ilość odcinków
if (isset($arr['title']['numberOfEpisodes'])) {
    $count = $arr['title']['numberOfEpisodes'];
}
?>