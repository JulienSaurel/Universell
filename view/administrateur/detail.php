<?php
        if ($type == 'Planetes') {
            $id = $o->get('id');
            $id = rawurlencode($id);
            echo "Il reste " . $o->get('qteStock') . " exemplaires de l'astre " . $o->get('id') . " au prix de " . $o->get('prix') . "€.";
            echo "<p> <a href=\"?action=delete&controller=administrateur&type=Planetes&id=" . htmlspecialchars($o->get('id') . "\"> Supprimer </a>   <a href=\"?action=gotoupdate&controller=administrateur&type=Planetes&id=" . $id . "\"> Modifier </a> </p>";
        } elseif ($type == 'Client') {
            $id = $o->get('login');
            $id = rawurlencode($id);
            echo "Le client de login " . htmlspecialchars($id) . " s'appelle " . htmlspecialchars($o->get('prenom')) . " " . htmlspecialchars($o->get('nom')) . " et a pour adresse mail " . htmlspecialchars($o->get('mail')) . ". Il habite " . htmlspecialchars($o->get('rue')) . " , " . htmlspecialchars($o->get('ville')) . "(" . htmlspecialchars($o->get('codepostal')) . ").";
            echo "<p> <a href=\"?action=delete&controller=administrateur&type=client&id={$o->get('id')}\"> Supprimer </a>   <a href=\"?action=gotoupdate&controller=administrateur&type=Client&id=" . $id . "\"> Modifier </a> </p>";

        } ?>