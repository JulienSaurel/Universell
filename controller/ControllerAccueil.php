<?php
class ControllerAccueil
{
	protected static $object='accueil';

	public static function homepage()
	{
		$view = 'accueil';
		$pagetitle = 'Accueil';
		require_once File::build_path(array('view','view.php'));
	}

	public static function error()
    {
    
        $view = 'error';
        $pagetitle = '404 Not Found';
        require File::build_path(array('view','view.php'));
    }
}