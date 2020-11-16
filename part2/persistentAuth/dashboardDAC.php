<?php
// authRemember/dashboard.php
include_once "templateFunctions.php";
include_once ".env.php";
session_start();

// if the user is not logged in
if (empty($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

html_top("Dashboard");

// query information about the specific user

// create the connection
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
if (!$con)
    exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

$stmt = mysqli_stmt_init($con);
if (!$stmt)
    exit("<p class='error'>Failed to initialize statement</p>");

// prepare the statement, verifying the user has permission
$query = "SELECT users_most_secure.first_name FROM users_most_secure 
JOIN permissions ON users_most_secure.id = permissions.user_id 
WHERE permissions.is_allowed = 1 
AND permissions.name = 'dashboard'
AND users_most_secure.id = ?";

if (!mysqli_stmt_prepare($stmt, $query))
    exit(" <p class='error'> Failed to prepare statement:". mysqli_error($con)."</p> ");

// bind the parameters
mysqli_stmt_bind_param($stmt, "d", $_SESSION['user_id']);

// execute
if (!mysqli_stmt_execute($stmt))
    exit(" <p class='error'> Failed to execute statement: " . mysqli_stmt_error($stmt) . " </p> ");

// bind the result variables
mysqli_stmt_bind_result($stmt, $first_name);
$found = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);

if (!empty($first_name))
    echo "<p> Welcome $first_name! Click <a href = 'logout.php'> here</a> to log out .</p> ";
else
    echo "<p class='error'>ACCESS DENIED</p> ";

html_bottom();
