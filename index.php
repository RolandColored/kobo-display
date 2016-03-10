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
        <div id="datetime">
            <p class="date"><?=$dateFormatted?></p>
            <p id="time"></p>
        </div>
        <div id="weather">
            <p class="weather-desc"><?=$weatherData->{'weather'}[0]->{'description'}?></p>
            <div class="weather-icon icon-<?=$weatherData->{'weather'}[0]->{'icon'}?>"></div>
            <p><span class="temperature"><?=intval($weatherData->{'main'}->{'temp'})?></span> <span class="unit">°C</span></p>
        </div>
    </div>


    <script type="text/javascript">
        setTimeout("location.reload(true);", 15 * 60 * 1000);

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            // add a zero in front of numbers<10
            m = checkTime(m);
            document.getElementById('time').innerHTML = h + ":" + m;
            t = setTimeout(function () {
                startTime()
            }, 500);
        }
        startTime();
    </script>

</body>
</html>