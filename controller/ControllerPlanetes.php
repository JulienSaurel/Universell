<?php 
require_once File::build_path(array('model','ModelPlanetes.php')); // chargement du modèle

class ControllerPlanetes
{
	protected static $object='planetes';

	public static function display()
	{
        $planetes = ModelPlanetes::selectAll();
        var_dump($planetes[1]);
        

        $view = 'nosPlanetes';
        $pagetitle = 'Nos planetes';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
	
?>