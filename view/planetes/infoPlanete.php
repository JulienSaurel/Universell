<h1> La planète <?php echo $planete->get('nom'); ?></h1>

<?php echo "<img src=". $planete->get('image')." alt=\" planete \" >";
    $id = $planete->get('id');
    echo "<a href=\"?action=delete&id={$id}&controller=planetes\">Supprimer</a>";
    ?>
