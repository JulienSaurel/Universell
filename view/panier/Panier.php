
<form method="post" action="index.php?controller=Panier&action=modifier">
<table style="width: 400px">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>


	<?php
	

		echo "<tr><td>" . $info . "</td></tr>";

			for ($i=0 ;$i < $nbArticles ; $i++)
			{  
				echo "<tr>";
				echo "<td>". "<a href=\"?action=achat&controller=planetes&planete=".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."\" >". htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) ."</a></ td>";
				echo "<td><input type=\"number\" min=\"0\" size=\"4\" name=\"q$i\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
				echo "<td><a href=\"".htmlspecialchars("?controller=Panier&action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\"> EFFACER </a></td>";
				echo "</tr>";
			}

			echo "<tr><td colspan=\"2\"> </td>";
			echo "<td colspan=\"2\">";
			echo "Total : ".ModelPanier::MontantGlobal();
			echo "</td></tr>";

			echo "<tr><td colspan=\"4\">";
			echo "<input type=\"hidden\" name=\"controller\" value=\"Panier\"/>";
			echo "<input type=\"hidden\" name=\"action\" value=\"modifier\"/>";
			echo "<input type=\"submit\" value=\"Valider les modifications\"/>";
			

			echo "</td></tr>";

	?>
</table>
</form>
<form method="post" action="index.php?controller=commande&action=commande">
    <input style="margin-top: 30px" type="submit" value="Finaliser la commande" >
</form>