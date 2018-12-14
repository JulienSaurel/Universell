<?php if (isset($_SESSION['admin'])&&$_SESSION['admin']=='true')
{ ?>
<form method="post" action="?action=create&controller=planetes" enctype="multipart/form-data">

    <fieldset>
        <legend>Mise en ligne d'un nouvel article :</legend>
        <p>
            <label for="id">Nom</label> :
            <input type="text"  name="id" id="id"  required/>
        </p>
        <p>
            <label for="prix">Prix</label> :
            <input type="text"  name="prix" id="prix"  required/>
        </p>
        <p>
            <label for="qte">Quantité en Stock</label> :
            <input type="number"  name="qteStock" id="qte" required/>
        </p>
        <p>
            <label for="img">Nom Image</label> :
            <input type="text" placeholder="img.jpg" name="img" id="img"  required/>
        </p>
        <p>
            <label for="fichier">Upload de l'image </label> :
            <input type="file" name="nom-du-fichier" id="fichier">
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
<?php } ?>