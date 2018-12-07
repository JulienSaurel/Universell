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
      $planete = ModelPlanetes::select($id);
      $stockPlanete = $planete->get('qteStock');
      $total = $q + (int)$_SESSION['panier']['qteProduit'];
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


    public static function generePDF(){
        $login = $_GET['login'];
        $prixTotal = $_GET['montant'];


        $sql="SELECT * FROM uni_Client WHERE login=:tag";

        $req_prep = Model::$pdo->prepare($sql);

        $valeurs = array(
            "tag" => $login);

        $req_prep->execute($valeurs);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_cli = $req_prep->fetchAll();
        $client = $tab_cli[0];

        /* 
        $sql="SELECT * FROM uni_Commandes WHERE login_client=:tag AND idDon = (SELECT MAX(idDon) FROM don WHERE mailAddressDonnateur=:tag )";

        $req_prep = Model::$pdo->prepare($sql);

        $valeur = array(
            "tag" => $mail);

        $req_prep->execute($valeur);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDon');
        $tab_don = $req_prep->fetchAll();
        $don = $tab_don[0]; */

        include_once('libExternes/phpToPDF/phpToPDF.php');

    // quelques remarques :
    // 1. FPDF ne gère pas les accents => utilisation de utf8_decode()
    // 2. FPDF de gère pas le caractère € => chr(128)
    

    // l'adhérent à qui s'adresse la facture
    $adh = array(
        'nom' => $client->get('nom'),
        'prenom' => $client->get('prenom'),
        'email' => $client->get('mail')
    );

    /* la facture
    $numFacture = $don->get('idDon'); */
    
    // les articles de la facture
    $A = array();
    $article1 = array(
        'typeMontant' => 'commande',
        'montant' => $prixTotal
    );

    $A[] = $article1;

    // un logo
    //$url = '../images/logo.png';
    
    // création de la page et définition d'éléments
    ob_get_clean();
    $PDF=new phpToPDF();
    $PDF->SetFillColor( 197, 223, 179 );
    $PDF->AddPage();
    $PDF->SetFont('Arial','BI',12);
    
    // quelques constantes propres à notre présentation 
    $esp = 12;
    $hau = 8;
        
    // pour ajouter une ligne de texte de dim 40 x 10. 
    // 0 = non encadré, 1 = encadré
    // 'L' = left, 'C' = center, 'R' = right
    $PDF->SetFont('Arial','B',18);
    // le titre
    $PDF->Cell(190,$hau,"Facture ",0,0,'L');
    
    // retour à la ligne
    $PDF->Ln($esp);

    // date
    $PDF->SetFont('Arial','B',12);  
    $PDF->Cell(190,$hau,"le ".date("d M Y\, H:i:s"),0,0,'L');
    $PDF->Ln($esp);
    $PDF->SetFont('Arial','B',20); 
    $PDF->Cell(190,$hau,utf8_decode("Reçu de la commande"),0,0,'C');
    $PDF->SetFont('Arial','',14);
    // descriptif de l'adhérent
    $PDF->Ln(16);
    $strAdh = $adh['prenom']." ".$adh['nom'].", ".$adh['email'];
    $PDF->Cell(190,$hau,utf8_decode("Client : ".$strAdh),0,0,'L');
    $PDF->Ln(20);

    // descriptif de la facture (identifiant de facure)
    $PDF->Cell(190,$hau,utf8_decode("commande n° rien"),0,0,'L');
    $PDF->Ln(20);

    // ligne d'entête du tableau
    $PDF->Cell(100,$hau,utf8_decode("Montant de la commande: "),1,0,'C',true);
    $PDF->Cell(90,$hau,$prixTotal." ".chr(128),1,0,'C',false);
    $PDF->Ln();

    // ligne par article, et calcul du prix total au fur et à mesure
    $prixTotal = 0;
    foreach ($A as $i => $article) {
        //$lib = utf8_decode($article['libelleArticle']);
        //$qte = $article['quantite'];
        //$prU = $article['prixUnitaire'];
        //$prT = $qte * $prU;
        //$prixTotal += $prT;
        //$PDF->Cell(100,$hau,$lib,1,0,'L');
        //$PDF->Cell(30,$hau,$qte,1,0,'C');
        //$PDF->Cell(30,$hau,number_format($prU,2,',',' ').' '.chr(128),1,0,'R');
        //$PDF->Cell(30,$hau,number_format($prT,2,',',' ').' '.chr(128),1,0,'R');
        $PDF->Ln();
    }

    // ligne du prix total
    //$PDF->Cell(160,$hau,utf8_decode("total "),0,0,'R',false);
    //$PDF->Cell(30,$hau,number_format($prixTotal,2,',',' ').' '.chr(128),1,0,'R');

    // export du pdf avec sauvegarde selon le nom spécifié
    //$namefile = "../files/facturedonnation/facture_$numFacture.pdf";
    $PDF->Output("facture", "I");

    // affichage du pdf
    echo '<embed src="facture_n°rien".".pdf" width="100%" height="900px">';
    }
}
?>