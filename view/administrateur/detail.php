<?php
if($type == 'Planetes')
{
echo "Il reste " . $o->get('qteStock') . " exemplaires de l'astre " . $o->get('id') . " au prix de " . $o->get('prix') ."€." ;
echo "<p> <a href=\"TODO\"> Supprimer </a>   <a href=\"TODO\"> Modifier </a> </p>";
}
elseif ($type == 'Client')
{
    echo "Le client de login " . $o->get('login') . " s'appelle " . $o->get('prenom') . " " . $o->get('nom') . " et a pour adresse mail " . $o->get('mail') . ". Il habite " . $o->get('rue') . " , " . $o->get('ville') . "(" . $o->get('codepostal') . ").";
    echo "<p> <a href=\"TODO\"> Supprimer </a>   <a href=\"TODO\"> Modifier </a> </p>";

}