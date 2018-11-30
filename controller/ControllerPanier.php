<?php
require_once File::build_path(array('model','ModelPanier.php'));

class ControllerPanier
{
	protected static $object='panier';

	public static function display(){	

		if (ModelPanier::creationPanier())
	{      

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


    public static function action(){
      ModelPanier::creationPanier();
    ModelPanier::ajouterArticle('Bite',3,50);
    var_dump($_SESSION['panier']);
    $erreur = false;
		$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
		if($action !== null){
   			if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   				$erreur=true;

   //récuperation des variables en POST ou GET
   		$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   		$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
  		$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

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
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}   



    }
}