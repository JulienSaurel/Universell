<?php if (isset($_SESSION['admin'])&&$_SESSION['admin']=='true')
{ ?>
<form method="post" action="?action=<?php echo $action ?>&controller=planetes" enctype="multipart/form-data">

    <fieldset>
        <legend> <?php echo $formtitle; ?></legend>
        <p>
            <label for="id">Nom</label> :
            <input type="text"  name="id" id="id" value='<?php echo htmlspecialchars($p->get('id')); ?>' <?php echo $type ?>/>
        </p>
        <p>
            <label for="prix">Prix</label> :
            <input type="text"  name="prix" id="prix" value='<?php echo htmlspecialchars($p->get('prix')); ?>' required/>
        </p>
        <p>
            <label for="qte">Quantité en Stock</label> :
            <input type="number" min="0" name="qteStock" id="qte" value='<?php echo htmlspecialchars($p->get('qteStock')); ?>' required/>
        </p>
        <p>
            <label for="img">Nom Image</label> :
            <input type="text" placeholder="img.jpg" name="img" id="img"  value='<?php echo htmlspecialchars($p->get('image')); ?>' required/>
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