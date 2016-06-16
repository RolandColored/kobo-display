var lastRefresh = new Date();

// auto refresh and time
function padWithZeros(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime(refreshMinutes) {
    var now = new Date();
    var h = now.getHours();
    var m = now.getMinutes();
    // add a zero in front of numbers<10
    m = padWithZeros(m);
    document.getElementById('time').innerHTML = h + ":" + m;
    t = setTimeout(function () {
        startTime()
    }, 500);

    if ((lastRefresh.getTime() + refreshMinutes * 60 * 1000) < now.getTime()) {
        lastRefresh = new Date();
        location.reload(true);
    }
}

// washing control
$.get('washing.php', function(data) {
    $('#washing-control').html(data);
    activateWashingControls();
});

function activateWashingControls() {
    var washingControl = $('#washing-control');

    washingControl.find('a[wash-temp]').click(function (e) {
        $('#washing-control').html("...");
        $.post('washing.php', {'start-wash': $(e.target).attr('wash-temp')}, function(data) {
            $('#washing-control').html(data);
            activateWashingControls();
        });
    });

    washingControl.find('a[stop-wash]').click(function () {
        $('#washing-control').html("...");
        $.post('washing.php', {'stop-wash': true}, function(data) {
            $('#washing-control').html(data);
            activateWashingControls();
        });
    });
}
