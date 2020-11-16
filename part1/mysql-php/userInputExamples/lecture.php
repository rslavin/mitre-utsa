<?php
// lecture.php

include_once "templateFunctions.php";
include_once ".env.php";

// create the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

// initialize the statement
$stmt = mysqli_stmt_init($con);
if (!$stmt)
    exit("<p class='error'>Failed to initialize statement " . mysqli_stmt_error($stmt) . "</p>");

// prepare the statement
$query = "SELECT name, week, description, has_assignment, difficulty FROM lectures WHERE id = ?";

if (!mysqli_stmt_prepare($stmt, $query))
    exit("<p class='error'>Failed to prepare statement: " . mysqli_stmt_error($stmt) . "</p>");

// bind the parameter
mysqli_stmt_bind_param($stmt, "i", $_GET['id']);

// execute the statement
if (!mysqli_stmt_execute($stmt))
    exit("<p class='error'>Failed to execute statement: " . mysqli_stmt_error($stmt) . "</p>");

// bind the result variables
mysqli_stmt_bind_result($stmt, $name, $week, $description, $has_assignment, $difficulty);

if (!mysqli_stmt_fetch($stmt)) {
    html_top("Not Found");
    echo "<p class='warning'>No lecture found with ID $_GET[id]</p>";
} else {
    html_top($name);
    echo "<p><strong>Week:</strong> $week</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p><strong>Difficulty:</strong> $difficulty</p>";
    echo "<p><strong>Assignment:</strong>" . ($has_assignment == 1 ? "Yes" : "No") . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);

html_bottom();
