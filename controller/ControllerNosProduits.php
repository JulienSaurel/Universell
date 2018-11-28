<?php 
class ControllerNosProduits
{
    protected static $object='nosProduits';

	public static function display()
	{
		$controller ='nosProduits';
        $view = 'produits';
        $pagetitle = 'Nos Produits';
        require File::build_path(array('view','view.php')); 
	}

    public static function display1st()
    {
        $controller ='nosProduits';
        $view = 'nosproducteurs';
        $pagetitle = 'Nos Producteurs';
        require File::build_path(array('view','view.php')); 
    }

    public static function display2nd()
    {
        $controller ='nosProduits';
        $view = 'produitsdumoment';
        $pagetitle = 'Produits du moment';
        require File::build_path(array('view','view.php')); 
    }

	 public static function error()
    {
    $controller ='nosProduits';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>