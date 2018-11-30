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

	 public static function error()
    {
    $controller ='nosProduits';
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>