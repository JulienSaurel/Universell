<h1> La planète <?php echo $planete->get('nom') ?> </h1>

<?php echo "<img src=". $planete->get('image')." alt=\" planete \" >"?>

<div> <p> <?php echo $planete->get('nom')." : ". $planete->get('prix')." € " ?>: </p>
<?php $idP = $planete->get('id') ?>

    	<form method="get" action="index.php">


		  <fieldset>
		    
		    <p>
		      <input type='hidden' name='action' value='ajout'>
		    </p>
			<p>
		      <input type='hidden' name='controller' value='Panier'>
		    </p>
		    <p>
		      <input type='hidden' name='idPlanete' value='<?php echo $idP;?>' >
		    </p>
			<p>
		      <label for="qte">quantité souhaitée :</label> 
		      <input type="number" placeholder="Ex : 1" name="qte" id="qte" required/>
		    </p>
		    <p>
		      <input type="submit" value="Ajouter au panier" />
		    </p>
		  </fieldset> 
</form>
</div>