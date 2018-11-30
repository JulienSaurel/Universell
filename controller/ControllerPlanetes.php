<?php 
require_once File::build_path(array('model','ModelPanetes.php')); // chargement du modèle
class ControllerPlanetes
{
	protected static $object='planete';

	public static function display()
	{
        $view = 'nosProduits';
        $pagetitle = 'Nos produits';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
	
?>