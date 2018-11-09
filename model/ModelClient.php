<?php
// require_once '../lib/File.php';
require_once File::build_path(array('model' , 'Model.php'));

class ModelClient extends Model
{

    private $login;
    private $nom;
    private $prenom;
    static protected $object = 'clients';
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

    public function __construct($l = NULL, $n = NULL, $p = NULL) {
        if (!is_null($l) && !is_null($n) && !is_null($p)) {
            // Si aucun de $m, $c et $i sont nuls,
            // c'est forcement qu'on les a fournis
            // donc on retombe sur le constructeur à 3 arguments
            $this->login = $l;
            $this->nom = $n;
            $this->prenom = $p;
        }
    }

     public function save() {    
        $sql = "INSERT INTO Utilisateur (prenom, login, nom) VALUES (:nom_tag1 ,:nom_tag2,:nom_tag3)";
        
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array(
            "nom_tag1" => $this->prenom,     
            "nom_tag2" => $this->login,
            "nom_tag3" => $this->nom,
            //nomdutag => valeur, ...
        );
        
        // On donne les valeurs et on exécute la requête	 
        $req_prep->execute($values);
    }


    public function update($data) {    
        $sql = "UPDATE Utilisateur SET prenom=:prenom, nom=:nom WHERE login = :login";
        
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array(
            "prenom" => $data['prenom'],     
            "nom" => $data['nom'],
            "login" => $data['login'],); 
        // On donne les valeurs et on exécute la requête     
        $req_prep->execute($data);
    }




}