<?php

require_once File::build_path(array('model','Model.php'));
class ModelPlanetes extends Model
{

    private $id;
    private $nom;
    private $prix;
    private $qteStock;
    private $image;

    static protected $object = 'planetes';
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

    
    
}
?>