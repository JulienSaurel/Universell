<?php
require_once File::build_path(array('model','ModelClient.php')); // chargement du modèle
require_once File::build_path(array('controller','ControllerMonProfil.php')); // chargement du modèle

class ControllerClient
{

    protected static $object='client';

/*    public static function readAll()
    {
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true') {
            $tab_u = ModelClient::selectAll();//appel au modèle pour gerer la BD
            //var_dump($tab_u);

            $view = 'list';
            $pagetitle = 'Liste des Utilisateurs';
            require File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
        }
        else
        {
            $_POST['phrase'] = 'Vous devez être administrateur pour avoir acces à la liste des utilisateurs';
        }
    }*/

/*    public static function read()
    {

        $log = $_GET['login'];
        $u = ModelClient::select($log);//appel au modèle pour gerer la BD

        if($u)
        {
            $view = 'detail';
            $pagetitle = 'Client';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
            // $tab_u = ModelClient::getAllClients();//appel au modèle pour gerer la BD
            //
            // $view = 'list';
            // $pagetitle = 'Liste des clients';
            // require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        else
        {
            $view = 'error';
            $pagetitle = '404 Not Found';
            require File::build_path(array('view','view.php'));
            //"redirige" vers la vue erreur.php qui affiche un msg d'erreur
        }
    }*/

/*    public static function delete()
    {
        $log = $_GET['login'];
        ModelClient::delete($log);//appel au modèle pour gerer la BD

        $view = 'deleted';
        $pagetitle = '';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        self::readAll();
    }*/

    public static function create()
    {
        if (isset($_POST['phrase']))
            $phrase = $_POST['phrase'];
        $view = 'create';
        $pagetitle = 'Inscription';
        require File::build_path(array('view','view.php'));
    }

    public static function created()
    {
        if(isset($_POST['login']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['rue']) && isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pw1']) && isset($_POST['pw2']))
        {
            if(filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)) {
                $login = htmlspecialchars($_POST['login']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $mail = htmlspecialchars($_POST['mail']);
                $rue = htmlspecialchars($_POST['rue']);
                $codepostal = htmlspecialchars($_POST['codepostal']);
                $ville = htmlspecialchars($_POST['ville']);
                $password = htmlspecialchars($_POST['pw1']);
                $password2 = htmlspecialchars($_POST['pw2']);
                $dateinscription = date("Y-m-d H:i:s");
                $nonce = Security::generateRandomHex();

                $array = array(
                    'login' => $login,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'mail' => $mail,
                    'rue' => $rue,
                    'codepostal' => $codepostal,
                    'ville' => $ville,
                    'password' => Security::chiffrer($password),
                    'dateinscription' => $dateinscription,
                    'isAdmin' => false,
                    'nonce' => $nonce,
                );

                if ($password == $password2) {
                    ModelClient::save($array);
                    $msg = "<p>Veuillez validez votre email en cliquant sur ce lien <a href='webinfo.iutmontp.univ-montp2.fr/~sambucd/Universell/?action=validate&controller=client&nonce={$nonce}&login={$login}'>Valider mon adresse mail</a></p>";
                    $subject = "Validation de votre adresse mail";
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    $headers[] = 'From: Universell <Universell@no-reply.com>';
                    mail($mail, $subject, $msg, implode("\r\n", $headers));
                    $_POST['phrase'] = "Votre inscription a bien été enregistrée.";
                    ControllerAccueil::homepage();
                } else {
                    $_POST['phrase'] = "Les deux mots de passe ne sont pas identiques.";
                    self::create();
                }

            } else {
                $_POST['phrase'] = "Veuillez entrer une adresse mail valide";
                ControllerAccueil::homepage();
        }

        } else {
            $_POST['phrase'] = "Votre inscription n'a pas pu être enregistrée suite à un problème technique.";
            ControllerAccueil::homepage();
        }

    }

    public static function connect()
    {
        if (!isset($_SESSION['login'])) {
            $view = 'connect';
            $pagetitle = 'Se connecter';
            require File::build_path(array('view', 'view.php'));
        } else {
            $_POST['phrase'] = 'Vous êtes déjà connecté';
            ControllerAccueil::homepage();
        }
    }

    public static function connected()
    {

        if (isset($_POST['login'])&&isset($_POST['pw']))
        {
            $login = $_POST['login'];
            $pw = Security::chiffrer($_POST['pw']);
            if ($c = ModelClient::select($login)) {
                if (is_null($c->get('nonce'))) {
                        if ($c->checkPW($login, $pw)) {
                            $_SESSION['login'] = $login;
                            ControllerMonProfil::profile();
                            if ($c->get('isAdmin') == 1) {
                                $_SESSION['admin'] = true;
                            }

                        } else {
                            $errmsg = "Mot de passe incorrect";
                            $view = 'errConnect';
                            $pagetitle = 'erreur connection';
                            require File::build_path(array('view', 'view.php'));
                        }
                } else {
                    $phrase = "Votre adresse email n'a pas été vérifiée, veuillez la vérifier avant de vous connecter.";
                    $view = 'connect';
                    $pagetitle = 'Se connecter';
                    require File::build_path(array('view', 'view.php'));
                }
            } else {
                $phrase = "Login incorrect";
                $view = 'connect';
                $pagetitle = 'Se connecter';
                require File::build_path(array('view', 'view.php'));
            }
        } else {
            $phrase = 'Erreur : données insuffiasantes, veuillez réessayer';
            $view = 'connect';
            $pagetitle = 'Se connecter';
            require File::build_path(array('view', 'view.php'));
        }

    }

    public static function validate()
    {
        //TODO tests
        $login = $_GET['login'];
        $nonce = $_GET['nonce'];
        $c = ModelClient::select($login);
        if ($c)
        {
            if ($c->get('nonce')==$nonce)
            {
                $array = array(
                    'login' => $login,
                    'nonce' => null,
                );
                ModelClient::update($array);
                ControllerAccueil::homepage();
            } else {
                $phrase = 'Une erreur s\'est glissée dans votre url au niveau du nonce, veuillez la corriger et recharger la page';
                $_POST['phrase'] = $phrase;
                ControllerAccueil::homepage();
            }
        } else {
            $phrase = 'Une erreur s\'est glissée dans votre url au niveau du login , veuillez la corriger et recharger la page';
            $_POST['phrase'] = $phrase;
            ControllerAccueil::homepage();
        }
    }

    public static function deconnect()
    {
        if (isset($_SESSION['login'])) {
            session_unset();
            $_POST['phrase'] = "Vous avez bien été déconnecté.";
            ControllerAccueil::homepage();
        } else {
            $_POST['phrase'] = 'Vous ne pouvez pas vous déconnecter si vous n\'êtes pas connecter.';
            ControllerAccueil::homepage();
        }
    }

    public static function error()
    {

        $view = 'error';
        $pagetitle = '404 Not Found';
        require File::build_path(array('view','view.php'));
    }
}
?>