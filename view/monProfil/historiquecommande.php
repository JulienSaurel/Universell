<?php
foreach ($tabcomm as $comm) {
    /*TODO: -récupérer un tableau des commandes classés antéchronologiquement
            -creer une methode getArrayLigneCommande qui cree un tableau des lignes de la commande correspondante
            -fix tous les problemes
    */
    $idCom = $comm->get('id');
    $arrayLigneCommande = $idCom->getArrayLigneCommande();
    $datecom = $comm->get('date');
    echo "Commande n°" . $idCom . " du " . $datecom . " : nombre d'articles: " . count($arrayLigneCommande);
    echo "Planetes  Quantité    Prix Unitaire   Prix total par poduit"
    foreach ($arrayLigneCommande as $ligne) {
        $plan = $ligne ->get('idPlanete');
        $prix = $plan->get('prix');
        $qte = $ligne->get('qte');
        $montantligne = $prix * $qte;
        echo $plan . $qte . $prix . $montantligne;
    }
}