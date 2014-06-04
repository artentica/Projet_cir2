<?php require 'include/bdd.php';
      require 'include/global.php';
      connect();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php require 'include/head.php'; ?>
    <style>
      .panel-body{
        padding:0;
      }
      .table{
        margin-bottom: 0;
      }
    </style>
  </head>

  <body>
    <div    class="container">

      <nav  class=" navbar navbar-inverse">
        <ul class="navbar-nav nav">
          <?php acc(); 
                if( C_prof() ) cre();
                retour();
          ?>

          <form class="navbar-form pull-right">  
            <li>	<?php deco(); ?>	</li>
          </form>
        </ul>
      </nav>

      <?php hello(); ?>
      <div        class="row" >
        <article  class="col-sm-8 col-sm-offset-2">
          <div    class="panel panel-primary">
            <div  class="panel-heading">
              <h3 class="panel-title">
                Résultats:
              </h3>
            </div>
            <div      class="panel-body">
              <table  class="table table-striped table-bordered table-hover text-center" >
                <thead>
                  <tr>
                    <th>Fonction testée</th>
                    <th>Note du test</th>
                    <?php if( C_prof() ){ 
                      echo '<th>Type de test</th>'; 
                      echo '<th>Valeur(s) utilisée(s)</th>';
                    }
                    ?>
                    <th>retour</th>
                    <?php if(C_prof() ) echo '<th>Description</th>'; ?>
                  </tr>
                </thead>
          <?php

            $pro = $_GET['P'];
            $use = $_GET['U'];

            if( C_prof() )  //SI prof
            {
                  $sql = "SELECT T.NAME, T.MARK, S.KIND, S.VALEUR, R.STATUS, R.DESCRIPTION 
                          FROM TEST T

                          INNER JOIN SUBTEST S
                          ON S.PROJECT_ID = T.PROJECT_ID
                            AND S.TEST_NUM = T.TEST_NUM

                          INNER JOIN RESULT R
                          ON R.PROJECT_ID = T.PROJECT_ID
                            AND R.TEST_NUM = T.TEST_NUM
                            AND R.SUBTEST_NUM = S.SUBTEST_NUM

                          WHERE R.PROJECT_ID=$pro 
                            AND R.LOGIN='$use'";
                  
                  $rep      = Select( $sql );
                  $note     = 0;
                  $_SESSION['bareme_'. $pro ] =   array();
                  $_SESSION['bareme']   =   0;

                  foreach ($rep as $key => $val) {
                    $O = ( $val[4] > 0 ) ? 'OK' : 'KO';
                    echo "<tr>
                            <td> $val[0] </td>
                            <td> $val[4] / $val[1] </td>
                            <td> $val[2] </td>
                            <td> $val[3] </td>
                            <td>    $O   </td>
                            <td> $val[5] </td>
                          </tr>" ;
                    $note     += $val[4];
                  }
                  $B    = Select('SELECT SUM(MARK) FROM TEST WHERE PROJECT_ID=' . $pro );
                  $bareme = $B[0][0];
            }
            else{ // SI ELEVE
                  $sql = "SELECT T.NAME, T.MARK, S.KIND, S.VALEUR, R.STATUS, R.DESCRIPTION 
                          FROM TEST T

                          INNER JOIN SUBTEST S
                          ON S.PROJECT_ID = T.PROJECT_ID
                            AND S.TEST_NUM = T.TEST_NUM

                          INNER JOIN RESULT R
                          ON R.PROJECT_ID = T.PROJECT_ID
                            AND R.TEST_NUM = T.TEST_NUM
                            AND R.SUBTEST_NUM = S.SUBTEST_NUM

                          WHERE R.PROJECT_ID=$pro 
                            AND R.LOGIN='$use'";
                  
                  $rep = Select( $sql );

                  foreach ($rep as $key => $val) {
                    $O = ( $val[4] > 0 ) ? 'OK' : 'KO';
                    echo "<tr>
                            <td> $val[0] </td>
                            <td> $val[4] / $val[1] </td>
                            <td>  $O </td>
                          </tr>" ;
                  }
            }
          ?>
              </table>
            </div>
          </div>
          <?php 
            if(C_prof()) echo "NOTE: " . $note . "/" . $bareme; 
          ?>
        </article>
      </div>
    </div>
  </body>
</html>