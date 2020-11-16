<?php
// badReg.php

include_once "templateFunctions.php";
include_once ".env.php";

html_top("Naive Registration (Bad)");

// input form
echo
'<form method="post" action="badReg.php">
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
    <p><a href="">Click here to try again (don\'t refresh)</a></p>
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
    $query = "INSERT INTO users_insecure (username, password, first_name, last_name) VALUES (?, ?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'>Failed to prepare statement</p>");

    // bind the parameters
    mysqli_stmt_bind_param($stmt, "ssss", $_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name']);

    // execute
    if (!mysqli_stmt_execute($stmt))
        exit("<p class='error'>Failed to execute statement: ".mysqli_stmt_error($stmt)."</p>");

    echo "<p>Welcome, $_POST[first_name]! I hope you don't use this password anywhere else!</p>";

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}

html_bottom();
