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
                $pagetitle = 'Liste des Utilisateurs';; ;
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
        if(!isset($_POST['nom'])){
            $login = "";
        }else {
            $login = $_POST['login'];
        }
        if(!isset($_POST['nom'])){
            $nom = "";
        }else {
            $nom = $_POST['nom'];
        }
        if(!isset($_POST['nom'])){
            $prenom = "";
        }else {
            $prenom = $_POST['prenom'];
        }
        if(!isset($_POST['nom'])){
            $mail = "";
        }else {
            $mail = $_POST['mail'];
        }
        if(!isset($_POST['nom'])){
            $rue = "";
        }else {
            $rue = $_POST['rue'];
        }
        if(!isset($_POST['nom'])){
            $ville = "";
        }else {
            $ville = $_POST['ville'];
        }
        if(!isset($_POST['nom'])){
            $codepostal = "";
        }else {
            $codepostal = $_POST['codepostal'];
        }

        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
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
                $nonce = rawurlencode(Security::generateRandomHex());

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

                if ($password == $password2) { // si les deux mdp sont corrects
                    if(ModelClient::checkLogin($login)){ // si le login n'existe pas déjà
                        ModelClient::save($array);
                        $msg = "<p>Veuillez validez votre email en cliquant sur ce lien <a href='webinfo.iutmontp.univ-montp2.fr/~sambucd/Universell/?action=validate&controller=client&nonce={$nonce}&login={$login}'>Valider mon adresse mail</a></p>";
                        $subject = "Validation de votre adresse mail";
                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                        $headers[] = 'From: Universell <Universell@no-reply.com>';
                        mail($mail, $subject, $msg, implode("\r\n", $headers));
                        $_POST['phrase'] = "Votre inscription a bien été enregistrée.";
                        ControllerAccueil::homepage();
                    } else{ // si le login existe déjà
                        $_POST['phrase'] = File::warning("Ce login existe déjà.");
                        Self::create();
                    }
                    $msg = "<p>Veuillez validez votre email en cliquant sur ce lien <a href='webinfo.iutmontp.univ-montp2.fr/~sambucd/Universell/?action=validate&controller=client&nonce={$nonce}&login={$login}'>Valider mon adresse mail</a></p>";
                    $subject = "Validation de votre adresse mail";
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    $headers[] = 'From: Universell <Universell@no-reply.com>';
                    mail($mail, $subject, $msg, implode("\r\n", $headers));
                    $_POST['phrase'] = "Votre inscription a bien été enregistrée.";
                    ControllerAccueil::homepage();

                } else { // si les deux mdp sont différents
                    $_POST['phrase'] = File::warning("Les deux mots de passe ne sont pas identiques.");
                    self::create();
                }

            } else { // si le mail n'est pas valide
                $_POST['phrase'] = File::warning("Veuillez entrer une adresse mail valide");
                Self::create();
            }
        } else {
            $_POST['phrase'] = File::warning("Votre inscription n'a pas pu être enregistrée suite à un problème technique.");
            ControllerAccueil::homepage();
        }

    }

    public static function connect()
    {
        if (!isset($_SESSION['login'])) {
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
            if(!isset($login)){
                $login ="";
            }

            $view = 'connect';
            $pagetitle = 'Se connecter';
            require File::build_path(array('view', 'view.php'));
        } else {
            $_POST['phrase'] = File::warning('Vous êtes déjà connecté');
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
                        if (isset($_POST['phrase'])) {
                            $phrase = $_POST['phrase'];
                        } else {
                            $phrase = "";
                        }
                        if ($c->get('isAdmin') == 1) {
                            $_SESSION['admin'] = true;
                        }
                        ControllerMonProfil::profile();
                    } else {

                        $phrase = File::warning("Mot de passe incorrect");
                        $view = 'connect';
                        $pagetitle = 'erreur connection';
                        require File::build_path(array('view', 'view.php'));
                    }
                } else {
                    $phrase = File::warning("Votre adresse email n'a pas été vérifiée, veuillez la vérifier avant de vous connecter.");
                    $view = 'connect';
                    $pagetitle = 'Se connecter';
                    require File::build_path(array('view', 'view.php'));
                }
            } else {
                $phrase = File::warning("Login incorrect");
                $view = 'connect';
                $pagetitle = 'Se connecter';
                require File::build_path(array('view', 'view.php'));
            }
        } else {
            $phrase = File::warning('Erreur : données insuffiasantes, veuillez réessayer');
            $view = 'connect';
            $pagetitle = 'Se connecter';
            require File::build_path(array('view', 'view.php'));
        }

    }

    public static function validate()
    {
        if(isset($_GET['login'])&&isset($_GET['nonce'])) {
            $login = htmlspecialchars($_GET['login']);
            $nonce = htmlspecialchars($_GET['nonce']);
            $c = ModelClient::select($login);
            if ($c) {
                if ($c->get('nonce') == $nonce) {
                    $array = array(
                        'login' => $login,
                        'nonce' => null,
                    );
                    ModelClient::update($array);
                    ControllerAccueil::homepage();
                } else {
                    $phrase = File::warning('Une erreur s\'est glissée dans votre url au niveau du nonce, veuillez la corriger et recharger la page');
                    $_POST['phrase'] = $phrase;
                    ControllerAccueil::homepage();
                }
            } else {
                $phrase = File::warning('Une erreur s\'est glissée dans votre url au niveau du login , veuillez la corriger et recharger la page');
                $_POST['phrase'] = $phrase;
                ControllerAccueil::homepage();
            }
        } else {
            $phrase = File::warning('Erreur : données invalides');
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
            $_POST['phrase'] = File::warning('Vous ne pouvez pas vous déconnecter si vous n\'êtes pas connecté.');
            ControllerAccueil::homepage();
        }
    }

    /*public static function error()
    {

        $view = 'error';
        $pagetitle = '404 Not Found';
        require File::build_path(array('view','view.php'));
    }*/
}
?>