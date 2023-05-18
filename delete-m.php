<?php

require './connect_team3_db.php';

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

$sql = "DELETE FROM booking WHERE booking_id={$booking_id}";

$pdo->query($sql);

$comeFrom = 'booking.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location: ' . $comeFrom);
