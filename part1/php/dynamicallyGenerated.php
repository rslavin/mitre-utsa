<?php
// dynamicallyGenerated.php

# get the date using a time format string
$now = date("l jS \of F Y h:i:s A");

# set the color of the title based on whether it is AM or PM
$color = "blue";
# check if $now ends with "AM"
if(!substr_compare($now, "AM", -strlen("AM")))
    $color = "red";

# generate html
echo "<html>
	<body>
             <!-- title changes based on color -->
		<h1 style=\"color: $color\">
			Current Time
		</h1>
		<hr />
		<p id=\"main-paragraph\">
			It is now $now.
		</p>
	</body>
</html>";
