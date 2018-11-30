<?php
require_once File::build_path(array('model','ModelPanier.php'));

class ControllerPanier
{
	protected static $object='panier';

	public static function display()
	{	
		if (ModelPanier::creationPanier())
	{
        $view = 'Panier';
        $pagetitle = 'Votre panier';
        require File::build_path(array('view','view.php')); 
    }
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}