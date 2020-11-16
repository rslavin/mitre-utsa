<?php
// userInputExamples/addLecture.php

include_once "templateFunctions.php";
include_once ".env.php";

if (!is_array($_POST) || empty($_POST)) {
    html_top("Error - No Data!");
    exit();
}

html_top($_POST['lecture_name']);

// open the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

$has_assignment = (isset($_POST['has_assignment']) ? 1 : 0);

// insert data
$query = "INSERT INTO lectures (name, week, description, has_assignment, difficulty) 
            VALUES ('$_POST[lecture_name]', '$_POST[week]', '$_POST[description]', '$has_assignment', '$_POST[difficulty]')";
$result = mysqli_query($con, $query);

if (!$result)
    exit("<p class='error'>Error INSERTing: ($query) " . mysqli_error($con) . "</p>");

echo "<p>Success!</p>";

mysqli_close($con);

html_bottom();
