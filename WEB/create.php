<?php require 'include/bdd.php';
	  require 'include/global.php';
	  forprof();

	  $projets = Select("SELECT * FROM PROJECT");
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require 'include/head.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
		<link rel="stylesheet" type="text/css" href="css/clockpicker.css">
		<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="js/clockpicker.js"></script>

	</head>

	<body>
		<div class="container">

			<nav class="navbar navbar-inverse">
				<ul class="nav navbar-nav">
					<?php acc(); 
						  cre();
					?>
					<form class="navbar-form pull-right">  
						<li class="">	<?php deco(); ?>	</li>
					</form>
				</ul>
			</nav>

			<?php hello(); ?>

			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<fieldset>

					<!-- Form Name -->
					<legend>Formulaire de création de projet</legend>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="nom">Nom du projet</label>  
					  <div class="col-md-4">
					  	<input class="form-control input-sm" id="nom" name="nom" type="text" placeholder="caffard en C++"  required>
					  	<span class="help-block">entrez une phrase qui décrit le projet</span>  
					  </div>
					</div>
					<!--  DATE PICKER-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="date">Date limite de depot</label>
						<div id="datepicker-container" class="input-group date">
  							<input class="form-control input-sm" type="text" name="date" >
  								<span class="input-group-addon">
  									<i class="glyphicon glyphicon-calendar"></i>
  								</span>
						</div>
					</div>
					<!--  CLOCK PICKER-->
					<div class="form-group " data-placement="right" data-align="top" data-autoclose="true">
						<label class="col-md-4 control-label" for="heure">Heure</label>
						<div class="clockpicker input-group">
						    <input type="text" class="form-control" name="heure">
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
					</div>

					<!-- File Button --> 
					<div class="form-group">
					  <label class="col-md-4 control-label" for="class">Fichier de test ( attendu: xxx.java)</label>
					  <div class="col-md-4">
					    <input id="class" name="class" class="input-file" type="file" >
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="submit">créer le projet</label>
					  <div class="col-md-4">
					    <input type="submit" class="btn btn-default" />
					  </div>
					</div>

				</fieldset>
			</form>

		</div>
		<?php
			if(isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['heure']) /*&& isset($_FILES['icone']['name'])*/)		//LE FORMULAIRE EST REMPLI
			{
				$date = $_POST['date'] . " " . $_POST['heure'] . ":00";
				$req = "INSERT INTO PROJECT (NAME, DATE_BUTOIRE) VALUES ('". $_POST['nom'] ."', '". $date ."')";	
				echo $req;	//DEBUG
				$id = Ins( $req );
				echo('
					<div class="col-sm-8 col-sm-offset-2 alert alert-dismissable alert-success">
    					<button type="button" class="close" data-dismiss="alert">×</button>
    					<strong>Le projet a été créé avec succes</strong> Nom: ' . $_POST['nom'] . '  <a href="gestion-p.php?P='. $id .'" class="alert-link"> Voir le projet</a>.
					</div>

				');
			}



		?>
	</body>
	<script type="text/javascript">
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