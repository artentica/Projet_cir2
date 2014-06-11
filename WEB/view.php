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
              <h3 class="panel-title">   Résultats:  </h3>
            </div>
            <div      class="panel-body">
              <table  class="table table-striped table-bordered table-hover text-center" >
                <thead>
                  <tr>
                    <th>Fonction testée</th>
                    <?php if( !C_prof() ){ 
                      echo '<th>Resultat des tests</th>';
                    }
                    else{ 
                      echo '<th>Note du test</th>';
                      echo '<th>Type de test</th>'; 
                      echo '<th>Valeur(s) utilisée(s)</th>';
                    }
                    ?>
                    <th>retour</th>
                    <?php if(C_prof() ) echo '<th>Description</th>'; ?>
                  </tr>
                </thead>
                <?php

                  $P = $_GET['P'];
                  $user = $_GET['U'];

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

                            WHERE R.PROJECT_ID=$P 
                              AND R.LOGIN='$user'";
                    
                    $rep      = Select( $sql );
                    $note     = 0;

                    foreach ($rep as $key => $val) {
                      $OK = ( $val[4] > 0 ) ? 'OK' : 'KO'; //SI STATUS >0

                      if ($val[4]>0)                        //SI STATUS >0
                        $points=round($val[1] / $val[2],2); //  NOTE max / NB fois appel de la foncfion
                      else 
                        $points=0;

                      echo "<tr>
                              <td> $val[0] </td>
                              <td> $points </td>
                              <td> $val[2] </td>
                              <td> $val[3] </td>
                              <td>    $OK   </td>
                              <td> $val[5] </td>
                            </tr>" ;
                      $note     += $points;


                    }
                    $B    = Select('SELECT SUM(MARK) FROM TEST WHERE PROJECT_ID=' . $P );
                    $bareme = $B[0][0];
                    if($note >$bareme)$note=$bareme;
                  }
                  else{ // SI ELEVE
                    $rep = Select("SELECT T.NAME, R.STATUS
                            FROM TEST T

                            INNER JOIN SUBTEST S
                            ON S.PROJECT_ID = T.PROJECT_ID
                              AND S.TEST_NUM = T.TEST_NUM

                            INNER JOIN RESULT R
                            ON R.PROJECT_ID = T.PROJECT_ID
                              AND R.TEST_NUM = T.TEST_NUM
                              AND R.SUBTEST_NUM = S.SUBTEST_NUM

                            WHERE R.PROJECT_ID=$P 
                              AND R.LOGIN='$use'");
                    $name_tmp="lol";
                    $name_tmp2="loli";
                    $total=0;
                    $total_tmp=0;
                    $total_tmp2=0;
                    foreach ($rep as $key => $val) {
                      //$O = ( $val[4] > 0 ) ? 'OK' : 'KO';
                      $name_fct=$val[0];

                      if ($name_tmp2==$name_tmp && $name_tmp2!="loli") {
                        $total++;
                      }
                      elseif ($name_tmp2!="lol" && $name_tmp2!="loli"){
                        $total++;
                      echo "<tr>
                              <td> $name_tmp2 </td>
                              <td> ".$total."</td>
                              <td>   </td>
                            </tr>" ;
                     
                      $total=0;
                          }
                           $name_tmp2=$name_tmp;
                      $name_tmp=$val[0];
                    }
                    if ($name_tmp!=$name_tmp2) {
                     echo "<tr>
                              <td> $name_tmp2 </td>
                              <td> ".++$total."</td>
                              <td>   </td>
                            </tr>" ;
                    }
                    else $total+=2;
                        echo "<tr>
                              <td> $name_tmp </td>
                              <td> ".$total."</td>
                              <td>   </td>
                            </tr>" ;
                    
                    

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