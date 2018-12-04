<?php 
require_once File::build_path(array('model','ModelClient.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';

    public static function profile()
    {
    	var_dump($_SESSION['login']);
    	$login = $_SESSION['login'];
        $c = ModelClient::select($login);
    	$view = 'voirmonprofil';
    	$pagetitle = 'Mon profil';
    	require File::build_path(array('view','view.php'));
    }

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>