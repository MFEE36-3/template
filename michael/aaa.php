<?php

$x = random_int(1, 2);
$a = random_int(11, 13);
$b = random_int(18, 20);
$c = ($x === 1) ? $a : $b;
$booking_time = "{$c}:00";

print_r($booking_time);
