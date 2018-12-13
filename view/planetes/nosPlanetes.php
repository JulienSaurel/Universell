


<?php

echo $phrase;

if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
	echo "<a href='?action=gotocreate&controller=planetes'>Mettre en ligne un nouvel article </a>";
}
foreach ($planetes as $plan){

	echo "<div class=\"planetes\"><p>  ".$plan->get('id')." : ". $plan->get('prix')." € </p>";
	$image = "<a href=\"?action=achat&controller=planetes&planete=".$plan->get('id')."\" > <img src=". $plan->get('image')." alt=\" planete \" > </a>";
	echo $image;
	echo "</div>";
}

?>

