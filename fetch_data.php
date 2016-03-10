<?php
error_reporting( E_ALL );
require 'config.php';

// date
setlocale(LC_TIME, "de_DE.utf8");
$dateFormatted = strftime("%A, %d. %B %Y", time());

// weather
$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $location . "&units=metric&lang=de&appid=" . $apiKeys["openweathermap"];
$weatherData = json_decode(file_get_contents($url));
