<?php

foreach ($tabcomm as $comm) {
    /*TODO: -récupérer un tableau des commandes classés antéchronologiquement fait
            -creer une methode getArrayLigneCommande qui cree un tableau des lignes de la commande correspondante
            -fix tous les problemes
    */
    echo "<table>";
    $idCom = $comm->get('numero');
    $arrayLigneCommande = $comm->getArrayLigneCommande();
    $datecom = $comm->get('date');
    $montantcomm = 0;
    echo "<tr>Commande n°" . $idCom . " du " . $datecom . " : nombre d'articles: " . count($arrayLigneCommande) . "</tr>";
    echo "<tr><td>Planetes </td><td> Quantité </td><td>  Prix Unitaire </td> <td> Prix total par poduit</td></tr>";
    foreach ($arrayLigneCommande as $ligne) {
        $idPlanete = $ligne->get('id');
        $plan = ModelPlanetes::select($idPlanete);
        $prix = $plan->get('prix');
        $qte = $ligne->get('qte');
        $montantligne = $prix * $qte;
        $montantcomm += $montantligne;
        echo "<tr><td>" . $idPlanete ."</td> <td> ". $qte ." </td> <td>". $prix ."</td> <td> ". $montantligne . "</td></tr>";
    }
    echo "<tr><td>Montant total: " ."</td><td></td><td></td><td>" .  $montantcomm . "</td></tr>";
    echo "</table><br>";
}
?>