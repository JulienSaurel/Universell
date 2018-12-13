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
            $_POST['phrase'] = File::warning("Vous n'etes pas administrateur");
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
                if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
                    $name = $_FILES['nom-du-fichier']['name'];
                    $pic_path = __DIR__ . '/' . ".." . "/images/$name";
                    $allowed_ext = array("jpg", "jpeg", "png");
                    $realextarray = explode('.', $_FILES['nom-du-fichier']['name']);
                    if (!in_array(end($realextarray), $allowed_ext)) {
                        $_POST['phrase'] = File::warning("Mauvais type de fichier soumis !");
                        self::display();
                    } else {
                        if (!move_uploaded_file($_FILES['nom-du-fichier']['tmp_name'], $pic_path)) {
                            $_POST['phrase'] = File::warning("La copie de l'image a échoué");
                            self::display();
                        } else {
                            $array = array(
                                'id' => $id,
                                'prix' => $prix,
                                'qteStock' => $qteStock,
                                'image' => $image,
                            );
                            $p = new ModelPlanetes($array);
                            ModelPlanetes::save($array);
                            $phrase = 'Le nouvel article a bien été enregistré';//http://localhost/Universell/?action=profile&controller=monProfil
                            self::display();
                        }
                    }
                } else {
                    $_POST['phrase'] = File::warning("Erreur: aucune image uploadé");
                    self::display();
                }
            } else {
                $_POST['phrase'] = File::warning("Erreur: données invalides");
                self::display();
            }
        } else {
            $_POST['phrase'] = File::warning("Vous n'etes pas administrateur");
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
            if (isset($_POST['id'])&&isset($_POST['prix'])) {
                $array = array(
                    'id' => $_POST['id'],
                    'prix' => $_POST['prix'],
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

    public static function updateimg()
    {
        if(isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
            if (isset($_POST['id'])&&isset($_POST['img'])) {
                if (!empty($_FILES['nom-du-fichier']) && is_uploaded_file($_FILES['nom-du-fichier']['tmp_name'])) {
                    $name = $_FILES['nom-du-fichier']['name'];
                    $pic_path = __DIR__ . '/' . ".." . "/images/$name";
                    $allowed_ext = array("jpg", "jpeg", "png");
                    $realextarray = explode('.', $_FILES['nom-du-fichier']['name']);
                    if (!in_array(end($realextarray), $allowed_ext)) {
                        $_POST['phrase'] = File::warning("Mauvais type de fichier soumis !");
                        self::display();
                    } elseif (!move_uploaded_file($_FILES['nom-du-fichier']['tmp_name'], $pic_path)) {
                        echo "La copie a échoué";
                    }
                }
                $path = File::build_path(array('images',$_POST['img']));
                if(file_exists($path)) {
                    $array = array(
                        'id' => $_POST['id'],
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
                    require File::build_path(array('view', 'view.php'));
                } else {
                    $_POST['phrase'] = File::warning("Vous vous etes trompé de nom d'image, elle n'existe pas ou n'a pas été importée.");
                    self::display();
                }
            }
            else {
                self::error();
            }
        } else {
            $_POST['phrase'] = File::warning("Vous n'etes (toujours) pas administrateur");
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