<?php 
require_once File::build_path(array('model','ModelClient.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';



	 public static function error()
    {
    $controller ='monProfil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>