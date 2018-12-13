<?php
            if ($type == 'Client') { ?>

                <form method="post" action="?action=update&controller=administrateur&type=Client&id=<?php echo $id ?>">
                    <fieldset>
                        <legend>Mis à jour d'un client :</legend>
                        <p>
                            <label for="id_id">Pseudo :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('login')); ?>" name="login" id="id_id" readonly/>
                        </p>
                        <p>
                            <label for="nom_id">Nom :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('nom')); ?>" name="nom" id="nom_id" required/>
                        </p>
                        <p>
                            <label for="prenom_id">Prenom :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('prenom')); ?>" name="prenom" id="prenom_id" required/>
                        </p>
                        <p>
                            <label for="mail_id">Mail :</label>
                            <input type="email" value="<?php echo htmlspecialchars($o->get('mail')); ?>" name="mail" id="mail_id" required/>
                        </p>
                        <p>
                            <label for="addpost">Rue :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('rue')); ?>" name="rue" id="addpost" required/>
                        </p>
                        <p>
                            <label for="addpost">Code postal :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('codepostal')); ?>" name="codepostal" id="addpost"
                                   required/>
                        </p>
                        <p>
                            <label for="ville">Ville :</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('ville')); ?>" name="ville" id="ville" required/>
                        </p>
                        <p>
                            <label for="isAdmin">Rendre Administrateur</label>
                            <input type="text" value="<?php echo htmlspecialchars($o->get('isAdmin')); ?>" name="isAdmin" id="isAdmin" required/>
                        </p>
                        <p>
                            <input type="submit" value="Envoyer"/>
                        </p>
                    </fieldset>
                </form>
                <?php
            } elseif ($type == 'Planetes') { ?>
                <form method="post" action="?action=update&controller=administrateur&type=Planetes&id=<?php echo htmlspecialchars($id) ?>">

                    <fieldset>
                        <legend>Modifier une planete :</legend>
                        <p>
                            <label for="id">Id</label> :
                            <input type="text" name="id" id="id" value='<?php echo htmlspecialchars($o->get('id')); ?>'
                                   readonly/>
                        </p>
                        <p>
                            <label for="prix">Prix</label> :
                            <input type="text" name="prix" id="prix" value='<?php echo htmlspecialchars($o->get('prix')); ?>'
                                   required/>
                        </p>
                        <p>
                            <label for="qte">Quantité en Stock</label> :
                            <input type="number" name="qteStock" id="qte"
                                   value='<?php echo htmlspecialchars($o->get('qteStock')); ?>' required/>
                        </p>
                        <p>
                            <label for="img">Lien Image</label> :
                            <input type="text" name="img" id="img" value='<?php echo htmlspecialchars($o->get('image')); ?>'
                                   required/>
                        </p>
                        <p>
                            <input type="submit" value="Envoyer"/>
                        </p>
                    </fieldset>
                </form>

            <?php } ?>
