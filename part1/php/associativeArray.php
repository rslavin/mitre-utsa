<?php
// associativeArray.php

include_once "templateFunctions.php";
html_top("Day of Week Converter");

$days = [
    '1' => 'Sunday',
    '2' => 'Monday',
    '3' => 'Tuesday',
    '4' => 'Wednesday',
    '5' => 'Thursday',
    '6' => 'Friday',
    '7' => 'Saturday'
];

$dayNumber = rand(1, 7);

echo "<p>$dayNumber corresponds to $days[$dayNumber].</p>";

html_bottom();
