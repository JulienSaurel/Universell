
	<h1> Votre profil: </h1>
	<div>
		<ul>
			<li>Pseudo: <?php echo $a->get('idAdherent'); ?> </li>
			<li>Nom: <?php echo $p->get('nomPersonne'); ?> </li>
			<li>Prénom: <?php echo $p->get('prenomPersonne'); ?> </li>
			<li>Adresse: <?php echo $a->get('adressepostaleAdherent'). ", " .$a->get('ville'); ?> </li>
			<li>E-mail: <?php echo $p->get('mailPersonne'); ?> </li>
			<li>Membre depuis le <?php echo $a->get('dateinscription'); ?> </li>
			<?php if($a->get('estProducteur')==1)
				{ ?>
					<li>Producteur depuis le <?php echo $a->get('dateproducteur'); ?> </li>
				<?php } 
			 if($a->get('estAdministrateur')==1)
				{ ?>
					<li><strong> Administrateur de l'AMAP</strong></li>
			<?php } ?>
		</ul>
	</div>
