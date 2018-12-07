<?php
require_once File::build_path(array('model','ModelPlanetes.php'));
require_once File::build_path(array('model','ModelClient.php'));

class ControllerAdministrateur
{
    static protected $object = 'administrateur';

    public static function adminhomepage()
    {
        $tab_p = ModelPlanetes::selectAll();
        $tab_c = ModelClient::selectAll();
        $view = 'pageadmin';
        $pagetitle = 'Menu Administrateur';
        require File::build_path(array('view','view.php'));
    }

    public static function read()
    {
        $type = $_GET['type'];
        $Modelgen = 'Model' . $type;
        $o = $Modelgen::select($_GET['id']);
        $view = 'detail';
        if ($type == 'Planetes') {
            $pagetitle = 'La planete ' . $o->get('id');
        }
        elseif ($type = 'Client')
        {
            $pagetitle = $o->get('nom') . " " . $o->get('prenom');
        }
        require File::build_path(array('view','view.php'));

    }

}