<!-- <nav>
<ul id="menu">
<li class="accueil"><a href="?action=homepage&controller=accueil">Accueil</a></li>
<li class="nousConnaitre"><a href="?action=display&controller=planetes">Nos Produits</a></li>
<li class="Panier"><a href="?action=display&controller=Panier"> Panier </a></li>



    <?php  if (!isset($_SESSION['login'])) { ?>
        <li class="SeConnecter">
          <a onclick="openLink()"  href="?action=connect&controller=client">Se connecter</a>
      </li>
       <?php }
       else
       { ?>
      <li class="monProfil">
      <a onclick="openLink()"  href="?action=profile&controller=monProfil">Mon profil</a>
      <ul>
        <li><a class="lienMenu" href="?action=profile&controller=monProfil">Voir mon profil</a></li>
        <li><a class="lienMenu"href="?action=deconnect&controller=client">Se deconnecter</a></li>
      </ul>
    </li>
      <?php } ?>
    <?php if (isset($_SESSION['admin'])&&$_SESSION['admin']=='true') { ?>
        <li class="admin">
            <a  href="?action=adminhomepage&controller=administrateur">Menu Admin</a>
        </li>
    <?php } ?>

</ul>
</nav> -->
