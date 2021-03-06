<?php
// authRemember/register.php

include_once "templateFunctions.php";
include_once ".env.php";
session_start();

// check if the user is already logged in
if (!empty($_SESSION['user_id'])) {
    // redirect to dashboard
    header("Location: dashboard.php");
    exit();
}

// handle form submission
if (!empty($_POST['submit'])) {
    // create the connection
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if (!$con)
        exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p class='error'>Failed to initialize statement</p>");

    // prepare the statement
    $query = "INSERT INTO users_most_secure (username, password, first_name, last_name) VALUES (?, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'>Failed to prepare statement</p>");

    // hash the password to produce an irreversible digest
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // bind the parameters
    mysqli_stmt_bind_param($stmt, "ssss", $_POST['username'], $password_hash, $_POST['first_name'], $_POST['last_name']);

    // execute
    if (!mysqli_stmt_execute($stmt))
        exit("<p class='error'>Failed to execute statement: ".mysqli_stmt_error($stmt)."</p>");

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    header("Location: auth.php");
    exit();
}

html_top("Register");

// input form
echo '
<form method="post" action="register.php">
    <div>
        <label for="first_name">First Name:</label>
        <input name="first_name" id="first_name"/>
    </div>
    <div>
        <label for="last_name">Last Name:</label>
        <input name="last_name" id="last_name"/>
    </div>
    <div>
        <label for="username">Username:</label>
        <input name="username" id="username"/>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>
    </div>
    <input type="submit" name="submit" value="Register"/>
</form>';

html_bottom();
