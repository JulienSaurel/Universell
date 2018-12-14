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
                if (!$tab_p) {
                    $tab_p = array();
                    $phrase = "Il n'y a pas de planetes.";
                    $emptyp = true;
                }
                if(!$tab_c) {
                    $tab_c = array();
                    if (isset($emptyp)&&$emptyp === true) {
                        $phrase = File::warning('Il n\'y a ni planetes ni clients.');
                    } else {
                        $phrase = "Il n'y a pas de clients.";
                    }
                }
                if (!isset($phrase)) {
                    if (isset($_POST['phrase'])) {
                        $phrase = $_POST['phrase'];
                    } else {
                        $phrase = "";
                    }
                }
                $view = 'pageadmin';
                $pagetitle = 'Menu Administrateur';
                require File::build_path(array('view','view.php'));
            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }
    }

    public static function read()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                if (isset($_GET['type'])&&isset($_GET['id']))
                {
                    $type = htmlspecialchars($_GET['type']);
                    $Modelgen = 'Model' . $type;
                    $id = htmlspecialchars($_GET['id']);
                    $o = $Modelgen::select($id);
                    if($o) {
                        if (isset($_POST['phrase'])) {
                            $phrase = $_POST['phrase'];
                        } else {
                            $phrase = "";
                        }
                        $view = 'detail';
                        if ($type == 'Planetes') {
                            $pagetitle = 'La planete ' . $o->get('id');
                        } elseif ($type == 'Client') {
                            $pagetitle = $o->get('nom') . " " . $o->get('prenom');
                        }
                        require File::build_path(array('view', 'view.php'));
                    } else {
                        $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
                        self::adminhomepage();
                    }
                } else {
                    $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
                    self::adminhomepage();
                }
            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }

    }


    public static function delete()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                if (isset($_GET['type'])&&isset($_GET['id']))
                {
                    $type = htmlspecialchars($_GET['type']);
                    $id = htmlspecialchars($_GET['id']);
                    $Modelgen = 'Model' . $type;
                    if($Modelgen::delete($id)) {
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
                        $phrase = $lenom . $id . ' a bien été supprimé';
                        require File::build_path(array('view','view.php'));
                    } else {
                        $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
                        self::adminhomepage();
                    }
                } else {
                    $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
                    self::adminhomepage();
                }
            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }
    }

    public static function gotoupdate()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                if (isset($_GET['type'])&&isset($_GET['id']))
                {
                    $type = htmlspecialchars($_GET['type']);
                    $id = htmlspecialchars($_GET['id']);
                    $Modelgen = 'Model' . $type;
                    $o = $Modelgen::select($id);
                    if($o) {
                        $phrase = "";
                        $view = 'update';
                        $pagetitle = 'Mis à jour ' . $type;
                        require File::build_path(array('view', 'view.php'));
                    } else {
                        $_POST['phrase'] = File::warning('Erreur : données invalides, veuillez réessayer');
                        self::adminhomepage();
                    }
                } else {
                    $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
                    self::adminhomepage();
                }
            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }
    }

    public static function update()
    {
        if (isset($_SESSION['login'])) {
            if (Session::is_admin($_SESSION['login'])) {
                if (isset($_GET['type'])&&isset($_GET['id']))
                {
                    $type = htmlspecialchars($_GET['type']);
                    $id = htmlspecialchars($_GET['id']);
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
                    $phrase = $lenom . $id . ' a bien été mise à jour';
                    require File::build_path(array('view','view.php'));
                } else {
                    $_POST['phrase'] = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
                    self::adminhomepage();
                }

            } else {
                $_POST['phrase'] = File::warning('Ne faîtes pas l\'enfant, vous n\'êtes pas administrateur');
                ControllerAccueil::homepage();
            }
        } else {
            $_POST['phrase'] = File::warning('Cette page est réservée aux administrateurs, vous devez donc être connecté pour y accéder, s\'il vous plaît arrêter de jouer avec l\'url');
            ControllerAccueil::homepage();
        }
    }
}
?>