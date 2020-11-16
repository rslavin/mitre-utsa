<?php
// truthyFalsey.php

include_once "templateFunctions.php";
html_top("Truthy and Falsey");

$random = rand(-10, 10);

echo "<p>For the random number $random, I find the following.</p>";

if (!$random)
    echo "<p>The random number was exactly zero!</p>";

if (!($random % 2)){
    echo "<p>$random is even!</p>";
}else{ // odd
    echo "<p>$random is odd!</p>";
}

html_bottom();
