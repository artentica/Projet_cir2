<?php require 'include/bdd.php';
      require 'include/global.php';
      forprof();
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
                depot();
          ?>
          <li>
            <a id="check_del" href="gestion-p.php?del=<?= $_GET['P'] ?>" > Supprimer le projet </a>
          </li>
          <form class="navbar-form pull-right">  
            <li>	<?php deco(); ?>	</li>
          </form>
        </ul>
      </nav>

      <?php hello(); ?>
      <div class="row" >
        <article class="col-sm-8 col-sm-offset-2">
          <?php
            if( isset($_GET['P']) ){
              $pro = Select("SELECT * FROM PROJECT WHERE PROJECT_ID=" . $_GET['P']);
              if( isset($pro[0]) ){
                $pro = $pro[0];
                $res = Select("SELECT DISTINCT LOGIN FROM RESULT WHERE PROJECT_ID=". $_GET['P']);
                echo('
                    <table class="table table-striped table-bordered table-hover table-responsive">
                            <caption class="text-success" >' . $pro['NAME'] . '</caption>
                      <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Tests effectuer</th>
                        </tr>
                      </thead>
                      <tbody>');
                        foreach ($res as $key => $val) {
                          echo('<tr class=" text-center ">
                              <td>' . $val[0] . '</td>
                              <td>
                                <a href="#" class="btn btn-primary btn-success">
                                  <span class="glyphicon glyphicon-eye-open"></span> Voir
                                </a>
                              </td>
                            </tr>
                          ');
                        }
                echo('</tbody>
                    </table>
                ');

                // A REPRENDRE PLUS TARD OU A SUPPRIMER
                $date_b = Select("SELECT DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=". $_GET['P'] );
                $lim = new DateTime(trim( $date_b[0][0] ));
                $now = new DateTime();
                $diff = $lim->diff( $now );
                echo('
                  <p>Avancement du projet</p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: ' . $diff->format('%a') . '%"></div>
                  </div>
                ');
              }
              else{
                echo(" Le projet concerné n'a pas été trouver...");
                acc();
              }
            }
            elseif( isset($_GET['del'])){

              system('rm -rf ' . escapeshellarg("upload/project".$_GET['del']), $retval);
              $nb = Ins("DELETE FROM SUBTEST WHERE PROJECT_ID=".$_GET['del'] );
              $nb = Ins("DELETE FROM TEST WHERE PROJECT_ID=".$_GET['del'] );
              $nb = Ins("DELETE FROM RESULT WHERE PROJECT_ID=".$_GET['del'] );
              $nb = Ins("DELETE FROM TEACHER_PROJECT WHERE PROJECT_ID=".$_GET['del'] );
              $nb = Ins("DELETE FROM PROJECT WHERE PROJECT_ID=".$_GET['del'] );
            }
            else{
              echo('Impossible de trouver le projet concerné...');
              acc();
            }
      ?>
        </article>
      </div>
    </div>
    <script type="text/javascript">

      $('#check_del').click( function(){
          var conf = confirm('Etes-vous sur de vouloir supprimer le projet?');
          if (conf == true) { return true; } 
          else { return false; }
      });
    </script>
  </body>
</html>