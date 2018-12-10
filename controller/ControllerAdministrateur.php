<?php
require_once File::build_path(array('model','ModelPlanetes.php'));
require_once File::build_path(array('model','ModelClient.php'));

class ControllerAdministrateur
{
    static protected $object = 'administrateur';

    public static function adminhomepage()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
        $tab_p = ModelPlanetes::selectAll();
        $tab_c = ModelClient::selectAll();
        $view = 'pageadmin';
        $pagetitle = 'Menu Administrateur';
        require File::build_path(array('view','view.php'));
            } else {
                $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
            ControllerAccueil::homepage();
        }
    }

    public static function read()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                $type = $_GET['type'];
                $Modelgen = 'Model' . $type;
                $o = $Modelgen::select($_GET['id']);
                $view = 'detail';
                if ($type == 'Planetes') {
                    $pagetitle = 'La planete ' . $o->get('id');
                } elseif ($type == 'Client') {
                    $pagetitle = $o->get('nom') . " " . $o->get('prenom');
                }
                require File::build_path(array('view', 'view.php'));
            } else {
                $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
            ControllerAccueil::homepage();
        }

    }


    public static function delete()
    {
        $type = $_GET['type'];
        $Modelgen = 'Model' . $type;
        $o = $Modelgen::delete($_GET['id']);
        $tab_p = ModelPlanetes::selectAll();
        $tab_c = ModelClient::selectAll();
        $view = 'pageadmin';
        $pagetitle = 'Menu admin';
        if ($type == 'Planetes') {
            $lenom = 'La planete ';
        }
        elseif ($type == 'Client')
        {
            $lenom = 'Le client ';
        }
        $phrase = $lenom . $_GET['id'] . ' a bien été supprimé';
        require File::build_path(array('view','view.php'));
    }

    public static function gotoupdate()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                $type = $_GET['type'];
                $Modelgen = 'Model' . $type;
                $id = $_GET['id'];
                $o = $Modelgen::select($id);
                $view = 'update';
                $pagetitle = 'Mis à jour ' . $type;
                require File::build_path(array('view', 'view.php'));
            } else {
                $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
            ControllerAccueil::homepage();
        }
    }

    public static function update()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
        $type = $_GET['type'];
        $Modelgen = 'Model' . $type;
        if ($type == 'Client') {
            $array = array(
                'login' => $_POST['login'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'mail' => $_POST['mail'],
                'codepostal' => $_POST['codepostal'],
                'ville' => $_POST['ville'],
                'rue' => $_POST['rue'],
                'isAdmin' => $_POST['isAdmin'],
            );
        } elseif ($type == 'Planetes')
        {
            $array = array(
                'id' => $_POST['id'],
                'prix' => $_POST['prix'],
                'qteStock' => $_POST['qteStock'],
                'image' => $_POST['img'],
            );
        }
        $o = $Modelgen::update($array);
        $tab_p = ModelPlanetes::selectAll();
        $tab_c = ModelClient::selectAll();
        $view = 'pageadmin';
        $pagetitle = 'Menu admin';
        if ($type == 'Planetes') {
            $lenom = 'La planete ';
        }
        elseif ($type == 'Client')
        {
            $lenom = 'Le client ';
        }
        $phrase = $lenom . $_GET['id'] . ' a bien été mise à jour';
        require File::build_path(array('view','view.php'));
            } else {
                $_POST['phrase'] = 'Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur';
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = 'Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url';
            ControllerAccueil::homepage();
        }
    }
}
?>