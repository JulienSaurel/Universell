<?php
require_once File::build_path(array('model','ModelCommande.php'));
require_once File::build_path(array('model','ModelLigneCommande.php'));
require_once File::build_path(array('model','ModelAchats.php'));
require_once File::build_path(array('model','ModelPlanetes.php'));
require_once File::build_path(array('model','ModelPanier.php'));

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
            //On verouille le panier
            $_SESSION['panier']['verrou'] = true;


            $numero = ModelCommande::generateId();
            setcookie("idCommande",$numero, 3600);
            self::saveCommande($numero);


            //on boucle sur les produits pour les enregistrer avec leurs quantités et les liés à la commande
            for ($i=0; $i<sizeof($_SESSION['panier']['libelleProduit']); $i++)
            {
                //recuperation des données
                $id = $_SESSION['panier']['libelleProduit'][$i];
                $qte = $_SESSION['panier']['qteProduit'][$i];
                $tab[$i] = ModelLigneCommande::generateId(); //on stocke dans les cases i d'un tableau les id de la ligneCommande pour la recupere ensuite

                //TODO : verif si qte en stock < qte commandee

                //on prend en compte les modifications de stock
                $p = ModelPlanetes::select($id);
                self::savesavePlanetes($p, $id, $qte);

                //on cree l'array pour appeler save avec
                self::saveligneCommande($tab, $i, $id, $qte);

                //On cree l'array pour recuperer l'association entre la commande et les lignes
                self::saveAchats();
            }
            ModelPanier::creationPanier();
            self::paye(); //on redirige vers une page de confirmation/remerciement pour la commande

        }

    }

    public static function saveCommande($numero)
    {
        //On enregistre la commande dans la bdd
        $arraycommande=array(
            'numero' => $numero,
            'login_client' => $_SESSION['login'],
            'date' => date("Y-m-d H:i:s"),
        );
        ModelCommande::save($arraycommande);
    }

    public static function savePlanetes($p, $id, $qte)
    {
        $arrayplanete = array(
            'id' => $id,
            'qteStock' => $p->get('qteStock')-$qte,
        );
        ModelPlanetes::update($arrayplanete);

    }

    public static function saveligneCommande($tab, $i, $id, $qte)
    {
        $arrayliste=array(
            'id' => $id,
            'qte' => $qte,
            'idligneCommande' => $tab[$i],
        );
        ModelLigneCommande::save($arrayliste);

    }

    public static function saveAchats($tab, $i, $numero)
    {
        $arrayAchats= array(
            'numero' => $numero,
            'idligneCommande' => $tab[$i],
        );
        ModelAchats::save($arrayAchats);

    }

    public static function paye(){
        $view = 'payed';
        $pagetitle = 'Merci';
        require File::build_path(array('view','view.php'));
    }


}