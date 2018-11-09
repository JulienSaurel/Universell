<?php
        foreach ($tab_u as $u) {
            $log = $u->get('login');
            echo "<p> Utilisateur <a href=\"?action=read&controller={utilisateur}&login={$log}\"> $log </a> . <a href=\"?action=delete&controller=utilisateur&login={$log}\"> Supprimer </a> . <a href=\"?action=update&controller=utilisateur&login={$log}\"> Mettre a jour </a> </p>";
        }
        ?>