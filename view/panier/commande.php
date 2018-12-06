<h1> PAYE </h1> 

<?php //FAIRE LE CAS OU N'EST PAS CONNECTÉ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//var_dump($_SESSION);
$instanceClient = ModelClient::select($_SESSION["login"]);
//var_dump($instanceClient);
$cpt = count($_SESSION["panier"]["libelleProduit"]);

$i = 0;
$prixTotal = 0;

while($i < $cpt){
	$prixqte = $_SESSION["panier"]["prixProduit"][$i]*$_SESSION["panier"]["qteProduit"][$i];
	echo "<p> produit : ". $_SESSION["panier"]["libelleProduit"][$i] . " <br> quantité : ". $_SESSION["panier"]["qteProduit"][$i] . " <br> prix : ".$prixqte."</p>"; 
	$prixTotal = $prixTotal + $prixqte;
	$i = $i +1;
}

echo "<h4> Prix total : ". $prixTotal." € </h4>";  

?>

<a href="?action=paye&controller=panier"> Payer </a>

<a href="?action=generePDF&controller=panier&login=<?php echo $instanceClient->get('login') ?>&montant=<?php echo $prixTotal ?>" target="_blank"> télécharger la facture </a>
