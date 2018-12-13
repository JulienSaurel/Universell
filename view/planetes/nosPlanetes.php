


<?php



if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
	echo "<h4> <a href='?action=gotocreate&controller=planetes'>Mettre en ligne un nouvel article </a> </h4>";
}
foreach ($planetes as $plan){

	echo "<div class=\"planetes\"><p>  ".$plan->get('id')." : ". $plan->get('prix')." € </p>";
	$image = "<a href=\"?action=achat&controller=planetes&planete=".$plan->get('id')."\" > <img src=" . "\"images/" . $plan->get('image')."\"" . "alt=\" planete \" > </a>";
	echo $image;
	echo "</div>";
}

?>

