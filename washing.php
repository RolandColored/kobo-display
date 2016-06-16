<?php
require 'config.php';

file_put_contents("log.txt", print_r($_SERVER, true).print_r($_REQUEST, true));

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
    <a class="washing-stop <?php if($washingTimeout < time()) echo 'washing-ready'; ?>" href="#"><?=$washingReadyFormatted?></a>
<?php else: ?>
    <a class="washing-start" href="40">40°</a>
    <a class="washing-start" href="60">60°</a>
<?php endif; ?>