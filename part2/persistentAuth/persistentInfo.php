<?php
include_once "templateFunctions.php";
session_start();
$sessionPrefix = "s_";
$cookiePrefix = "c_";

function table_printer($arr, $prefix='') {
    if (sizeof($arr)) {
        echo "<div class='array-print'><table><tr><th>Key</th><th>Value</th><th></th></tr>";
        foreach ($arr as $key => $value)
            echo "<tr><td>$key</td><td>$value</td><td><a href='?$prefix$key=1'>delete</a></td></tr>";
        echo "</table></div>";
    } else
        echo "<strong>empty</strong>";
}

foreach ($_GET as $key => $value) {
    if (substr_compare($key, $sessionPrefix, 0, strlen($sessionPrefix)) === 0)
        unset($_SESSION[substr($key, strlen($sessionPrefix))]);
    else if (substr_compare($key, $cookiePrefix, 0, strlen($cookiePrefix)) === 0)
        setcookie(substr($key, strlen($cookiePrefix)), '', 1, '/');
    header("Location: ?");
    exit();
}

html_top("Persistent Information");

echo "<h2>Session Variables (server)</h2>";
table_printer($_SESSION, 's_');

echo "<h2>Cookie Variables (client)</h2>";
table_printer($_COOKIE, 'c_');

html_bottom();
