<p> planetes </p>


<?php 

foreach ($planetes as $plan){ 
	//var_dump($plan);
	echo "<p> La planete ".$plan->get('nom')."  \n";
	$image = "<a href=\"?action=achat&controller=planetes&planete=".$plan->get('id')."\" > <img src=". $plan->get('image')." alt=\" planete \" > </a>"; 
	echo $image;
	//var_dump($plan->get('image'));
}

?>

