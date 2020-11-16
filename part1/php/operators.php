<?php
// operators.php

include_once "templateFunctions.php";
html_top("Operators");


$rand1 = rand();
$rand2 = rand();

// concatenation
echo '<p>$rand1 = ' . $rand1 . "</p>";
echo '<p>$rand1 = ' . $rand2 . "</p>";

// arithmetic
echo '<p>$rand1 + $rand2 = ' . ($rand1 + $rand2) . "</p>";
echo '<p>$rand1 % $rand2 = ' . ($rand1 % $rand2) . "</p>";
$rand1++;
echo '<p>$rand1 + 1 = ' . ($rand1) . "</p>";

// assignment
$rand2+=2;
echo '<p>$rand2 + 2 = ' . ($rand2) . "</p>";

html_bottom();
