<?php
require_once File::build_path(array('controller','ControllerClient.php'));
require_once File::build_path(array('controller','ControllerAccueil.php'));
require_once File::build_path(array('controller','ControllerPlanetes.php'));
require_once File::build_path(array('controller','ControllerPanier.php'));
require_once File::build_path(array('controller','ControllerMonProfil.php'));
require_once File::build_path(array('controller','ControllerCommande.php'));
require_once File::build_path(array('controller','ControllerAdministrateur.php'));


//------------controller-------------
if(!isset($_GET['controller'])) //Si le controller n'a  pas été spécifiée
{
    $controller = 'accueil'; //On définit un controller par defaut (Personne)
}

else
{
    if(!($_GET['controller'] == 'monProfil')||isset($_SESSION['login'])) {
        $controller = $_GET['controller']; // On recupère le controller passée dans l'URL
    }
    else {
        $controller = 'accueil';
        $action = 'homepage';
        $_POST['phrase'] = '';
    }
}

$controller_class = 'Controller' . ucfirst($controller);

//on crée la variable qui represente la classe dur laquelle on appellera l'action
//--------------action---------------
if (!isset($_GET['action'])) //Si l'action n'a  pas été spécifiée
{
    $action = 'homepage'; //On définit une action par defaut
    if (!class_exists($controller_class, false))
    {
        $controller = 'accueil';
        $action = 'homepage';
        $_POST['phrase'] = File::warning('Veuillez naviguer sur ce site uniquement avec les liens.');
        $controller_class = 'Controller' . ucfirst($controller);
    }
} elseif(!class_exists($controller_class, false)) {
    $controller = 'accueil';
    $action = 'homepage';
    $_POST['phrase'] = File::warning('Veuillez naviguer sur ce site uniquement avec les liens.');
    $controller_class = 'Controller' . ucfirst($controller);
} else {
    if (in_array($_GET['action'], get_class_methods($controller_class))) {
        $action = $_GET['action']; // On recupère l'action passée dans l'URL
    } else {
        $controller = 'accueil';
        $action = 'homepage';
        $_POST['phrase'] = File::warning('Problème d\'url, veuillez naviguer uniquement à l\'aide des liens');
        $controller_class = 'Controller' . ucfirst($controller);
    }

}


$controller_class::$action();


?>
