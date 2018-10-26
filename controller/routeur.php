<?php
require_once File::build_path(array('controller','ControllerPersonne.php'));
require_once File::build_path(array('controller','ControllerAdherent.php'));
require_once File::build_path(array('controller','ControllerAccueil.php'));
require_once File::build_path(array('controller','ControllerNousConnaitre.php'));
require_once File::build_path(array('controller','ControllerNousSoutenir.php'));
require_once File::build_path(array('controller','ControllerNosProduits.php'));
require_once File::build_path(array('controller','ControllerNosContrats.php'));
require_once File::build_path(array('controller','ControllerMonProfil.php'));
require_once File::build_path(array('controller','ControllerLaVieAlAMAP.php'));


//------------controller-------------
if(!isset($_GET['controller'])) //Si le controller n'a  pas été spécifiée
	{
		$controller = 'accueil'; //On définit un controller par defaut (Personne)
	}

	else
	{
		$controller = $_GET['controller']; // On recupère le controller passée dans l'URL
	}

$controller_class = 'Controller' . ucfirst($controller); 
//on crée la variable qui represente la classe dur laquelle on appellera l'action

//--------------action---------------
	if(!isset($_GET['action'])) //Si l'action n'a  pas été spécifiée
	{
		$action = 'display'; //On définit une action par defaut (readAll)
	}

	else 
	{
		if (in_array($_GET['action'], get_class_methods($controller_class))) 
		{
			$action = $_GET['action']; // On recupère l'action passée dans l'URL
		}
		else 
		{
			$action = 'error';
		}

	}
$controller_class::$action(); 
// Appel de la méthode statique $action de ControllerPersonne
?>

