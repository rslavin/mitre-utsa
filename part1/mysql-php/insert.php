<?php
// insert.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("Insert Example");

// open the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

$fname = "First" . rand();
$lname = "Last" . rand();
$dob = rand(1990, 2000) . "-" . rand(0, 12) . "-" . rand(1, 30);

// insert data
$query1 = "INSERT INTO students (first_name, last_name, dob) VALUES ('$fname', '$lname', '$dob')";
$result1 = mysqli_query($con, $query1);

if (!$result1)
    exit("<p class='error'>Error INSERTing: ($query1) " . mysqli_error($con) . "</p>");

echo "<p>Success!</p>";

// close the connection
mysqli_close($con);

html_bottom();
