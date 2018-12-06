<?php
require_once File::build_path(array('model','ModelCommande.php'));
require_once File::build_path(array('model','ModelLigneCommande.php'));
require_once File::build_path(array('model','ModelAchats.php'));

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
        if (isset($_SESSION['panier']))
        {
            $_SESSION['panier']['verrou'] = true;
            for ($i=0; $i<1; $i++)
            {
                $name = $_SESSION['panier']['libelleProduit'][$i];
                $qte = $_SESSION['panier']['qteProduit'][$i];
                $array=array(
                    'id' => $name,
                    'qte' => $qte,
                );
                var_dump($array);
                ModelLigneCommande::save($array);
            }
        }

        /*TODO save lignes commande
                save commande
                save achats*/
    }

}