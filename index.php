<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kobo</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

    <div id="frame">
        <div id="inner">
            <?php
            setlocale(LC_TIME, "de_DE.utf8");
            echo strftime("%A, %d. %B %Y", time());
            ?>
            <p id="time"></p>
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