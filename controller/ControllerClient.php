<?php
require_once File::build_path(array('model','ModelClient.php')); // chargement du modèle
require_once File::build_path(array('controller','ControllerMonProfil.php')); // chargement du modèle

class ControllerClient 
{

    protected static $object='client';

    public static function readAll() 
    {
        $tab_u = ModelClient::selectAll();//appel au modèle pour gerer la BD
        //var_dump($tab_u);
        
        $view = 'list';
        $pagetitle = 'Liste des Utilisateurs';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function read() 
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
    }

    public static function delete() 
    {
        $log = $_GET['login'];
        ModelClient::delete($log);//appel au modèle pour gerer la BD
                
        $view = 'deleted';
        $pagetitle = '';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        self::readAll();
    }

    public static function create() 
    {
    
        $view = 'create';
        $pagetitle = 'Inscription';
        require File::build_path(array('view','view.php'));
    }

    public static function created() 
    {   
        if(isset($_POST['login']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['rue']) && isset($_POST['codepostal']) && isset($_POST['ville']) && isset($_POST['pw1']) && isset($_POST['pw2']))
        {
            $login = $_POST['login'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $rue = $_POST['rue'];
            $codepostal = $_POST['codepostal'];
            $ville = $_POST['ville'];
            $password = $_POST['pw1'];
            $password2 = $_POST['pw2'];
            $dateinscription = date("Y-m-d H:i:s");

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
            );
            var_dump($array);

            if ($password == $password2)
            {
                $c = new ModelClient($array);
                ModelClient::save($array);
            }
            
        }
        ControllerAccueil::homepage();

    }

    public static function connect()
    {
            $view = 'connect';
            $pagetitle = 'Se connecter';
            require File::build_path(array('view','view.php'));
    }

    public static function connected()
    {
        if (isset($_POST['login'])&&isset($_POST['pw']))
        {
            $login = $_POST['login'];
            $pw = Security::chiffrer($_POST['pw']);
            if (ModelClient::select($login))
              {
                if (ModelClient::select($login)->checkPW($login, $pw))
                 {      
                        $_SESSION['login'] = $login;
                        ControllerMonProfil::profile();

                    }
                }
            }

        }
        public static function deconnect()
        {
            session_unset();

            ControllerAccueil::homepage();
        }

    public static function error()
    {
    
        $view = 'error';
        $pagetitle = '404 Not Found';
        require File::build_path(array('view','view.php'));
    }

    public static function update()
    {
        $log = $_GET['login'];
        $u = ModelClient::getClientByLog($log);//appel au modèle pour gerer la BD
        
        $view = 'update';
        $pagetitle = 'Formulaire Client';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function updated()
    {
        $u = ModelClient::getClientByLog($_POST['login']);
        $data = array('login' => $_POST['login'],'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'],);
        $u->update($data);
        
        $view = 'updated';
        $pagetitle = 'Liste des Utilisateurs';
        require File::build_path(array('view','view.php'));
        self::readAll();
    }
}
?>
