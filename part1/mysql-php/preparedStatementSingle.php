<?php
// preparedStatementSingle.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("Prepared Statement for One Query");

// input form
echo'
<form method="post" action="preparedStatementSingle.php">
    <label for="number">Number:</label>
    <input name="number" id="number"/>
    <input type="submit" value="Submit"/>
</form>';

// create the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);

if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

// initialize the statement
$stmt = mysqli_stmt_init($con);
if (!$stmt)
    exit("<p class='error'>Failed to initialize statement</p>");

// prepare the statement
$query = "SELECT id, number, name FROM courses WHERE number > ?";

if (!mysqli_stmt_prepare($stmt, $query))
    exit("<p class='error'>Failed to prepare statement</p>");

// bind the parameters (notice that $_POST['number'] already has a value
mysqli_stmt_bind_param($stmt,"i", $_POST['number']);

// execute a SINGLE query
if (!mysqli_stmt_execute($stmt))
    exit("<p class='error'>Failed to execute statement</p>");

// bind the result variables
mysqli_stmt_bind_result($stmt, $id, $number, $name);

echo "<table>";
echo "<tr><th>ID</th><th>Course Number</th><th>Course Name</th></tr>";

// fetch each result, one at a time
while(mysqli_stmt_fetch($stmt) != NULL)
    echo "<tr><td>$id</td><td>$number</td><td>$name</td></tr>";

echo "</table>";

mysqli_stmt_close($stmt);
mysqli_close($con);

html_bottom();
