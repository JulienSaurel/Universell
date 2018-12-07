<?php
require_once File::build_path(array('model','ModelCommande.php'));
require_once File::build_path(array('model','ModelLigneCommande.php'));
require_once File::build_path(array('model','ModelAchats.php'));
require_once File::build_path(array('model','ModelPlanetes.php'));
require_once File::build_path(array('model','ModelPanier.php'));

class ControllerCommande
{
    protected static $object = 'commande';

    public static function commande()
    {
        var_dump($_COOKIE['idCommande']);
        $view = 'commande';
        $pagetitle = 'Votre commande';
        require File::build_path(array('view', 'view.php'));

    }

    public static function command()
    {
        if (isset($_SESSION['panier'])) {
            //On verouille le panier
            $_SESSION['panier']['verrou'] = true;


            $numero = ModelCommande::generateId();
            setcookie("idCommande", serialize($numero), 3600 + time());
            self::saveCommande($numero);


            //on boucle sur les produits pour les enregistrer avec leurs quantités et les liés à la commande
            for ($i = 0; $i < sizeof($_SESSION['panier']['libelleProduit']); $i++) {
                //recuperation des données
                $id = $_SESSION['panier']['libelleProduit'][$i];
                $qte = $_SESSION['panier']['qteProduit'][$i];
                $tab[$i] = ModelLigneCommande::generateId(); //on stocke dans les cases i d'un tableau les id de la ligneCommande pour la recupere ensuite

                //TODO : verif si qte en stock < qte commandee

                //on prend en compte les modifications de stock
                $p = ModelPlanetes::select($id);
                self::savePlanetes($p, $id, $qte);

                //on cree l'array pour appeler save avec
                self::saveligneCommande($tab, $i, $id, $qte);

                //On cree l'array pour recuperer l'association entre la commande et les lignes
                self::saveAchats($tab, $i, $numero);
            }
            ModelPanier::creationPanier();
            self::paye(); //on redirige vers une page de confirmation/remerciement pour la commande

        }

    }

    public static function saveCommande($numero)
    {
        //On enregistre la commande dans la bdd
        $arraycommande = array(
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
            'qteStock' => $p->get('qteStock') - $qte,
        );
        ModelPlanetes::update($arrayplanete);

    }

    public static function saveligneCommande($tab, $i, $id, $qte)
    {
        $arrayliste = array(
            'id' => $id,
            'qte' => $qte,
            'idligneCommande' => $tab[$i],
        );
        ModelLigneCommande::save($arrayliste);

    }

    public static function saveAchats($tab, $i, $numero)
    {
        $arrayAchats = array(
            'numero' => $numero,
            'idligneCommande' => $tab[$i],
        );
        ModelAchats::save($arrayAchats);

    }

    public static function paye()
    {
        $view = 'payed';
        $pagetitle = 'Merci';
        require File::build_path(array('view', 'view.php'));
    }

    public static function generePDF()
    {
        $login = $_SESSION['login'];

        $sql = "SELECT * FROM uni_Client WHERE login=:tag";

        $req_prep = Model::$pdo->prepare($sql);

        $valeurs = array(
            "tag" => $login);

        $req_prep->execute($valeurs);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');
        $tab_cli = $req_prep->fetchAll();
        $client = $tab_cli[0];

        $idCommande = unserialize($_COOKIE['idCommande']);

        $tabCommande = ModelCommande::getCommandeById($idCommande);


        include_once('libExternes/phpToPDF/phpToPDF.php');

        // quelques remarques :
        // 1. FPDF ne gère pas les accents => utilisation de utf8_decode()
        // 2. FPDF de gère pas le caractère € => chr(128)


        // l'adhérent à qui s'adresse la facture
        $adh = array(
            'nom' => $client->get('nom'),
            'prenom' => $client->get('prenom'),
            'email' => $client->get('mail'),
        );

        /* la facture
        $numFacture = $don->get('idDon'); */

        // les articles de la facture
        $A = array();
        $i = 0;
        $prixTotal = 0;
        while ($i < count($tabCommande)) {
            $article = "article" . $i + 1;
            $article = array(
                'libelleArticle' => $tabCommande[$i]["id"],
                'quantite' => $tabCommande[$i]["qte"],
                'prix' => ModelCommande::getPrixPlanete($tabCommande[$i]["id"])
            );
            $qte = $tabCommande[$i]["qte"];
            $prix = ModelCommande::getPrixPlanete($tabCommande[$i]["id"]);
            $prixTotal = (int)$prixTotal + ((int)$qte * (int)$prix);
            $A[] = $article;
            $i = $i + 1;
        }

        // un logo
        //$url = '../images/logo.png';

        // création de la page et définition d'éléments
        ob_get_clean();
        $PDF = new phpToPDF();
        $PDF->SetFillColor(160, 185, 236);
        $PDF->AddPage();
        $PDF->SetFont('Arial', 'BI', 12);

        // quelques constantes propres à notre présentation
        $esp = 12;
        $hau = 8;

        // pour ajouter une ligne de texte de dim 40 x 10.
        // 0 = non encadré, 1 = encadré
        // 'L' = left, 'C' = center, 'R' = right
        $PDF->SetFont('Arial', 'B', 18);
        // le titre
        $PDF->Cell(190, $hau, utf8_decode("Facture n°" . $idCommande), 0, 0, 'L');

        // retour à la ligne
        $PDF->Ln($esp);

        // date
        $PDF->SetFont('Arial', 'B', 12);
        $PDF->Cell(190, $hau, "le " . date("d M Y\, H:i:s"), 0, 0, 'L');
        $PDF->Ln($esp);
        $PDF->SetFont('Arial', 'B', 20);
        $PDF->Cell(190, $hau, utf8_decode("Reçu de la commande"), 0, 0, 'C');
        $PDF->SetFont('Arial', '', 14);
        // descriptif de l'adhérent
        $PDF->Ln(16);
        $strAdh = $adh['prenom'] . " " . $adh['nom'] . ", " . $adh['email'];
        $PDF->Cell(190, $hau, utf8_decode("Client : " . $strAdh), 0, 0, 'L');
        $PDF->Ln(20);

        // descriptif de la facture (identifiant de facure)
        $PDF->Cell(190, $hau, utf8_decode("commande n° " . $idCommande), 0, 0, 'L');
        $PDF->Ln(20);
        //$PDF->Cell(190,$hau,utf8_decode(),0,0,'L');
        // ligne d'entête du tableau
        //$PDF->Cell(100,$hau,utf8_decode("Montant de la commande: "),1,0,'C',true);
        //$PDF->Cell(90,$hau,$prixTotal." ".chr(128),1,0,'C',false);
        $PDF->Ln();

    }
}
?>