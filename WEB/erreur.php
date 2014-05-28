<!DOCTYPE html>
<html>
    <head>
        <?php 
         require 'include/head.php';
         require 'include/global.conf';
        ?>
       
    </head>

    <body>
      <div class="jumbotron" >
      <h1>Une erreur est survenue...</h1>
      <a href="<?= $GLOBALS['page_connexion'] ?>" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-home"></span> Retour au site</a>
      </div>
      <div class="container" >
         <div class="row" >
            <div class="col-sm-6 text-center col-sm-offset-3 alert alert-dismissable alert-warning">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <?php
                  echo $_GET['erreur'] . " : ";
                  switch($_GET['erreur'])
                  {
                     case '400':
                     echo 'Échec de l\'analyse HTTP.';
                     break;
                     case '401':
                     echo 'Le pseudo ou le mot de passe n\'est pas correct !';
                     break;
                     case '402':
                     echo 'Le client doit reformuler sa demande avec les bonnes données de paiement.';
                     break;
                     case '403':
                     echo 'Requête interdite !';
                     break;
                     case '404':
                     echo 'La page n\'existe pas ou plus !';
                     break;
                     case '405':
                     echo 'Méthode non autorisée.';
                     break;
                     case '500':
                     echo 'Erreur interne au serveur ou serveur saturé.';
                     break;
                     case '501':
                     echo 'Le serveur ne supporte pas le service demandé.';
                     break;
                     case '502':
                     echo 'Mauvaise passerelle.';
                     break;
                     case '503':
                     echo ' Service indisponible.';
                     break;
                     case '504':
                     echo 'Trop de temps à la réponse.';
                     break;
                     case '505':
                     echo 'Version HTTP non supportée.';
                     break;
                     case 'droit':
                     echo "Vous essayez d'acceder a du contenu qui ne vous etes pas destiné.";
                     break;
                     default:
                     echo 'Erreur !';
                  }
               ?>
            </div>
         </div>
      </div>
   </body>
</html>