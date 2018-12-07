
<form method="post" action="?action=connected&controller=client">


  <fieldset>
    <legend>Se connecter :</legend>
    <p>
      <label for="login_id">Login</label> :
      <input type="text" placeholder="Ex : 2" name="login" id="login_id" required/>
    </p>
    <p>
      <label for="pw_id">Password</label> :
      <input type="password" placeholder="Ex : Alizan" name="pw" id="pw_id" required/>
    </p> 
    <p>
      <input type="submit" value="Envoyer" />
    </p>
    <p>
      <span class="erreurFormulaire"> <?php echo $errmsg ?> </span>
    </p>

  </fieldset>
    <a href="?action=create&controller=client">S'inscrire</a>
</form>
