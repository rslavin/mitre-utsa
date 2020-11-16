<?php
// weakTyping.php

$number_no_quotes = 4413;
$number_quotes = "4413";

echo "<html><body>";

# concatenating two quoted strings
echo "<p>Concatenating a string: CS" . $number_quotes . "</p>";

# concatenating a quoted string and a number
echo "<p>Concatenating an 'integer': CS" . $number_no_quotes . "</p>";

# adding a string and a number with addition operator
$new_number = $number_quotes + $number_no_quotes;
echo "<p>$new_number</p>";

# adding a string and a number with concatenation operator
$new_number = $number_quotes . $number_no_quotes;
echo "<p>$new_number</p>";

echo "</body></html>";
