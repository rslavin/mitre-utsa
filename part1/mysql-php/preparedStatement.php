<?php
// preparedStatement.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("Prepared Statement for Multiple Queries");

// create the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

// initialize the statement
$stmt = mysqli_stmt_init($con);
if (!$stmt)
    exit("<p class='error'>Failed to initialize statement</p>");

// prepare the statement
$query = "INSERT INTO courses (number, name) VALUES (?, ?)";
if (!mysqli_stmt_prepare($stmt, $query))
    exit("<p class='error'>Failed to prepare statement</p>");

// execute the statement many times with different values
for ($i = 1; $i < 5; $i++) {
    // bind parameters (this declares the variables)
    mysqli_stmt_bind_param($stmt, "is", $number, $name);
    // assign values to the bound variables
    $number = "499$i";
    $name = "Inserted course $i";
    // execute the statement with the bound variables
    if (mysqli_stmt_execute($stmt))
        echo("<p>Inserted course $number</p>");
    else
        echo("<p class='error'>Failed to insert course $number</p>");
}
mysqli_stmt_close($stmt);
mysqli_close($con);

html_bottom();
