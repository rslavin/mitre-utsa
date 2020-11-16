<?php
// inlinePhp.php

#$assign1 = get_assignment_from_database(1);
$assign1['description'] = "This came from the database!";
$assign1['has_assignment'] = true;
?>
<html>
<body>
<form>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" cols="30"><?php echo "$assign1[description]"; ?>
            </textarea>
    </div>
    <br>
    <div>
        <label for="has_assignment">Has Assignment? </label>
        <input type="checkbox" id="has_assignment"
            <?PHP
            if ($assign1['has_assignment']) {
                echo "checked";
            }
            ?>
               name="has_assignment" value="1">
    </div>
</form>
</body>
</html>
