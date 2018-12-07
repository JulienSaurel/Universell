<?php

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

}