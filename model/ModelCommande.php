<?php

class ModelCommande extends Model
{
    protected $numero;
    protected $login_client;
    protected $date;
    protected $idlignecommande;

    static protected $object = 'commande';
    protected static $primary='numero';
}