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
          <?php acc(); ?>
          <li>	<a href="#" >Créer un projet</a>	</li>
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
                    echo('
                        <table class="table table-striped table-bordered table-hover ">
                                <caption>coucou</caption>
                          <thead>
                            <tr>
                                <th>Identifiant</th>
                                <th>Date du dépot</th>
                                <th>Test effectuer</th>
                            </tr>
                          </thead>
                          <tbody>');
                            foreach ($depot as $key => $val) {
                              echo('<tr>
                                  <td>' . $val[0] . '</td>
                                  <td>' . $val[2] . '</td>
                                  <td><a href=""></a></td>
                                </tr>
                              ');
                            }
                    echo('</tbody>
                      </table>
                    ');
                  }
          ?>
        </article>
      </div>
    </div>
  </body>
</html>