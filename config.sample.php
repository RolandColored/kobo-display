<?php

$refreshMinutes = 15;

$washingDurationMinutes = array(
    40 => 80,
    60 => 120
);

$apiKeys = array(
    'openweathermap' => 'YOUR_KEY',
    'google' => 'YOUR_KEY',
);

$weatherLocation = 'London,uk';

$routes = array(
    array('description' => '1st Route', 'jamThreshold' => 1500, 'from' => 'START_LOC', 'via' => 'WAYPOINTS', 'to' => 'DESTINATION_LOC'),
);