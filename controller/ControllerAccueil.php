<?php
class ControllerAccueil
{
	protected static $object='accueil';

	public static function homepage()
	{
	    if (isset($_POST['phrase'])) {
	        $phrase = $_POST['phrase'];
        }
		$view = 'accueil';
		$pagetitle = 'Accueil Universell';
		require_once File::build_path(array('view','view.php'));
	}

	public static function error()
    {
    
        $view = 'error';
        $pagetitle = '404 Not Found';
        require File::build_path(array('view','view.php'));
    }
}