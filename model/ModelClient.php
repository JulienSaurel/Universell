<?php
// require_once '../lib/File.php';
require_once File::build_path(array('model' , 'Model.php'));

class ModelClient extends Model
{

    protected $login;
    protected $nom;
    protected $prenom;
    protected $mail;
    protected $rue;
    protected $codepostal;
    protected $ville;
    protected $password;
    protected $dateinscription;
    protected $isAdmin;
    protected $nonce;
    static protected $object = 'client';
    protected static $primary='login';

    public function checkPW($login, $mot_de_passe_chiffre)
    {

        $sql = "SELECT * FROM uni_Client WHERE login=:login";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "login" => $login,);

        $req_prep->execute($data);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelClient');

        $tab = $req_prep->fetchAll();


        return ($tab[0]->login==$login) && ($tab[0]->password==$mot_de_passe_chiffre);

    }

    public static function checkLogin($login){
        $sql = "SELECT COUNT(login) FROM uni_Client WHERE login=:login";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $data = array(
            "login" => $login,);

        $req_prep->execute($data);

        $cpt = $req_prep->fetchAll();

        return $cpt==0;
    }

}