<?php
// send.php

include_once "templateFunctions.php";

html_top("Send User Input");
?>

<form action="process.php" method="post">
    <label for="day">Enter a day of the week:</label>
    <input type="text" id="day" name="day">
    <input type="submit" value="Submit">
</form>

<?php
html_bottom();
