<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Info Site</title>
    <link rel="stylesheet" href="style.css" />
    <?php require 'fetch_data.php' ?>
</head>
<body>

<div id="frame">
    <div id="datetime" class="half-width">
        <p class="segment-head"><?=$dateFormatted?></p>
        <p id="time"></p>
    </div>

    <div id="washing" class="half-width">
        <p class="segment-head">Waschen</p>
        <?php if (isset($washingReadyFormatted)): ?>
            <a <?php if($washingTimeout < time()) echo 'class="washing-ready"'; ?> href="?stop-wash"><?=$washingReadyFormatted?></a>
        <?php else: ?>
            <a href="?start-wash=40">40°</a>
            <a href="?start-wash=60">60°</a>
        <?php endif; ?>
    </div>
    <p style="clear: both"></p>

    <div id="weather">
        <p class="segment-head"><?=$weatherData->{'weather'}[0]->{'description'}?></p>
        <div class="weather-icon icon-<?=$weatherData->{'weather'}[0]->{'icon'}?>"></div>
        <p><span class="temperature"><?=intval($weatherData->{'main'}->{'temp'})?></span> <span class="unit">°C</span></p>
    </div>

    <div id="traffic">
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
    </div>
</div>


<script type="text/javascript">
    var lastRefresh = new Date();

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function startTime() {
        var now = new Date();
        var h = now.getHours();
        var m = now.getMinutes();
        // add a zero in front of numbers<10
        m = checkTime(m);
        document.getElementById('time').innerHTML = h + ":" + m;
        t = setTimeout(function () {
            startTime()
        }, 500);

        if ((lastRefresh.getTime() + <?=$refreshMinutes?> * 60 * 1000) < now.getTime()) {
            location.reload(true);
        }
    }
    startTime();
</script>

</body>
</html>