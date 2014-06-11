<?php 
  require 'include/bdd.php';
  require 'include/global.php';
  connect();
?>
<!DOCTYPE html>
<html>
	<head>
    	<?php require 'include/head.php'; ?>
 	</head>

	<body>
   	<div      class="container">

     		<nav  class="navbar navbar-inverse">
       		<ul class="nav navbar-nav">
         			<?php 
                acc();
                retour(); 
              ?>
         			<form class="navbar-form pull-right">  
         				<li>	<?php deco(); ?>	</li>
         			</form>
       		</ul>
     		</nav>

     		<?php hello(); ?>

    		<div    class="row" >
          <form class="form-horizontal col-lg-8 col-offset-2" action="depot.php?P=<?= $_GET['P'] ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
              <legend>Dépôt de fichiers source</legend>

              <!-- File Button --> 
              <div        class="form-group">
                <label    class="col-md-4 control-label" for="filebutton">Selectionnez vos sources</label>
                <div      class="col-md-4">
                  <input  class="input-file" id="filebutton" name="src" type="file" required>
                </div>
              </div>

              <!-- Button -->
              <div        class="form-group">
                <label    class="col-md-4 control-label" for="submit">Déposez le projet</label>
                <div      class="col-md-1 input-group">
                  <input  class="btn btn-success" type="submit"/>
                </div>
              </div>
              
              </fieldset>
          </form>
        </div>
      </div>
    <?php   //DEPOT DES SOURCES

      $login = C_prof() ? 'student' : $_SESSION['login'];

      if( isset($_GET['P']) )
          $_SESSION['p_temp'] = $_GET['P'];

      if( isset($_FILES['src']) ) // ON A ENVOYER UN FICHIER
      {
        
        $req  = Select('SELECT DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=' . $_SESSION['p_temp'] );
        $D_B  = strtotime( $req[0]{0} );
        //echo $D_B - time();   //DEBUG

        if( ($D_B - time()) < 0 ){

          erreur( 'Il est trop tard pour déposer vos sources.' );
        }
        else{                     // LES TEMPS SONT RESPECTES

          if( $_FILES['src']['error'] > 0 ) 
          {           
            erreur( "Le transfert du fichier a échoué" );
          }
          else                     //LE FICHIER BIEN ETE TRANSFERER
          {                    
            $extension = strrchr($_FILES['src']['name'], '.');

            if( !in_array($extension, $extensions_src) )
            {
              erreur("Le format du fichier ne correspond pas");
            }
            else               //C EST LE BON FORMAT
            {              
                $doss = "upload/project" . $_SESSION['p_temp'] . "/" . $login . "/";
                //echo $doss;

                if( !is_dir( $doss ) ) //SI LE REPERTOIRE N EXISTE PAS
                {
                  if(mkdir($doss , 0777, true)){
                    //echo('Dossier créé! '. $doss);
                  }
                  else{
                    echo('Un problème a eu lieu lors de la création du dossier');
                  }
                }
                $output   = shell_exec( "rm -R " . $doss . "*" ); // VIDE LE DOSSIER

                $zip = new ZipArchive;
                $resultat=$zip->open($_FILES['src']['tmp_name']);
                if ($zip->open($_FILES['src']['tmp_name']) === TRUE) {
                    $resultat=$zip->extractTo($doss);
                    $zip->close();
                }

                if( !$resultat) 
                {
                  erreur( "Le dossier n'a pas pu être creéé et/ou le fichier tranféré" ); 
                }
                else
                {
                  success( '<strong>Vos sources ont bien été déposées</strong>. ' );

                  echo "<script type='text/javascript'>setTimeout(function() {
                  document.location.replace('gestion-p.php?P=". $_GET['P']."');
                  }, 3000);</script>";

                  
                }
            }
          }
        }
      }
    ?>
  </body>
</html>