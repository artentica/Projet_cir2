<?php require 'include/bdd.php';
      require 'include/global.php';
      forprof();

      $projets = Select("SELECT * FROM PROJET");
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
          <?php acc(); 
                cre();
          ?>
          <form class="navbar-form pull-right">  
            <li class="">	<?php deco(); ?>	</li>
          </form>
        </ul>
      </nav>

      <?php hello(); ?>
      <div class="row" >
        <article class="col-sm-8 col-sm-offset-2">
          <?php
                  if( isset($_GET['P']) /*&& is_int($_GET['P'])*/ ){
                    $depot = Select("SELECT * FROM DEPOT WHERE ID_PROJET=" . $_GET['P']);
                    if($depot){
                      $name = Select("SELECT NOM_PROJET FROM PROJET WHERE ID_PROJET=" . $depot[0]{1} );
                      echo('
                          <table class="table table-striped table-bordered table-hover table-responsive">
                                  <caption class="text-success" >' . $name[0]{0} . '</caption>
                            <thead>
                              <tr>
                                  <th>Identifiant</th>
                                  <th>Date du dépot</th>
                                  <th>Test effectuer</th>
                              </tr>
                            </thead>
                            <tbody>');
                              foreach ($depot as $key => $val) {
                                echo('<tr class=" text-center ">
                                    <td>' . $val[0] . '</td>
                                    <td>' . $val[2] . '</td>
                                    <td><a href="#" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-eye-open"></span> Voir</a></td>
                                  </tr>
                                ');
                              }
                      echo('</tbody>
                        </table>
                      ');

                      // A REPRENDRE PLUS TARD OU A SUPPRIMER
                      $date_b = Select("SELECT DATE_BUTOIRE FROM PROJET WHERE ID_PROJET=". $_GET['P'] );
                      $lim = new DateTime(trim( $date_b[0][0] ));
                      $now = new DateTime();
                      $diff = $lim->diff( $now );
                      echo('
                        <p>Avancement du projet</p>
                        <div class="progress progress-striped active">
                          <div class="progress-bar" style="width: ' . $diff->format('%a') . '"></div>
                        </div>
                      ');
                    }
                  }
          ?>
        </article>
      </div>
    </div>
  </body>
</html>