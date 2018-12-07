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

      $l = $id;
      $p = $planete-> get('prix');

      ModelPanier::ajouterArticle($l,$q,$p);
      Self::display();
      
    }

    public static function modifier()
    {



      for ($q=0 ; $q < count($_SESSION['panier']['libelleProduit']) ; $q++) {
      $idPlanete = $_SESSION['panier']['libelleProduit'][$q];
      $planete = ModelPlanetes::select($idPlanete);
      $stockPlanete = $planete->get('qteStock');
      $e = "q".$q;
      $QteArticle = $_POST[$e];
      if ($QteArticle <= $stockPlanete) {

      ModelPanier::modifierQTeArticle($_SESSION['panier']['libelleProduit'][$q],round($QteArticle));
    }


       }
       Self::display();

    }


/*    public static function action(){

    
    $erreur = false;
		$action = (isset($_POST['agir'])? $_POST['agir']:  (isset($_GET['agir'])? $_GET['agir']:null )) ;
		if($action !== null){
   			if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   				$erreur=true;

   //récuperation des variables en POST ou GET
   		//$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   		//$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
  		//$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   		$l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   		$p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   		if (is_array($q)){
      		$QteArticle = array();
      		$i=0;
      		foreach ($q as $contenu){
         		$QteArticle[$i++] = intval($contenu);
      		}
   		} else
   			$q = intval($q);
    
			}

		if (!$erreur){
   		switch($action){
      Case "ajout":
         ModelPanier::ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         ModelPanier::supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            ModelPanier::modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}   else {
  echo "no action";
}


    Self::display();
    }*/



    public static function facture(){

      Self::generePDF();
    }

}
    
?>

