<?php
// connect.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("MySQL Connection");

// open the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

echo "<p>Success!</p>";

// close the connection
mysqli_close($con);

html_bottom();
