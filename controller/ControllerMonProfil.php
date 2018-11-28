<?php 
require_once File::build_path(array('model','ModelAdherent.php'));
require_once File::build_path(array('model','ModelPersonne.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';

	public static function display()
	{
		$controller ='monProfil';
        $view = 'profil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {   
        if (isset($_SESSION['login'])) {
            $a = ModelAdherent::select($_SESSION['login']);
            $p = ModelPersonne::select($a->get('idPersonne'));       
        }
        $controller ='monProfil';
        $view = 'voirmonprofil';
        $pagetitle = 'Mon Profil';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $controller ='monProfil';
        $view = 'devenirproducteur';
        $pagetitle = 'Devenir Producteur';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='monProfil';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>