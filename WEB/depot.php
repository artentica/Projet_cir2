<?php require 'include/bdd.php';
      require 'include/global.php';
?>
<!DOCTYPE html>
<html>
	<head>
    	<?php require 'include/head.php'; ?>
 	</head>

	<body>
   	<div class="container">

     		<nav class="navbar navbar-inverse">
       		<ul class="nav navbar-nav">
         			<?php acc(); ?>
         			<form class="navbar-form pull-right">  
         				<li>	<?php deco(); ?>	</li>
         			</form>
       		</ul>
     		</nav>

     		<?php hello(); ?>

    		<div class="row" >
          <form class="form-horizontal col-lg-8 col-offset-2" action="depot.php" method="POST" enctype="multipart/form-data">
            <fieldset>

              <!-- Form Name -->
              <legend>Dépot de fichier sources</legend>

              <!-- File Button --> 
              <div class="form-group">
                <label class="col-md-4 control-label" for="filebutton">Selectionnez vos sources</label>
                <div class="col-md-4">
                  <input id="filebutton" name="src" class="input-file" type="file" required>
                </div>
              </div>

              <!-- Button -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit">Déposer le projet</label>
                <div class="col-md-1 input-group">
                  <input type="submit" class="btn btn-success" />
                </div>
              </div>
              </fieldset>
          </form>
        </div>
      </div>
    <?php   //DEPOT DES SOURCES
      if( isset($_GET['P']) ){
        $_SESSION['p_temp'] = $_GET['P'];
        echo('COUCOUCOCUOCOCOUCOUCUCO');
        echo $_GET['P'];
        echo $_SESSION['p_temp'];
      }

      if( isset($_FILE['src']) ) // ON A ENVOYER UN FICHIER
      {
        if( $_FILES['src']['error'] > 0) 
        {           
          erreur( "Le transfert du fichier a échoué" );
        }
        else                     //LE FICHIER BIEN ETE TRANSFERER
        {                    
              $extension = strrchr($_FILES['src']['name'], '.');
              if( !in_array($extension, $extensions_src) )
              {
                erreur("Le format du fichier ne correspond pas...");
              }
              else               //C EST LE BON FORMAT
              {              
                  $doss = "upload/projet" . $_SESSION['p_temp'] . "/" . $_SESSION['login'];
                  echo $doss;

                  if( !file_exists( $doss ) ) //SI LE REPERTOIRE N EXISTE PAS
                  {
                    mkdir($doss , 0777);
                    echo('dossier créer!');
                  }
                  $output = shell_exec( "rm -R " . $doss . "/"); // VIDE LE DOSSIER

                  $resultat = move_uploaded_file($_FILES['src']['tmp_name'], $nom . "/");


                  if( !$resultat) { erreur( "Le dossier n'a pas pu etre creer et le fichier copier..." ); }
                  else
                  {
                    success( '<strong>Le projet a été créé avec succès</strong> Nom: ' . $_POST['nom'] . '  <a href="gestion-p.php?P='. $id .'" class="alert-link"> Voir le projet</a>.');
                  }
              }
        }
      }
    ?>
  </body>
</html>