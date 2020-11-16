<?php
// process.php

include_once "templateFunctions.php";

html_top("Day of the Week to Number");

$days = [
    '1' => 'Sunday',
    '2' => 'Monday',
    '3' => 'Tuesday',
    '4' => 'Wednesday',
    '5' => 'Thursday',
    '6' => 'Friday',
    '7' => 'Saturday'
];

$dayNumber = array_search($_POST['day'], $days);

echo "<p>$_POST[day] is day number $dayNumber of the week.</p>";

html_bottom();