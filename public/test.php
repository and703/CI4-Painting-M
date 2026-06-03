<?php
$minutes = 3000;
$hour = 250;
//
// Assuming that your minutes value is $minutes
//
$d = floor ($minutes / 1440);
$h = floor (($minutes - $d * 1440) / 60);
$m = $minutes - ($d * 1440) - ($h * 60);

$d1 = floor ($hour / 24);
$h1 = floor ($hour - $d * 24);
$m1 = $hour - ($d1 * 24) / 60;
//
// Then you can output it like so...
//
echo "{$hour}h";
echo "<br>converts to {$d1}d {$h1}h {$m1}m";