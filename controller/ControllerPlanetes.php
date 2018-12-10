<?php 
require_once File::build_path(array('model','ModelPlanetes.php')); // chargement du modèle

class ControllerPlanetes
{
	protected static $object='planetes';

	//TODO checker s'il y a des tests a faire dans ce controller

	public static function display()
	{
        $planetes = ModelPlanetes::selectAll();        

        $view = 'nosPlanetes';
        $pagetitle = 'Nos planetes';
        require File::build_path(array('view','view.php')); 
	}

    public static function achat(){
        $idPlanete = $_GET['planete'];

        $planete = ModelPlanetes::select($idPlanete);
        $stockPlanete = $planete->get('qteStock');
        
        $view = 'infoPlanete';
        $pagetitle = 'Acheter ' . $planete->get('id');
        require File::build_path(array('view','view.php'));
    }

    public static function gotocreate()
    {
        $view = 'create';
        $pagetitle = 'Mise en ligne d\'un nouvel article';
        require File::build_path(array('view','view.php'));
    }

    public static function create()
    {
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
            self::display();
        }
    }

    public static function delete()
    {
        $p = $_GET['id'];
        ModelPlanetes::delete($p);
        $planetes = ModelPlanetes::selectAll();

        $view = 'nosPlanetes';
        $pagetitle = 'La planète a bien été supprimée';
        require File::build_path(array('view','view.php'));
    }


    public static function update()
    {
        if (isset($_POST['id'])&&isset($_POST['prix'])&&isset($_POST['img'])) {
            $array = array(
                'id' => $_POST['id'],
                'prix' => $_POST['prix'],
                'image' => $_POST['img'],
            );
            ModelPlanetes::update($array);

            $idPlanete = $_POST['id'];
            $planete = ModelPlanetes::select($idPlanete);

            $view = 'infoPlanete';
            $pagetitle = 'La planète a bien été mise à jour';
            require File::build_path(array('view','view.php'));
        }
        else {
            self::error();
        }
    }

    public static function stock()
    {
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
    }

    public static function erreurPlanete(){
        $errmsg = "Veuillez entrer un montant correct";
        $view = 'infoPlanete';
        $pagetitle = 'Achat';
        require File::build_path(array('view','view.php'));
    }

	 public static function error()
    {
    $view = 'error';
    $pagetitle = 'Error 404';
    require File::build_path(array('view','view.php'));
    }
}
?>