<?php 
class ControllerNosProduits
{
    protected static $object='nosProduits';

	public static function display()
	{
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'produits';
        $pagetitle = 'Nos Produits';
        require File::build_path(array('view','view.php')); 
	}

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
} ?>