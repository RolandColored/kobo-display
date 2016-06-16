<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Info Site</title>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="jquery-3.0.0.min.js"></script>
    <?php require 'fetch_data.php' ?>
</head>
<body>

<div id="frame">
    <table>
        <tr>
            <td id="datetime" colspan="2">
                <p class="segment-head"><?=$dateFormatted?></p>
                <p id="time"></p>
            </td>
        </tr>
        
        <tr>
            <td id="weather" colspan="2">
                <div class="current-weather">
                    <p class="segment-head"><?=$currentWeather->{'current_observation'}->{'weather'}?></p>
                    <p>
                        <img class="weather-icon" src="http://icons.wxug.com/i/c/i/<?=$currentWeather->{'current_observation'}->{'icon'}?>.gif" />
                        <span class="temperature"><?=intval($currentWeather->{'current_observation'}->{'temp_c'})?></span> <span class="unit">°C</span><br /><br />
                        <span class="humidity-label">Luftfeuchtigkeit:</span> <span class="humidity-value"><?=$currentWeather->{'current_observation'}->{'relative_humidity'}?></span>
                    </p>
                </div>
                <?php
                $i = 1;
                foreach ($forecastWeather->{'hourly_forecast'} as $forecast):
                    if ($i % 3 == 0):
                ?>
                    <p class="forecast">
                        <?=$forecast->{'FCTTIME'}->{'hour'}?> Uhr
                        <img class="weather-icon" style="width: 30px;" src="http://icons.wxug.com/i/c/i/<?=$forecast->{'icon'}?>.gif" />
                    </p>
                <?php
                    endif;
                    $i++;
                    if ($i > 12):
                        break;
                    endif;
                endforeach;
                ?>
            </td>
        </tr>
    
        <tr>
            <td id="washing">
                <p class="segment-head">Waschen</p>
                <div id="washing-control"></div>
            </td>
    
            <td id="traffic">
                <p class="segment-head">Verkehrslage</p>
                <table>
                    <?php
                    foreach ($routeDatas as $key => $routeData):
                        $durationSec = $routeData->{'routes'}[0]->{'legs'}[0]->{'duration_in_traffic'}->{'value'};
                        $jamClass = $durationSec > $routes[$key]['jamThreshold'] ? 'jam-warner' : '';
                        echo '<tr><td>'. $routes[$key]['description'] .'</td>';
                        echo '<td class="mins">'. round($durationSec / 60) .'</td>';
                        echo '<td>min</td>';
                        echo '<td class="'. $jamClass .'"><div></div><div></div></td></tr>';
                    endforeach;
                    ?>
                </table>
            </td>
        </tr>

    </table>
</div>

<script type="text/javascript" src="scripts.js"></script>
<script type="text/javascript">
    startTime(<?=$refreshMinutes?>);
</script>

</body>
</html>