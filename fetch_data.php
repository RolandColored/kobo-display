<?php
require 'config.php';

// date
setlocale(LC_TIME, 'de_DE.utf8');
$dateFormatted = strftime('%A, %d. %B %Y', time());

// weather
$url = 'http://api.wunderground.com/api/' . $apiKeys['wunderground'] .'/conditions/lang:DL/q/CA/' . urlencode($weatherLocation) . '.json';
$currentWeather = json_decode(file_get_contents($url));

$url = 'http://api.wunderground.com/api/' . $apiKeys['wunderground'] .'/hourly/lang:DL/q/CA/' . urlencode($weatherLocation) . '.json';
$forecastWeather = json_decode(file_get_contents($url));


//traffic
foreach ($routes as $i => $route) {
    $url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . urlencode($route['from']) . '&destination='
        . urlencode($route['to']) . '&waypoints=via:' . urlencode($route['via']) . '&language=de&departure_time=now&key=' . $apiKeys['google'];
    $routeDatas[$i] = json_decode(file_get_contents($url));
}

