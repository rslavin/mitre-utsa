<?php
// betterAuth.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("Naive Authentication (Bad)");

// input form
echo '
<form method="post" action="betterAuth.php">
    <div>
        <label for="username">Username:</label>
        <input name="username" id="username"/>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>
    </div>
    <input type="submit" name="submit" value="Login"/>
</form>';

if (!empty($_POST['submit'])) {
    // create the connection
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if (!$con)
        exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p class='error'>Failed to initialize statement</p>");

    // prepare the statement
    $query = "SELECT id, first_name FROM users_more_secure WHERE username = ? AND password = ?";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'>Failed to prepare statement</p>");

    // hash the password to produce an irreversible digest
    $password_hash = hash("sha256", $_POST['password']);

    // bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $password_hash);

    // execute
    if (!mysqli_stmt_execute($stmt))
        exit("<p class='error'>Failed to execute statement: ".mysqli_stmt_error($stmt)."</p>");

    // bind the result variables
    mysqli_stmt_bind_result($stmt, $id, $first_name);
    if (mysqli_stmt_fetch($stmt))
        echo "<p>Hi, $first_name! I hope you don't use this password anywhere else!</p>";
    else
        echo "<p class='error'>Invalid credentials!</p>";

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

html_bottom();