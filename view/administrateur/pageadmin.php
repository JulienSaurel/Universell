<?php
if (isset($_SESSION['login'])) {
    if (Session::is_admin($_SESSION['login'])) {
        echo "<div id=adminPlanetes>";
        foreach ($tab_p as $p) {
            $id = $p->get('id');
            $idUrl = rawurlencode($id);

            echo "<p> La planète  <a href=\"?action=read&controller=administrateur&type=Planetes&id={$idUrl}\"> $id </a> <a href=\"?action=delete&controller=administrateur&type=Planetes&id=" . $idUrl . "\"> Supprimer </a> <a href=\"?action=gotoupdate&controller=administrateur&type=Planetes&id=" . $idUrl . "\"> Mettre à jour </a></p>";
        }
        echo "</div>";
        echo "<div id=adminClients>";
        foreach ($tab_c as $c) {
            $id = $c->get('login');
            $idUrl = rawurlencode($id);

            echo "<p> Client d'id  <a href=\"?action=read&controller=administrateur&type=Client&id={$idUrl}\"> $id </a> <a href=\"?action=delete&controller=administrateur&type=Client&id=" . $idUrl . "\"> Supprimer </a><a href=\"?action=gotoupdate&controller=administrateur&type=Client&id=" . $idUrl . "\"> Mettre à jour </a></p>";
        }
        echo "</div>";
    } else {
        $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
        ControllerAccueil::homepage();
    }
} else {
    $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
    ControllerAccueil::homepage();
}

 ?>