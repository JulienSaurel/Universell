<?php
require_once File::build_path(array('model','ModelPanier.php'));
require_once File::build_path(array('controller','ControllerPlanetes.php'));
require_once File::build_path(array('model','ModelCommandes.php'));
require_once File::build_path(array('model','ModelPlanetes.php'));


class ControllerPanier
{
	protected static $object='panier';

	public static function display(){	

		if (ModelPanier::creationPanier())
	{      $errmsg = "Vous devez vous identifier avant de finaliser votre commande";

        $view = 'Panier';
        $pagetitle = 'Votre panier';
        require File::build_path(array('view','view.php')); 
    }
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }

    public static function suppression(){
      $l = $_GET['l'];
      ModelPanier::supprimerArticle($l);
      Self::display();

    }

    public static function ajout(){
      $id = $_GET['idPlanete'];
      $q = $_GET['qte'];
      
      $planete = ModelPlanetes::select($id);
      // while($r != $planete){
      //   $r
      // }
      $l = $id;
      $p = $planete-> get('prix');
      $planete = ModelPlanetes::select($id);
      $stockPlanete = $planete->get('qteStock');

      $total = $q + (int)$_SESSION['panier']['qteProduit'][$i];
      var_dump($total);

      if ($total <= $stockPlanete) {

      ModelPanier::ajouterArticle($l,$q,$p);
    }
      Self::display();
      
    }

    public static function modifier()
    {



      for ($q=0 ; $q < count($_SESSION['panier']['libelleProduit']) ; $q++) {
      $idPlanete = $_SESSION['panier']['libelleProduit'][$q];
      $planete = ModelPlanetes::select($idPlanete);
      echo $idPlanete;
      $stockPlanete = $planete->get('qteStock');
      $e = "q".$q;
      $QteArticle = $_POST[$e];
      if ($QteArticle <= $stockPlanete) {

      ModelPanier::modifierQTeArticle($_SESSION['panier']['libelleProduit'][$q],round($QteArticle));
    }


       }
       Self::display();

    }


    public static function facture(){

      Self::generePDF();
    }

}

?>