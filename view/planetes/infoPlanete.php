<h1> La planète <?php echo $planete->get('id') ?> </h1>

<?php echo "<img src=" . "\"images/" . $planete->get('image')."\"" . "alt=\" planete \" >"?>


<div> <p> <?php echo $planete->get('id')." : ". $planete->get('prix')." € " ?> </p>

    <p> Stock restant : <?php echo $planete->get('qteStock') ?> </p>
    <?php $idP = $planete->get('id');

    if(isset($_SESSION['login'])&&isset($_SESSION['admin'])&&$_SESSION['admin']=='true'){
        echo "<p><a href='?action=delete&id={$idP}&controller=planetes'>Supprimer </a> <a href='?action=gotoupdatefull&id={$idP}&controller=planetes'>Modifier tout </a></p>";?>

        <form method="post" action="?action=update&controller=planetes">

            <fieldset>
                <legend>Modifier une planete :</legend>
                <p>
                    <label for="id">Id</label> :
                    <input type="text"  name="id" id="id" value='<?php echo htmlspecialchars($planete->get('id')); ?>' readonly/>
                </p>
                <p>
                    <label for="prix">Prix</label> :
                    <input type="number" min="0" name="prix" id="prix" value='<?php echo htmlspecialchars($planete->get('prix')); ?>' required/>
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>

        <form method="post" action="?action=updateimg&controller=planetes" enctype="multipart/form-data">
            <fieldset>
                <legend>Modifier l'image :</legend>
                <p>
                    <input type='hidden' name='id' value='<?php echo $idP; ?>' >
                </p>
                <p>
                    <label for="img">Nom Image</label> :
                    <input type="text"  name="img" id="img" value='<?php echo htmlspecialchars($planete->get('image')); ?>' />
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

        <form method="post" action="?action=stock&controller=planetes">

            <fieldset>
                <legend>Modifier le nombre de planètes en stock :</legend>
                <p>
                    <input type='hidden' name='id' value='<?php echo $idP; ?>' >
                </p>
                <p>
                    <label for="qte">Quantité en Stock</label> :
                    <input type="number"  name="qteStock" id="qte" value='<?php echo htmlspecialchars($planete->get('qteStock')); ?>' required/>
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    <?php } ?>





    <div class="issou">  	<form method="post" action="index.php?controller=panier&action=ajout">


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
                    <input type="number" min="1" max="<?php echo $stockPlanete?>" value="1" placeholder="Ex : 1" name="qte" id="qte" required/>


                    <input id="addpanier" type="image" src="images/panieradd.png" alt="Ajouter au panier">
                </p>
            </fieldset>
        </form>
    </div>