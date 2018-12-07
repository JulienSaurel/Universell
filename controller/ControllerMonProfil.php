<?php 
require_once File::build_path(array('model','ModelClient.php'));
require_once File::build_path(array('controller','ControllerClient.php'));

class ControllerMonProfil
{

    protected static $object='monProfil';

    public static function profile()
    {

    	//var_dump($_SESSION['login']);
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

    public static function modifNom(){
        $new = htmlspecialchars($_POST['nom']);
        $data = array(
            'login' => $_SESSION['login'],
            'nom' => $new );
        ModelClient::update($data);
        Self::profile();
    }

    public static function modifPrenom(){
        $new = htmlspecialchars($_POST['prenom']);
        $data = array(
            'login' => $_SESSION['login'],
            'prenom' => $new );
        ModelClient::update($data);
        Self::profile();
    }

    public static function modifAdresse(){
        $newV = htmlspecialchars($_POST['ville']);
        $newR = htmlspecialchars($_POST['rue']);
        $newC = htmlspecialchars($_POST['codepostal']);
        $data = array(
            'login' => $_SESSION['login'],
            'ville' => $newV,
            'rue' => $newR,
            'codepostal' => $newC );
        ModelClient::update($data);
        Self::profile();
    }
} ?>