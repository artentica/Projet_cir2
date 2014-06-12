<?php require_once 'include/bdd.php';
	  require_once 'include/global.php';
	  connect();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php 
			require_once 'include/head.php'; 
			$prof 	 = ( C_prof() ) ? 'p' : 'e';
			$projets = ( C_prof() ) ? Select("SELECT * FROM PROJECT") : Select("SELECT * FROM PROJECT"); 
		?>
	</head>

	<body>
		<div 	 	class="container">
			<nav 	class="navbar navbar-inverse">
				<ul class="nav navbar-nav">
					<?php acc(); 
						  if( C_prof() ){ 	cre();	  } //SI PROF ALORS ECRIT LE LIEN CREATION PROJET
					?>
					<form class="navbar-form pull-right">  
						<li>	<?php deco(); ?>	</li>
					</form>
				</ul>
			</nav>

			<?php hello(); ?>
			<div 		class="panel panel-primary">
				<div 	class="panel-heading">
					<h3 class="panel-title text-center">
						CHOIX DU PROJET
					</h3>
				</div>
				<div 	class="panel-body">

					<div class="panel-group" id="accordion1">
						<?php
							foreach ($projets as $key => $val) 	//POUR CHAQUE PROJET DANS LA TABLE PROJECT
							{	
								$req = Select('SELECT COUNT( DISTINCT LOGIN) FROM RESULT WHERE PROJECT_ID=' . $val[0] );
								$N_D = $req[0][0];

								echo('<div 	 	   class="panel panel-default">
										<div 	   class="panel-heading">
											<h4    class="panel-title">
												<a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse'. $val[0] .'">'
													. $val[1] .
												'</a>
											</h4>
										</div>
										<div 	   class="panel-body collapse" id="collapse'. $val[0] .'" >
											<div   class="panel-inner">
												Projet N°'. $val[0] . ":
												<ul>
													<li> Nom: <b>" . $val[1] . "</b></li>
													<li> Date butoire: <b>". $val[2] .'</b></li>
													<li> Nombre de dépot: <b>' . $N_D . '</b></li>
												</ul>
												<a class="col-md-2 col-md-offset-2 btn btn-primary btn-warning" href="gestion-'. $prof .'.php?P=' . $val[0] . '">
													<span class="glyphicon glyphicon-briefcase"></span>
													Voir le Projet
												</a>
												<a class="raz col-md-2 col-md-offset-1 btn btn-primary btn-danger" value="'. $val[0] .'" href="#">
													<span class="glyphicon glyphicon-floppy-remove"></span>
													RAZ résultat
												</a>
												<a id="check_del" class="col-md-2 col-md-offset-1 btn btn-primary btn-danger" href="gestion-p.php?del='. $val[0] .'">
													<span class="glyphicon glyphicon-trash"></span>
													Supprimer projet
												</a>
											</div>
										</div>
									</div>');
							}
						?>
	            	</div>
	        	</div>
	    	</div>
		</div>
	</body>
</html>