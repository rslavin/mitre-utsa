<?php
// example.php

include_once ".env.php";

html_top("MySQL Interaction Example");

define('DB_SERVER', 'localhost');
define('DATABASE', 'school');
define('DB_USERNAME', 'school_db_user');
define('DB_PASSWORD', 'school_db_password');

// open the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

// verify the connection
if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

// validate the data
if (strlen($_POST['first_name']) > 128 || strlen($_POST['last_name']) > 128)
    exit("<p class='error'>Error: Invalid input</p>");

// sanitize the data
$fname = mysqli_real_escape_string($_POST['first_name']);
$lname = mysqli_real_escape_string($_POST['last_name']);

// execute SQL
$query = "INSERT INTO students (first_name, last_name) VALUES ('$fname', '$lname')";
$result = mysqli_query($con, $query);

// verify execution
if (!$result)
    exit("<p class='error'>Query Error: " . mysqli_error($con) . "</p>");

echo "<p>Success!</p>";

// close the connection
mysqli_close($con);

html_bottom();
