<!DOCTYPE html>
<html>
    <head>
        <?php 
        	require 'include/head.php';
        ?>
       
    </head>

    <body>
    <form class="form-horizontal"
><fieldset>

<!-- Form Name -->
<legend>Entrez votre identifiant et votre mot de passe</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Identifiant:</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" class="form-control input-md" type="text">  
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Mot de passe:</label>
  <div class="col-md-4">
    <input id="passwordinput" name="passwordinput" class="form-control input-md" type="password">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">SE CONNECTER</button>
  </div>
</div>

</fieldset>
</form>
    
    </body>
</html>