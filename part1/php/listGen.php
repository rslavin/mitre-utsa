<?php
// listGen.php

include_once "templateFunctions.php";
html_top("List Generation");

$list_items = "";

$random = rand();

for ($i = $random; $i < $random + 10; $i++) {
    $list_items .= "
    <li>
        $i
    </li>";
}

echo "<h2>Ten sequential numbers:</h2>
<ol>$list_items
</ol>";

html_bottom();
