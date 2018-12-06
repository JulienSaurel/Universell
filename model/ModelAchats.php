<?php

require_once File::build_path(array('model','Model.php'));
class ModelAchats extends Model
{

    protected $id;
    protected $id_planete;
    protected $login_client;

    static protected $object = 'achat';
    protected static $primary='id';


    
}
?>