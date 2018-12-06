<?php

require_once File::build_path(array('model','Model.php'));
class ModelCommandes extends Model
{

    protected $numero;
    protected $login_client;
    protected $date;

    static protected $object = 'commandes';
    protected static $primary='numero';


    
}
?>