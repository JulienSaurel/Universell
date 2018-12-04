<?php
// require_once '../lib/File.php';
require_once File::build_path(array('model' , 'Model.php'));

class ModelClient extends Model
{

    private $login;
    private $nom;
    private $prenom;
    private $mail;
    private $rue;
    private $codepostal;
    private $ville;
    private $password;
    private $dateinscription;
    static protected $object = 'client';
    protected static $primary='login';



	public function get($nom_attribut) 
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique
    public function set($nom_attribut, $valeur) 
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $rue = NULL, $codepostal = NULL, $ville = NULL, $password = NULL, $dateinscription = NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($rue) && !is_null($codepostal) && !is_null($ville) && !is_null($password) && !is_null($prenom) && !is_null($dateinscription)) {

            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mail = $mail;
            $this->rue = $rue;
            $this->codepostal = $codepostal;
            $this->ville = $ville;
            $this->password = $password;
            $this->dateinscription = $dateinscription;
        }
    }

     public function save() {    
        $sql = "INSERT INTO uni_Client (login, prenom, nom, mail, rue, codepostal, ville, password, dateinscription) VALUES (:login, :prenom, :nom, :mail, :rue, :codepostal, :ville, :password, :dateinscription)";
        
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array(
            "login" => $this->login,
            "nom" => $this->nom,     
            "prenom" => $this->prenom,     
            "mail" => $this->mail,
            "rue" => $this->rue,
            "codepostal" => $this->codepostal,
            "ville" => $this->ville,     
            "password" => $this->password,
            "dateinscription" => $this->dateinscription,
        );
        
        $req_prep->execute($values);
    }


    public function update($data) {    
        $sql = "UPDATE uni_Client SET prenom=:prenom, nom=:nom, mail=:mail, rue=:rue, codepostal=:codepostal, ville=:ville, password=:password, dateinscription=:dateinscription WHERE login = :login";
        
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array(
            "login" => $this->login,
            "nom" => $this->nom,     
            "prenom" => $this->prenom,     
            "mail" => $this->mail,
            "rue" => $this->rue,
            "codepostal" => $this->codepostal,
            "ville" => $this->ville,     
            "password" => $this->password,
            "dateinscription" => $this->dateinscription,
        );
        $req_prep->execute($data);
    }


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

}