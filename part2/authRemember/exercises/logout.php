<?php
// authRemember/logout.php

session_start();

// remove user_id from the session
unset($_SESSION['user_id']);
// destroy tokens

// redirect to login page
header('Location: auth.php');