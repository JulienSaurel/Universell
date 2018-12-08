<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="icon" type="image/png" href="images/favicon/favicon.png" />
    <script src="script/jquery.min.js"></script>
    <script src="script/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
<header> <?php require File::build_path(array("view", "menu.php")); ?> </header>
<main>
    <?php

    if(isset($phrase)){
        echo "<p><span class=\"erreurFormulaire\">" . $phrase . "</span></p>";
    }

    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;

    ?>
</main>
<footer> <?php require File::build_path(array("view", "footer.php")); ?> </footer>
</body>
</html>

