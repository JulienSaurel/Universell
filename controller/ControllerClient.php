<?php
require_once File::build_path(array('model','ModelClient.php')); // chargement du modèle

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
        $u = new ModelClient($_POST['login'],$_POST['nom'],$_POST['prenom']);
        $u->save();
        
        $view = 'created';
        $pagetitle = 'Liste des Clients';
        require File::build_path(array('view','view.php'));
        self::readAll();
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
