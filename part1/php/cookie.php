<?php
// cookie.php

include_once "templateFunctions.php";

html_top("Age Calculator");

// validate
if (is_array($_POST) && !empty($_POST)) {
    if (!isset($_POST['date']) || !strlen($_POST['date'])) {
        $error = "You did not select enter a date!";
    } else if (!preg_match('/^[01]?\d\-[0-3]?\d\-[12]\d{3}$/', trim($_POST['date']))) {
        $error = "You did not enter a valid date!";
    } else {
        $date = trim($_POST['date']);
        setcookie("date", $date, time() + 30, "/"); // expires in 30 seconds
        $age = date_diff(date_create("today"), date_create_from_format("m-d-Y", $date))->y;
        echo "<p>You are $age years old</p>";
    }
}

// print errors if they exist
if (isset($error))
    echo '<p style="color: red">Error: ' . $error . '</p>';

$saved_date = "";
if (isset($_COOKIE['date']))
    $saved_date = $_COOKIE['date'];

echo "<form action='cookie.php' method='post'>
        <label for='date'>Enter your birthday:</label>
        <input type='text' id='date' name='date' placeholder='dd-mm-yyyy' value='$saved_date'>
        <input type='submit' value='Submit'>
    </form>";

html_bottom();
