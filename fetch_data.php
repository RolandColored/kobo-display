<?php
error_reporting( 0 );
require 'config.php';

// date
setlocale(LC_TIME, 'de_DE.utf8');
$dateFormatted = strftime('%a, %d.%m.%Y', time());

// washing
$washingFile = 'washing_timeout.txt';
if (isset($_GET['start-wash'])) {
    file_put_contents($washingFile, time() + $washingDurationMinutes[$_GET['start-wash']] * 60);
    clearPath();
}
if (isset($_GET['stop-wash'])) {
    file_put_contents($washingFile, 0);
    clearPath();
}
$washingTimeout = file_get_contents($washingFile);
if ($washingTimeout != 0) {
    $washingReadyFormatted = date("H:i", $washingTimeout);
}

// weather
$url = 'http://api.wunderground.com/api/' . $apiKeys['wunderground'] .'/conditions/lang:DL/q/CA/' . urlencode($weatherLocation) . '.json';
$weatherData = json_decode(file_get_contents($url));

//traffic
foreach ($routes as $i => $route) {
    $url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . urlencode($route['from']) . '&destination='
        . urlencode($route['to']) . '&waypoints=via:' . urlencode($route['via']) . '&language=de&departure_time=now&key=' . $apiKeys['google'];
    $routeDatas[$i] = json_decode(file_get_contents($url));
}


function clearPath() {
    header("Location: ".$_SERVER['SCRIPT_NAME']);
    die();
}