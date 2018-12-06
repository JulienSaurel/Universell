<?php


class ModelLigneCommande extends Model
{
    protected $id;
    protected $qte;
    protected $idligneCommande;

    static protected $object = 'ligneCommande';
    protected static $primary='idligneCommande';
}