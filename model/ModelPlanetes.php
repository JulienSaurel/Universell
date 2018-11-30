<?php

require_once File::build_path(array('model','Model.php'));
class ModelPlanetes extends Model
{

    private $id;
    private $nom;
    private $prix;
    private $qteStock;
    private $image;

    static protected $object = 'planete';
    protected static $primary='id';

    // Getter générique
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

    // un constructeur

    public function __construct($nom = NULL, $prix = NULL, $qteStock = NULL, $image = NULL )
    {
        if (!is_null($nom) && !is_null($prix) && !is_null($qteStock)) {

            $this->nom = $nom;
            $this->prix = $prix;
            $this->qteStock = $qteStock;
            $this->image = $image;
        }
    }

    

    public function save()
    {
        $sql = "INSERT INTO uni_Planete (nom, prix, qteStock, image) VALUES (:nom, :prix, :qteStock, :image)";

        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);


        $values = array(
            "nom" => $this->nom,
            "prix" => $this->prix,
            "qteStock" => $this->qteStock,
            "image" => $this->image,
	    );
        // On donne les valeurs et on exécute la requête
        $req_prep->execute($values);
    }
    
}
?>