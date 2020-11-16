<?php
// authRemember/auth.php

include_once "templateFunctions.php";
include_once ".env.php";
$error = "";
session_start();

// check if the user is already logged in
if (!empty($_SESSION['user_id'])) {
    // redirect to dashboard
    header("Location: dashboard.php");
    exit();
} else if (!empty($_COOKIE['remember'])) {
    $token = $_COOKIE['remember'];
    // retrieve user from database (simplified code for brevity)
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    $result = mysqli_query($con, "SELECT user_id FROM auth_tokens WHERE token='$token' AND NOW() < expires");

    // if found, store the user id in the session and redirect
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($con);
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: dashboard.php");
        exit();
    }else{
        mysqli_close($con);
        // delete token from cookie and database
        setcookie('remember', '', 1, '/');
        mysqli_query($con, "DELETE FROM auth_tokens WHERE token = '$token'");
    }
}

// handle form submit
if (!empty($_POST['submit'])) {
    // create the connection
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DATABASE);
    if (!$con)
        exit("<p class='error'>Connection Error: " . mysqli_connect_error() . "</p>");

    $stmt = mysqli_stmt_init($con);
    if (!$stmt)
        exit("<p class='error'>Failed to initialize statement</p>");

    // prepare the statement
    $query = "SELECT id, first_name, password FROM users_most_secure WHERE username = ?";
    if (!mysqli_stmt_prepare($stmt, $query))
        exit("<p class='error'>Failed to prepare statement</p>");

    // bind the parameters
    mysqli_stmt_bind_param($stmt, "s", $_POST['username']);

    // execute
    if (!mysqli_stmt_execute($stmt))
        exit("<p class='error'>Failed to execute statement: " . mysqli_stmt_error($stmt) . "</p>");

    // bind the result variables
    mysqli_stmt_bind_result($stmt, $id, $first_name, $db_hash);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // handle successful login
    if (!empty($db_hash) && password_verify($_POST['password'], $db_hash)) {
        // record user id in session
        $_SESSION['user_id'] = $id;

        // handle remember me functionality (simplified queries for brevity)
        if (!empty($_POST['remember'])) {
            $remember_token = base64_encode(random_bytes(64));
            $remember_time = REMEMBER_DAYS * 24 * 60 * 60;
            $q = "INSERT INTO auth_tokens (`token`, `user_id`, `expires`) VALUES ('$remember_token', '$id', DATE_ADD(NOW(), INTERVAL $remember_time SECOND))";
            $result = mysqli_query($con, $q);
            if (!$result)
                error_log(mysqli_error($con));
            $path = "/";
            setcookie("remember", $remember_token, time() + $remember_time, $path);
        }

        // redirect
        header('Location: dashboard.php');
        mysqli_close($con);
        exit();
    }
    mysqli_close($con);
    $error = "<p class='error'>Invalid credentials!</p>";

}

html_top("Persistent Authentication");

// input form
echo '
<form method="post" action="auth.php">
    <div>
        <label for="username">Username:</label>
        <input name="username" id="username"/>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div>
        <input type="checkbox" name="remember" value="1" /> Remember Me
    </div>
    <input type="submit" name="submit" value="Login"/>' .
    $error . '
</form>';

html_bottom();