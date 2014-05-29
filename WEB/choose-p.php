<?php require 'include/bdd.php';
	  require 'include/global.php';

	  $projets = Select("SELECT * FROM PROJECT");
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require 'include/head.php'; 
			if( C_prof() ){
				$prof = 'p';
			}
			else{
				$prof = 'e';
			}
		?>
	</head>

	<body>
		<div class="container">
			<nav class="navbar navbar-inverse">
				<ul class="nav navbar-nav">
					<?php acc(); 
						  if( C_prof() ){ 	cre();	  } //SI PROF ALORS ECRIT LE LIEN CREATION PROJET
					?>
					<form class="navbar-form pull-right">  
						<li class="">
							<?php deco(); ?>
						</li>
					</form>
				</ul>
			</nav>

			<?php hello(); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title text-center">CHOIX DU PROJET</h3>
				</div>
				<div class="panel-body">

					<div class="panel-group" id="accordion1">
						<?php
							foreach ($projets as $key => $val) {
								echo('
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse'. $val[0] .'">' . $val[1] . '</a>
											</h4>
										</div>
										<div id="collapse'. $val[0] .'" class="panel-body collapse">
											<div class="panel-inner">
												Projet N°'. $val[0] . ":
												<ul>
													<li> Nom: <b>" . $val[1] . "</b></li>
													<li> date butoire: <b>". $val[2] .'</b></li>
												</ul>
												<a href="gestion-'. $prof .'.php?P=' . $val[0] . '" class="col-md-2 col-md-offset-10 btn btn-primary btn-warning">
													<span class="glyphicon glyphicon-briefcase"></span>
													Voir le Projet
												</a>
											</div>
										</div>
									</div>
									');
							}
						?>
	            	</div>
	        	</div>
	    	</div>

		</div>
	</body>
</html>