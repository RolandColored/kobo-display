<?php
error_reporting( 0 );
require 'config.php';

// date
setlocale(LC_TIME, 'de_DE.utf8');
$dateFormatted = strftime('%A, %d. %B %Y', time());

// weather
$url = 'http://api.openweathermap.org/data/2.5/weather?q='. urlencode($weatherLocation) .'&units=metric&lang=de&appid='
    . $apiKeys['openweathermap'];
$weatherData = json_decode(file_get_contents($url));

//traffic
foreach ($routes as $i => $route) {
    $url = 'https://maps.googleapis.com/maps/api/directions/json?origin=' . urlencode($route['from']) . '&destination='
        . urlencode($route['to']) . '&waypoints=via:' . urlencode($route['via']) . '&language=de&departure_time=now&key=' . $apiKeys['google'];
    $routeDatas[$i] = json_decode(file_get_contents($url));
}

