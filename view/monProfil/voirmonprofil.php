<h1> Votre profil: </h1>
<div>
    <ul>
        <li>Pseudo: <?php echo $c->get('login'); ?> </li>
        <li>Nom: <?php echo $c->get('nom'); ?> </li>
        <li>Prénom: <?php echo $c->get('prenom'); ?> </li>
        <li>Adresse: <?php echo $c->get('rue'). ", " . $c->get('codepostal') .$c->get('ville'); ?> </li>
        <li>E-mail: <?php echo $c->get('mail'); ?> </li>
        <li>Membre depuis le <?php echo $c->get('dateinscription'); ?> </li>
        <li><a href="?action=delete&controller=monProfil">Supprimer mon compte</a></li>
        <li><a href="?action=modifprofile&controller=monProfil">Modifier mon profil</a></li>
    </ul>
</div>
