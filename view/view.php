<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="view/CSS/styles.css">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    <?php require File::build_path(array("view", "menu.php")); ?>
    </head>
    	<body>
<?php

$filepath = File::build_path(array("view", static::$object, "$view.php"));
require $filepath;

?>
    </body>
</html>

