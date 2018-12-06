<?php

class ControllerCommande
{
    protected static $object = 'commande';

    public static function commande(){
        $view = 'commande';
        $pagetitle = 'Votre commande';
        require File::build_path(array('view','view.php'));

    }

    public static function command()
    {
        /*TODO save lignes commande
                save commande
                save achats*/
    }

}