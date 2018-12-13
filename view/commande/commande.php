<h1> PAYE </h1>

<?php 
//var_dump($_SESSION);
$instanceClient = ModelClient::select($_SESSION["login"]);
//var_dump($instanceClient->get('login'));
$cpt = count($_SESSION["panier"]["libelleProduit"]);

$i = 0;
$prixTotal = 0;

while($i < $cpt){
	$prixqte = $_SESSION["panier"]["prixProduit"][$i]*$_SESSION["panier"]["qteProduit"][$i];
	echo "<p> produit : ". $_SESSION["panier"]["libelleProduit"][$i] . " <br> quantité : ". $_SESSION["panier"]["qteProduit"][$i] . " <br> prix : ".$prixqte."</p>"; 
	$prixTotal = $prixTotal + $prixqte;
	$i = $i +1;
}

echo "<h4> Prix total : ". htmlspecialchars($prixTotal)." € </h4>";  

echo "<a href='?action=command&controller=commande'> Valider ma commande </a> <br>";
?>

