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
    	<div 		class="container">
      		<nav 	class="navbar navbar-inverse">
        		<ul class="nav navbar-nav">
          			<?php acc(); 
          				  depot();
          			?>
          			<form class="navbar-form pull-right">  
          				<li>	<?php deco(); ?>	</li>
          			</form>
        		</ul>
      		</nav>

      		<?php hello(); ?>
      		<div 		 class="row" >
        		<article class="col-sm-8 col-sm-offset-2">
        			<div id="Cetat" class="row cols-xs-12 alert alert-success">
		            	<button type="button" class="close" data-dismiss="alert">&times;
		            	</button>
		            	<p id="etat" class="text-center"><span id="loading" class="glyphicon glyphicon-refresh"></span></p>
		        	</div>
		        	<a href="#" value="<?= $_SESSION['login'] ?>" class="btn btn-xs btn-primary test-e"><span class="glyphicon glyphicon-list"></span> Lancer les tests</a>
		        	<?php
		            	if( isset($_GET['P']) ){
			              	$pro 	= Select("SELECT * FROM PROJECT WHERE PROJECT_ID=" . $_GET['P']	);
				            if( isset($pro[0]) ){
				                $pro = $pro[0];
				                echo('
				                    <table 		 class="table table-striped table-bordered table-hover table-responsive">
				                        <caption class="text-success" >' . $pro['NAME'] . '</caption>
				                      	<thead>
				                        	<tr>
				                            	<th>Date butoire</th>
				                            	<th>Résultat du test</th>
				                        	</tr>
				                      	</thead>
				                      <tbody>');
				                          echo('<tr class=" text-center ">
				                              		<td>' . $pro[2] . '</td>
				                              		<td>
				                                		<a 			class="btn btn-primary btn-success" href="view.php?P='. $pro[0] .'&U='. $_SESSION['login'] .'" >
				                                  			<span 	class="glyphicon glyphicon-eye-open"></span> Voir
				                                		</a>
				                              		</td>
				                            	</tr>');
				                echo('</tbody>
				                    </table>
				                ');

				                // A REPRENDRE PLUS TARD OU A SUPPRIMER
				                $date_b 	= Select("SELECT DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=". $_GET['P'] );
				                $lim 		= new DateTime(trim( $date_b[0][0] ));
				                $now 		= new DateTime();
				                $diff 		= $lim->diff( $now );
				                echo('
				                	<p>Avancement du projet</p>
				                  	<div 		class="progress progress-striped active">
				                    	<div 	class="progress-bar" style="width: ' . $diff->format('%a') . '%"></div>
				                  	</div>');
				            }
			              	else{
			                	echo( " Le projet concerné n'a pas été trouvé" );
			                	acc();
			              	}
		            	}
			            else{
			              echo( 'Impossible de trouver le projet concerné' );
			              acc();
			            }
		      		?>
        		</article>
        	</div>
      	</div>
      	<script type="text/javascript">
      		var p = <?= $_GET['P']?>
    	</script>
    </body>
</html>