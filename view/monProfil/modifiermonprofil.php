<h1> Votre profil: </h1>
<div>
    <ul>
        <li>Pseudo: <?php echo $c->get('login'); ?> </li>
        <li>Nom: <?php echo $c->get('nom'); ?> </li>
        <?php if(Session::is_user($_SESSION['login'])){
            echo "<form method=\"post\" action=\"?action=modifNom&controller=monProfil\">
			<p>
            	<label for=\"nom_id\">Modifier le nom :</label>
            	<input type=\"text\" value=\"".$c->get('nom')."\" name=\"nom\" id=\"nom_id\" required/>
        	</p>
        	<p>
            	<input type=\"submit\" value=\"Envoyer\" />
        	</p>
        	</form>";} ?>
        <li>Prénom: <?php echo $c->get('prenom'); ?> </li>
        <?php if(Session::is_user($_SESSION['login'])){
            echo "<form method=\"post\" action=\"?action=modifPrenom&controller=monProfil\">
			<p>
            	<label for=\"prenom_id\">Modifier le prenom :</label>
            	<input type=\"text\" value=\"".$c->get('prenom')."\" name=\"prenom\" id=\"nom_id\" required/>
        	</p>
        	<p>
            	<input type=\"submit\" value=\"Envoyer\" />
        	</p>
        	</form>";} ?>
        <li>Adresse: <?php echo $c->get('rue'). ", " . $c->get('codepostal') .$c->get('ville'); ?> </li>
        <?php if(Session::is_user($_SESSION['login'])){
            echo "<form method=\"post\" action=\"?action=modifAdresse&controller=monProfil\">
			<p>
            	<label for=\"ville_id\">Modifier l'adresse :</label><br>
            	<label for=\"ville_id\">Ville :</label>
            	<input type=\"text\" value=\"".$c->get('ville')."\" name=\"ville\" id=\"ville_id\" required/>
        	</p>
        	<p>
        		<label for=\"codepo_id\">Code postal :</label>
        		<input type=\"text\" value=\"".$c->get('codepostal')."\" name=\"codepostal\" id=\"codepo_id\" required/>
        	</p>
        	<p>
        		<label for=\"rue_id\">Rue :</label>
        		<input type=\"text\" value=\"".$c->get('rue')."\" name=\"rue\" id=\"rue_id\" required/>
        	</p>
        	<p>
            	<input type=\"submit\" value=\"Envoyer\" />
        	</p>
        	</form>";} ?>
        <li>E-mail: <?php echo $c->get('mail'); ?> </li>
        <li>Membre depuis le <?php echo $c->get('dateinscription'); ?> </li>
        <li><a href="?action=gotomodifPW&controller=monProfil">Modifier mon mot de passe</a></li>
        <li><a href="?action=delete&controller=monProfil">Supprimer mon compte</a></li>
        <li><a href="?action=profile&controller=monProfil">Retourner sur Mon Profil</a></li>

    </ul>
</div>