<nav>
<ul id="menu">
<li class="accueil"><a href="?action=homepage&controller=accueil">Accueil</a></li>
<<<<<<< HEAD
<li class="nousConnaitre"><a href="?action=display&controller=planetes">Nos Produits</a></li>
<li class="monProfil"><a href="?action=display1st&controller=monProfil">Mon profil</a></li>
=======
<li class="nousConnaitre"><a href="?action=display1st&controller=nousConnaitre">Nos Produits</a></li>
<li class="Panier"><a href="?action=display1st&controller=Panier">Panier</a></li>
<?php  if (!isset($_SESSION['login'])) { ?>
        <li class="SeConnecter">
          <a onclick="openLink()" class="lienMenu " href="?action=connect&controller=client">Se connecter</a>
      </li>
       <?php }
       else
       { ?>
      <li class="monProfil">
      <a onclick="openLink()" class="lienMenu" href="?action=profile&controller=monProfil">Mon profil</a>
      <ul>
        <li><a class="lienMenu" href="?action=profile&controller=monProfil">Voir mon profil</a></li>
        <li><a class="lienMenu"href="?action=deconnect&controller=client">Se deconnecter</a></li>
      </ul>
    </li>
      <?php } ?>
>>>>>>> 6f75fae3d9a3b1e4c5b312555ed9cc6ebca91336
</ul>
</nav>
