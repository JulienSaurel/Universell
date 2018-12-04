<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <script src="script/jquery.min.js"></script>
        <script src="script/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css">

    </head>
    <body>
    	<header> <?php require File::build_path(array("view", "menu.php")); ?> </header>
    	<main>
			<?php

			$filepath = File::build_path(array("view", static::$object, "$view.php"));
			require $filepath;

			?>
		</main>
		<footer> <?php require File::build_path(array("view", "footer.php")); ?> </footer>
    </body>
</html>

