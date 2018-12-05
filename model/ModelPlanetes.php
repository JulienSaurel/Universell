<?php

require_once File::build_path(array('model','Model.php'));
class ModelPlanetes extends Model
{

    protected $id;
    protected $nom;
    protected $prix;
    protected $qteStock;
    protected $image;

    static protected $object = 'planetes';
    protected static $primary='id';

    
}
?>