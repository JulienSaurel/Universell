<form method="post" action="?action=modifPW&controller=monProfil">
    <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->

    <fieldset>
        <legend>Formulaire d'inscription :</legend>
            <label for="oldpw">Ancien mot de passe :</label>
            <input type="password" name="oldPW" id="oldpw" required/>
        </p>
        <p>
            <label for="pw1">Nouveau mot de passe :</label>
            <input type="password" placeholder="8 caractères minimum" name="newPW1" id="pw1"  required/>
        </p>
        <p>
            <label for="pw2">Valider le nouveau mot de passe :</label>
            <input type="password" name="newPW2" id="pw2" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
<a onclick="openLink()"  href="?action=profile&controller=monProfil">Mon Profil</a>