<p> planetes </p>


<?php

if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
echo "<a href='?action=gotocreate&controller=planetes'>Mettre en ligne un nouvel article </a>";
}
foreach ($planetes as $plan){ 
	
	echo "<p> ".$plan->get('nom')." : ". $plan->get('prix')." € \n";
	$image = "<a href=\"?action=achat&controller=planetes&planete=".$plan->get('id')."\" > <img src=". $plan->get('image')." alt=\" planete \" > </a>"; 
	echo $image;
}

?>

