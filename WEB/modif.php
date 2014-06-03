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
		<?php
			require 'include/bdd.php';
			require 'include/global.php';

			forprof();

			$P = $_GET['P'];
			//CHARGEMENT DES DONNEES INITIALES
			if ( isset( $P ) ) //PRET A MODIFIER
			{
				$req 	= Select('SELECT NAME, DATE_BUTOIRE FROM PROJECT WHERE PROJECT_ID=' . $P );
				$pro 	= $req[0];
				$date 	= explode(" ", $pro['DATE_BUTOIRE']);
			}
			else{
				erreur('Nous avons un problème vous ne pouvez pas faire des modifications ainsi.');
				retour();
			}
			//MODIFICATIONS DONNEES

			if (	!empty($_POST['nom'])	)
			{
				echo 'nom modifier';
			}
			if (	!empty($_POST['date'])	&&		!empty($_POST['heure'])	)
			{
				echo 'date/heure modifier';
			}
			if (	!empty($_FILES['class']['filename'])		)
			{
				echo 'fichier modifier';
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
				    <span 	class="help-block ">Format attendu: .java .jar .zip <small>Vous n'êtes pas obliger de remettre un fichier</small></span>
				  </div>
				</div>

				<!-- Button -->
				<div 		class="form-group">
				  <label 	class="col-md-4 control-label" for="submit">créer le projet</label>
				  <div 		class="col-md-1 input-group">
				    <input 	class="btn btn-success" type="submit"/>
				  </div>
				</div>
				<span class="label label-danger col-xs-offset-4">Si vous modifiez la date penser a changer l'heure et inversement</span>
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