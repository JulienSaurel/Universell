<?php
require_once File::build_path(array('controller','ControllerClient.php'));



//------------controller-------------
if(!isset($_GET['controller'])) //Si le controller n'a  pas été spécifiée
	{
		$controller = 'client'; //On définit un controller par defaut (Personne)
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
		$action = 'readAll'; //On définit une action par defaut (readAll)
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

