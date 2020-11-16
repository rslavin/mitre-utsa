<?php
// authRemember/logout.php

echo "<h2>Exercise not implemented!</h2>";
exit();

session_start();

// remove user_id from the session
unset($_SESSION['user_id']);
// TODO destroy tokens

// redirect to login page
header('Location: auth.php');