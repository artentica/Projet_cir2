<?php 
  require 'include/bdd.php';
  require 'include/global.php';
  connect();
  forprof();

?>
<!DOCTYPE html>
<html>
  <head>
    <?php require 'include/head.php'; ?>
  </head>

  <body>
    <div      class="container">

      <nav    class="navbar navbar-inverse">
        <ul   class="nav navbar-nav">
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
      <div        class="row" >
        <article  class="col-sm-8 col-sm-offset-2">
          <div id="Cetat" class="row cols-xs-12 alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;
            </button>
            <p id="etat" class="text-center"><span id="loading" class="glyphicon glyphicon-refresh"></span></p>
          </div>
          <a href="modif.php?P=<?= $_GET['P'] ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-wrench"></span> Modifier</a>
          <a href="#" id="lancement_all" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-list"></span> Lancer les tests pour tout le monde</a>
          <a href="gestion-p.php?P=<?= $_GET['P'] ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-refresh"></span> Rafraîchir la vue</a>
          <?php
          
            if( isset($_GET['P']) )
            {

              $pro = Select("SELECT * FROM PROJECT WHERE PROJECT_ID=" . $_GET['P'] );
              if( isset( $pro[0] ) )
              {
                $pro  = $pro[0];
                $res  = Select("SELECT DISTINCT LOGIN FROM RESULT WHERE PROJECT_ID=". $_GET['P'] );
                echo('
                    <table            class="table table-striped table-bordered table-hover table-responsive">
                            <caption  class="text-success" >' . $pro['NAME'] . '</caption>
                      <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Tests effectués</th>
                            <th>Lancer un test</th>
                        </tr>
                      </thead>
                      <tbody>');
                foreach ($res as $key => $val) {
                    echo('<tr class=" text-center ">
                            <td>' . $val[0] . '</td>
                            <td>
                              <a      class="btn btn-primary btn-success" href="view.php?P='. $_GET['P'] .'&U='. $val[0] .'">
                                <span class="glyphicon glyphicon-eye-open"></span> Voir
                              </a>
                            </td>
                            <td>
                              <a class="test-e btn btn-primary btn-success" value="' . $val[0] . '" href="#">
                                <span class="glyphicon glyphicon-list"></span> Lancer
                              </a>
                            </td>
                          </tr>');
                }
                echo '</tbody>
                    </table> ';

                // A REPRENDRE PLUS TARD OU A SUPPRIMER
                $date_b =   Select("SELECT DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=". $_GET['P'] );
                $lim    =   new DateTime( trim( $date_b[0][0] ) );
                $now    =   new DateTime();
                $diff   =   $lim->diff( $now );
                echo('
                  <p>Avancement du projet</p>
                  <div    class="progress progress-striped active">
                    <div  class="progress-bar" style="width: ' . $diff->format('%a') . '%"></div>
                  </div>
                ');
              }
              else
              {
                header("location: choose-p.php");
              }
            }
            elseif( isset(  $_GET['del']  ) ){

              system('rm -rf ' . escapeshellarg( "upload/project"         . $_GET['del'] ), $retval );
              $nb   = Ins("DELETE FROM RESULT WHERE PROJECT_ID="          . $_GET['del'] );
              $nb   = Ins("DELETE FROM SUBTEST WHERE PROJECT_ID="         . $_GET['del'] );
              $nb   = Ins("DELETE FROM TEST WHERE PROJECT_ID="            . $_GET['del'] );
              $nb   = Ins("DELETE FROM TEACHER_PROJECT WHERE PROJECT_ID=" . $_GET['del'] );
              $nb   = Ins("DELETE FROM PROJECT WHERE PROJECT_ID="         . $_GET['del'] );
              header("location: choose-p.php");
            }
            else{
              header("location: choose-p.php");
            }
          ?>
          <a href="xls.php?P=<?=$_GET['P'] ?>" class="btn btn-lg btn-warning" target="_BLANK">
            <span class="glyphicon glyphicon-download-alt"></span>
              Télécharger le resumé ( .xls )
          </a>
        </article>
      </div>
    </div>
    <script type="text/javascript">
      var p = <?= $_GET['P']?>
    </script>
    <?php if( isset($_GET['launcher']) && $_GET['launcher']=='1')
            {echo "<script type=\"text/javascript\">
            $( document ).ready( function(){
              $('#Cetat').show();
              $.ajax({
                type: 'GET',
                url: 'recup.php?P=' + '".$_GET['P']."' + '&U=all',
                timeout: 25000,
                success: function(data) {
                  $('#etat').html( data );
                  //setTimeout( refresh(), 10000);
                },
                error: function() {
                  alert('La requête n\'a pas abouti'); 
                  //refresh();
                }
              });});</script>";
          
            }

            if( isset($_GET['launcher']) && $_GET['launcher']=='0')
            {echo "<script type=\"text/javascript\">
            $( document ).ready( function(){
              $('#Cetat').show();
              $.ajax({
                type: 'GET',
                url: 'recup.php?P=' + '".$_GET['P']."' + '&U=student',
                timeout: 25000,
                success: function(data) {
                  $('#etat').html( data );
                  //setTimeout( refresh(), 10000);
                },
                error: function() {
                  alert('La requête n\'a pas abouti'); 
                  //refresh();
                }
              });});</script>";
          
            }
          

            ?>
  </body>
</html>