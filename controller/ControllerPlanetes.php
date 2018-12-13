<?php
require_once File::build_path(array('model','ModelPlanetes.php')); // chargement du modèle

class ControllerPlanetes
{
    protected static $object='planetes';


    public static function display()
    {   
       
        $planetes = ModelPlanetes::selectAll();
        $view = 'nosPlanetes';
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } elseif(!isset($phrase)) {
            $phrase = "";
        } 
        $pagetitle = 'Nos planetes';
        require File::build_path(array('view','view.php'));
        
    }

    public static function achat(){
        $idPlanete = $_GET['planete'];

        $planete = ModelPlanetes::select($idPlanete);
        $stockPlanete = $planete->get('qteStock');
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'infoPlanete';
        $pagetitle = 'Acheter ' . $planete->get('id');
        require File::build_path(array('view','view.php'));
    }

    public static function gotocreate()
    {
         if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'create';
        $pagetitle = 'Mise en ligne d\'un nouvel article';
        require File::build_path(array('view','view.php'));
    } else {
        $_POST['phrase'] = "vous n'etes pas admin";
        self::display();
    }
    }

    public static function create()
    {   
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
        if(isset($_POST['id'])&&isset($_POST['prix'])&&isset($_POST['qteStock'])&&isset($_POST['img']))
        {
            $id = $_POST['id'];
            $prix = $_POST['prix'];
            $qteStock = $_POST['qteStock'];
            $image = $_POST['img'];
            $array = array(
                'id' => $id,
                'prix' => $prix,
                'qteStock' => $qteStock,
                'image' => $image,
            );
            $p = new ModelPlanetes($array);
            ModelPlanetes::save($array);
            $phrase = 'Le nouvel article a bien été enregistré';
            self::display();
        }
    } else {
        $_POST['phrase'] = "vous n'etes pas admin";
        self::display();

    }
    }

    public static function delete()
    {
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){

        $p = $_GET['id'];
        ModelPlanetes::delete($p);
        $planetes = ModelPlanetes::selectAll();
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'nosPlanetes';
        $pagetitle = 'La planète a bien été supprimée';
        require File::build_path(array('view','view.php'));
    } else {
        $_POST['phrase'] = "vous n'etes pas admin";
        self::display();
    }
    }


    public static function update()
    {
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
        if (isset($_POST['id'])&&isset($_POST['prix'])&&isset($_POST['img'])) {
            $array = array(
                'id' => $_POST['id'],
                'prix' => $_POST['prix'],
                'image' => $_POST['img'],
            );
            ModelPlanetes::update($array);

            $idPlanete = $_POST['id'];
            $planete = ModelPlanetes::select($idPlanete);
            if (isset($_POST['phrase'])) {
                $phrase = $_POST['phrase'];
            } else {
                $phrase = "";
            }
            $view = 'infoPlanete';
            $pagetitle = 'La planète a bien été mise à jour';
            require File::build_path(array('view','view.php'));
        }
        else {
            self::error();
        }
    } else {
        $_POST['phrase'] = "vous n'etes pas admin";
        self::display();
    }
    }

    public static function stock()
    {
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
        if (isset($_POST['qteStock'])) {
            $array = array(
                'id' => $_POST['id'],
                'qteStock' => $_POST['qteStock'],
            );
            ModelPlanetes::update($array);

            $idPlanete = $_POST['id'];
            $planete = ModelPlanetes::select($idPlanete);

            $view = 'infoPlanete';
            $pagetitle = 'Le nombre de planètes a bien été mis à jour';
            require File::build_path(array('view','view.php'));
        }
        else {
            self::error();
        }
    } else {
        $_POST['phrase'] = "vous n'etes pas admin";
        self::display();
    }
    }

    public static function erreurPlanete(){
        $phrase = File::warning("Veuillez entrer un montant correct");
        $view = 'infoPlanete';
        $pagetitle = 'Achat';
        require File::build_path(array('view','view.php'));
    }

    public static function error()
    {
        if (isset($_POST['phrase'])) {
            $phrase = $_POST['phrase'];
        } else {
            $phrase = "";
        }
        $view = 'error';
        $pagetitle = 'Error 404';
        require File::build_path(array('view','view.php'));
    }
}
?>