<p> planetes </p>


<?php 

foreach ($planetes as $plan){ 
	//var_dump($plan);
	echo "<p> La planete ".$plan->get('nom')."  \n";
	$image = "<img src=". $plan->get('image')." alt=\" planete \" >"; // ne fonctionne pas bien
	echo $image;
	//var_dump($plan->get('image'));
}

?>

