<p> <span class="erreurFormulaire"> <?php echo $errmsg ?> </span></p>
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
	
		$nbArticles=count($_SESSION['panier']['libelleProduit']);
		if ($nbArticles <= 0)
		echo "<tr><td>Votre panier est vide </ td></tr>";
		else
		{
			for ($i=0 ;$i < $nbArticles ; $i++)
			{
				echo "<tr>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
				echo "<td><input type=\"number\" size=\"4\" name=\"q\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
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
			echo "<input type=\"submit\" value=\"Rafraichir\"/>";
			

			echo "</td></tr>";
		}	
	
	?>
</table>
</form>

<form method="post" action="index.php?controller=Panier&action=commande">
	<?php if(!isset($_SESSION)){ ?>
		<p> <span class="erreurFormulaire"> <?php echo $errmsg ?> </span></p>
		<?php }else{ ?>
		<input style="margin-top: 30px" type="submit" value="Finaliser la commande" >
		<?php } ?>
</form>
