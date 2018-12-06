<?php

class ModelAchats extends Model
{
    protected $numero;
    protected $ligneCommande;

    static protected $object = 'achats';
    protected static $primary='numero';
}