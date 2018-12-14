<form method="post" action="?action=created&controller=client">
    <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->

    <fieldset>
        <legend>Formulaire d'inscription :</legend>
        <p>
            <label for="id_id">Pseudo :</label>
            <input type="text" value="<?php echo htmlspecialchars($login);?>" name="login" id="id_id" required/>
        </p>
        <p>
            <label for="nom_id">Nom :</label>
            <input type="text" value="<?php echo htmlspecialchars($nom);?>" name="nom" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prenom :</label>
            <input type="text" value="<?php echo htmlspecialchars($prenom);?>" name="prenom" id="prenom_id" required/>
        </p>
        <p>
            <label for="mail_id">Mail :</label>
            <input type="email" value="<?php echo htmlspecialchars($mail);?>" name="mail" id="mail_id" required/>
        </p>
        <p>
            <label for="addpost">Rue :</label> 
            <input type="text" value="<?php echo htmlspecialchars($rue);?>" name="rue" id="addpost" required/>
        </p>
         <p>
            <label for="addpost">Code postal :</label> 
            <input type="text" value="<?php echo htmlspecialchars($codepostal);?>" name="codepostal" id="addpost" required/>
        </p>
        <p>
            <label for="ville">Ville :</label> 
            <input type="text" value="<?php echo htmlspecialchars($ville);?>" name="ville" id="ville" required/>
        </p>

        <p>
            <label for="pw1">Mot de passe :</label>
            <input type="password" placeholder="8 caractères minimum" name="pw1" id="pw1"  required/>
        </p>
        <p>
            <label for="pw2">Valider le mot de passe :</label>
            <input type="password" name="pw2" id="pw2" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
<a onclick="openLink()"  href="?action=connect&controller=client">Se connecter</a>