<?php
// logicalOps.php

include_once "templateFunctions.php";
html_top("Logical Operators");

$random = rand(-10, 10);

echo "<p>For the random number $random, I find the following.</p>";

if ($random == 0)
    echo "<p>The random number was exactly zero!</p>";

if ($random % 2 == 0){
    echo "<p>$random is even!</p>";
}else{ // odd
    echo "<p>$random is odd!</p>";
}

if ($random <= -3){
    echo "<p>$random <strong>very</strong> negative!</p>";
}else if ($random >= 3){
    echo "<p>$random <strong>very</strong> positive!</p>";
}else{
    echo "<p>$random seems to be close to the middle.</p>";
}

html_bottom();
