<?php
require_once File::build_path(array('model','ModelCommande.php'));
require_once File::build_path(array('model','ModelLigneCommande.php'));
require_once File::build_path(array('model','ModelAchats.php'));
require_once File::build_path(array('model','ModelPlanetes.php'));

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


            //On enregistre la commande dans la bdd
            $numero = ModelCommande::generateId();
            $arraycommande=array(
                'numero' => $numero,
                'login_client' => $_SESSION['login'],
                'date' => date("Y-m-d H:i:s"),
            );
            ModelCommande::save($arraycommande);


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
                $arrayplanete = array(
                    'id' => $id,
                    'qteStock' => $p->get('qteStock')-$qte,
                );
                ModelPlanetes::update($arrayplanete);

                //on cree l'array pour appeler save avec
                $arrayliste=array(
                    'id' => $id,
                    'qte' => $qte,
                    'idligneCommande' => $tab[$i],
                );
                ModelLigneCommande::save($arrayliste);

                //On cree l'array pour recuperer l'association entre la commande et les lignes
                $arrayAchats= array(
                    'numero' => $numero,
                    'idligneCommande' => $tab[$i],
                );
                ModelAchats::save($arrayAchats);
            }
            $_SESSION['panier']['verrou'] = false; //on deverouille

            self::paye(); //on redirige vers une page de confirmation/remerciement pour la commande

        }

    }

    public static function paye(){
        $view = 'payed';
        $pagetitle = 'Merci';
        require File::build_path(array('view','view.php'));
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

        
        $sql="SELECT * FROM uni_Commandes C JOIN uni_Achats A ON C.numero=A.numero JOIN uni_LigneCommande L ON L.idligneCommande=A.idligneCommande  WHERE login_client=:tag AND idDon = (SELECT MAX(idDon) FROM don WHERE mailAddressDonnateur=:tag )";

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


