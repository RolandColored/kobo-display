<?php
require 'config.php';

// persist
$washingFile = 'washing_timeout.txt';
if (isset($_POST['start-wash'])) {
    file_put_contents($washingFile, time() + $washingDurationMinutes[$_POST['start-wash']] * 60);
}
if (isset($_POST['stop-wash'])) {
    file_put_contents($washingFile, 0);
}

// load remaining time
$washingTimeout = file_get_contents($washingFile);
if ($washingTimeout != 0) {
    $washingReadyFormatted = date("H:i", $washingTimeout);
}

// print new controls
?>

<?php if (isset($washingReadyFormatted)): ?>
    <a stop-wash <?php if($washingTimeout < time()) echo 'class="washing-ready"'; ?> href="#"><?=$washingReadyFormatted?></a>
<?php else: ?>
    <a wash-temp="40" href="#">40°</a>
    <a wash-temp="60" href="#">60°</a>
<?php endif; ?>