<?php
if(isset($_SESSION['login'])) {
    if (Session::is_admin($_SESSION['login'])) {
        if ($type == 'Planetes') {
            $id = $o->get('id');
            $idP = htmlspecialchars($id);
            $idPUrl = rawurlencode($id);
            echo "Il reste " . $o->get('qteStock') . " exemplaires de l'astre " . $o->get('id') . " au prix de " . $o->get('prix') . "€.";
            echo "<p> <a href=\"?action=delete&controller=administrateur&type=Planetes&id=" . $o->get('id') . "\"> Supprimer </a>   <a href=\"?action=gotoupdate&controller=administrateur&type=Planetes&id=" . $idPUrl . "\"> Modifier </a> </p>";
        } elseif ($type == 'Client') {
            $id = $o->get('login');
            $id = htmlspecialchars($id);
            $idCUrl = rawurlencode($id);
            echo "Le client de login " . $o->get('login') . " s'appelle " . $o->get('prenom') . " " . $o->get('nom') . " et a pour adresse mail " . $o->get('mail') . ". Il habite " . $o->get('rue') . " , " . $o->get('ville') . "(" . $o->get('codepostal') . ").";
            echo "<p> <a href=\"?action=delete&controller=administrateur&type=client&id={$o->get('id')}\"> Supprimer </a>   <a href=\"?action=gotoupdate&controller=administrateur&type=Client&id=" . $idCUrl . "\"> Modifier </a> </p>";

        } else {
            $_POST['phrase'] = 'Veuillez ne pas toucher à l\'url des liens';
            ControllerAccueil::homepage();
        }
    } else {
        $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
        ControllerAccueil::homepage();
    }
} else {
    $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
    ControllerAccueil::homepage();
}
?>