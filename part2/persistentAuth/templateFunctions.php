<?php
// templateFunctions.php

function html_top($title) {
    echo "
    <head>
        <title>Web Tech Example - $title</title>
        <link rel='stylesheet' type='text/css' href='main.css'>
    </head>
    <body>
    <h1>$title</h1>";
}

function html_bottom() {
    echo "
    </body>
</html>";
}
