<?php
	require 'include/bdd.php';
	require 'include/global.php';
	connect();
?>
<html>
	<head>
		<?php require 'include/head.php';	?>
		<link 	type="text/css" rel="stylesheet"  href="css/datepicker.css">
		<link 	type="text/css" rel="stylesheet"  href="css/datepicker3.css">
		<link 	type="text/css" rel="stylesheet"  href="css/clockpicker.css">
		<script type="text/javascript" 			  src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" 			  src="js/clockpicker.js"></script>
	</head>
	<body>
		<nav 	class="navbar navbar-inverse">
			<ul class="nav navbar-nav">
				<?php 
					acc(); 
					cre();
					retour();
				?>
				<form class="navbar-form pull-right">  
					<li>	<?php deco(); ?>	</li>
				</form>
			</ul>
		</nav>

		<?php
			forprof();

			$P = $_GET['P'];

			//MODIFICATIONS DONNEES
			if (	!empty($_POST['nom'])	)
			{
				$nb = Select("UPDATE PROJECT SET NAME='" . $_POST['nom'] . "' WHERE PROJECT_ID=" . $P);
				success('Le nom du projet a été modifié');
			}

			if (	!empty($_POST['date'])	&&		!empty($_POST['heure'])	)
			{
				$date	= $_POST['date'] . " " . $_POST['heure'] . ":00";
				$nb 	= Select("UPDATE PROJECT SET DATE_BUTOIRE='" . $date . "' WHERE PROJECT_ID=" . $P );
				success('La date et l\'heure du projet ont été modifiées');
			}

			if (	!empty($_FILES['class']['name'])		)
			{

				//Dpottest( $P, $_FILES['class']);
				$path	= 	"upload/project". $P ."/tests/";
				exec( "rm -R " . $path . "*" ); // VIDE LE DOSSIER
				$zip = new ZipArchive;
							$resultat=$zip->open($_FILES['class']['tmp_name']);
				            if ($zip->open($_FILES['class']['tmp_name']) === TRUE) {
				                $resultat=$zip->extractTo($path);
				                $zip->close();
				            }
				success('Le fichier de test a été modifié');

				////////RECOMPILATIONS AVEC LES NOUVEAUX TEST///////////////////////////
				echo "<script type='text/javascript'>setTimeout(function() {
                  document.location.replace('gestion-p.php?P=". $_GET['P']."&launcher=1');
                  }, 2500);</script>";
					

			}


			//CHARGEMENT DES DONNEES INITIALES
			if ( isset( $P ) ) //PRET A MODIFIER
			{
				$req 	= Select('SELECT NAME, DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=' . $P );
				$pro 	= $req[0];
				$date 	= explode(" ", $pro['DATE_BUTOIRE']);
			}
			else{
				erreur('Nous avons un problème, vous ne pouvez pas faire de modifications ainsi.');
				retour();
			}

		?>
		<form class="form-horizontal" action="modif.php?P=<?= $P ?>" method="POST" enctype="multipart/form-data" >
			<fieldset>
				<legend>Formulaire de modifiaction de projet</legend>
				<div 				class="form-group">
					<label 			class="col-md-4 control-label" for="nom">Nouveau nom du projet</label>  
			  		<div 			class="col-md-3">
				  		<div 		class="input-group">
				  			<input 	class="form-control input-sm" name="nom" type="text" placeholder="<?= $pro['NAME'] ?>" >
				    		<span 	class="input-group-addon ">
					        	<i 	class="glyphicon glyphicon-folder-open"></i>
				    		</span>
				  		</div>
					</div>
				</div>


				<!--  DATE PICKER-->
				<div 				class="form-group">
					<label 			class="col-md-4 control-label" 	for="date">Date limite de depot</label>
					<div 			class="input-group date" 		id="datepicker-container">
						<input 		class="form-control input-sm" 	name="date" type="text" placeholder="<?= $date[0] ?>">
							<span 	class="input-group-addon">
								<i 	class="glyphicon glyphicon-calendar"></i>
							</span>
					</div>
				</div>
				<!--  CLOCK PICKER-->
				<div 			  class="form-group " 			 data-placement="right" data-align="top" data-autoclose="true">
					<label 		  class="col-md-4 control-label" for="heure">Heure</label>
					<div 		  class="clockpicker input-group">
					    <input 	  class="form-control" 			 type="text" 			name="heure" 	 placeholder="<?= $date[1] ?>">
					    <span 	  class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>
				</div>
				<!-- File Button --> 
				<div 		class="form-group">
				  <label 	class="col-md-4 control-label" for="class">Fichier de test</label>
				  <div 		class="col-md-4">
				    <input 	class="input-file" 			   id="class" name="class" type="file" >
				    <span 	class="help-block ">Format attendu: .zip <small>Vous n'êtes pas obligé de remettre un fichier</small></span>
				  </div>
				</div>

				<!-- Button -->
				<div 		class="form-group">
				  <label 	class="col-md-4 control-label" for="submit">créer le projet</label>
				  <div 		class="col-md-1 input-group">
				    <input 	class="btn btn-success" type="submit"/>
				  </div>
				</div>
				<span class="label label-danger col-xs-offset-4">Si vous modifiez la date pensez à changer l'heure et inversement</span>
			</fieldset>
		</form>
	</body>
	<script type="application/javascript">
		$('.input-group.date').datepicker({
		    format: "yyyy-mm-dd",
		    todayBtn: true,
		    language: "fr",
		    autoclose: true,
		    todayHighlight: true
		});

		$('.clockpicker').clockpicker({
		    placement: 'bottom',
		    align: 'left',
		    donetext: 'OK',
		    autoclose: true,
		    'default': 'now',
		});
	</script>
</html>