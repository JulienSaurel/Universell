<?php
require_once File::build_path(array('model','Model.php'));
require_once File::build_path(array('model','ModelPlanetes.php'));
require_once File::build_path(array('controller','ControllerPlanetes.php'));

class ModelCommande extends Model
{
    protected $numero;
    protected $login_client;
    protected $date;

    static protected $object = 'commande';
    protected static $primary='numero';

public static function getCommandeById($id){
	$sql="SELECT * FROM uni_Commande C JOIN uni_Achats A ON C.numero=A.numero JOIN uni_LigneCommande L ON L.idligneCommande=A.idligneCommande  WHERE C.numero=$id";

    $req_prep = Model::$pdo->prepare($sql);

    $req_prep->execute();
    $req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $tabCom = $req_prep->fetchAll();
    return $tabCom;
}

    public static function selectAllbyClient()
    {
        $sql = "SELECT * FROM uni_Commande WHERE 'login_client'=:login;"; //on recupere tous sur les commandes du client connecté
        $req_prep = Model::$pdo->prepare($sql); //on prepare la requete
        $array = array(
            "login" => $_SESSION['login'], //TODO variable a recuperer dans l'action du controller/try catch/tester requete
        ); //on recupere le login du client connecté

        $req_prep->execute($array); //on execute la requete
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommande'); //on recupere des objets ModelCommande
        $tabCom = $req_prep->fetchAll();
        if(empty($tabCom)) {
            return false;
        } else {
            return $tabCom;
        }
}

    public function getArrayLigneCommande()
    {
        $sql = "SELECT LC.idligneCommande, LC.id, LC.qte FROM uni_Commande C JOIN uni_Achats A ON C.numero = A.numero JOIN uni_LigneCommande LC ON A.idligneCommande = LC.idligneCommande WHERE numero=:numero;";
        $req_prep = Model::$pdo->prepare($sql); //on prepare la requete
        $array = array(
            "numero" => $this->get('numero'), //TODO variable a recuperer dans l'action du controller/try catch/tester requete
        ); //on recupere l'id de la commande

        $req_prep->execute($array); //on execute la requete
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelLigneCommande'); //on recupere des objets ModelCommande
        $tablignecomm = $req_prep->fetchAll();
        if(empty($tablignecomm)) {
            return false;
        } else {
            return $tablignecomm;
        }
    }

public static function getPrixPlanete($nomPlanete){
    $sql="SELECT P.prix FROM uni_Planetes P WHERE P.id LIKE \"$nomPlanete\"";

    $req_prep = Model::$pdo->prepare($sql);

    $req_prep->execute();
    //$req_prep->setFetchMode(PDO::FETCH_ASSOC);
    $prix = $req_prep->fetchAll();
    return (int)$prix[0]["prix"];
}

}