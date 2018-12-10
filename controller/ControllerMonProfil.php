<?php 
require_once File::build_path(array('model','ModelClient.php'));
require_once File::build_path(array('controller','ControllerClient.php'));

class ControllerMonProfil
{

    //TODO faire des tests

    protected static $object='monProfil';

    public static function profile()
    {

    	//var_dump($_SESSION['login']);
    	$login = $_SESSION['login'];
        $c = ModelClient::select($login);
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
    	$view = 'voirmonprofil';
    	$pagetitle = 'Mon profil';
    	require File::build_path(array('view','view.php'));
    }

    public static function modifprofile()
    {
        $login = $_SESSION['login'];
        $c = ModelClient::select($login);
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'modifiermonprofil';
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
        self::profile();
    }

    public static function modifPrenom(){
        $new = htmlspecialchars($_POST['prenom']);
        $data = array(
            'login' => $_SESSION['login'],
            'prenom' => $new );
        ModelClient::update($data);
        self::profile();
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
        self::profile();
    }

    public static function delete()
    {
        $login = $_SESSION['login'];
        ModelClient::delete($login);
        unset($_SESSION['login']);
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        ControllerAccueil::homepage();
    }

    public static function gotomodifPW()
    {
        $view = 'modifPW';
        $pagetitle = 'Modification de mon mot de passe';
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        require File::build_path(array('view','view.php'));
    }

    public static function modifPW()
    {
        if (isset($_SESSION['login'])&&isset($_POST['oldPW'])&&isset($_POST['newPW1'])&&isset($_POST['newPW2'])) {
            $login = $_SESSION['login'];
            $c = ModelClient::select($login);
            $oldPW = Security::chiffrer($_POST['oldPW']);
            $newPW1 = Security::chiffrer($_POST['newPW1']);
            $newPW2 = Security::chiffrer($_POST['newPW2']);
            if ($c->checkPW($login, $oldPW)) {
                if ($newPW1 == $newPW2) {
                    $array = array(
                        'login' => $login,
                        'password' => $newPW1,
                    );
                    ModelClient::update($array);
                    $login = $_SESSION['login'];
                    $c = ModelClient::select($login);
                    $phrase = "Votre mot de passe a bien été modifié.";
                    $view = 'voirmonprofil';
                    $pagetitle = 'Votre mot de passe a bien été modifié';
                    require File::build_path(array('view', 'view.php'));
                } else {
                    $phrase = "Les deux mots de passe ne correspondent pas.";
                    $view = 'modifPW';
                    $pagetitle = 'Erreur';
                    require File::build_path(array('view', 'view.php'));
                }
            }
            else{
                $phrase = "Votre ancien mot de passe est incorrect.";
                $view = 'modifPW';
                $pagetitle = 'Erreur';
                require File::build_path(array('view', 'view.php'));
            }
        }
    }
} ?>