<?php require 'include/bdd.php';
	  require 'include/global.php';
	  forprof();
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
					  		<div class="col-md-3">
						  		<div class="input-group">
						  			<input class="form-control input-sm" name="nom" type="text" placeholder="caffard en C++"  required>
						    		<span class="input-group-addon ">
							        	<i class="glyphicon glyphicon-folder-open"></i>
						    		</span>
						  		</div>
							</div>
					<span class="help-block col-lg-3 col-lg-offset-4">entrez une phrase qui décrit le projet</span>  
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
						<span class="help-block col-xs-offset-5">00/00/0000 par defaut.</span>
					</div>
					<!--  CLOCK PICKER-->
					<div class="form-group " data-placement="right" data-align="top" data-autoclose="true">
						<label class="col-md-4 control-label" for="heure">Heure</label>
						<div class="clockpicker input-group">
						    <input type="text" class="form-control" name="heure" required>
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
						<span class="help-block col-xs-offset-5">00:00 par defaut.</span>
					</div>
					<!-- File Button --> 
					<div class="form-group">
					  <label class="col-md-4 control-label" for="class">Fichier de test</label>
					  <div class="col-md-4">
					    <input id="class" name="class" class="input-file" type="file" required>
					    <span class="help-block ">Format attendu: .java .jar .zip</span>
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="submit">créer le projet</label>
					  <div class="col-md-1 input-group">
					    <input type="submit" class="btn btn-success" />
					    <span class="input-group-addon">
						    <i class="glyphicon glyphicon-ok"></i>
					    </span>
					  </div>
					</div>

				</fieldset>
			</form>

		</div>
		<?php
			if(isset($_POST['nom']) && isset($_POST['date']) && isset($_POST['heure']) && isset($_FILES['class']) )		//LE FORMULAIRE EST REMPLI
			{
				if( $_FILES['class']['error'] > 0) 
				{ 					
					$erreur = "Le transfert du fichier a échoué"; 
					erreur( $erreur);
				}
				else{						//LE FICHIER EST BIEN TRANSFERER

					$extension = strrchr($_FILES['class']['name'], '.');
					if( !in_array($extension, $extensions) )
					{
						erreur("Le format du fichier ne correspond pas...");
					}
					else
					{

						$T = Select("SELECT PROJECT_ID FROM PROJECT WHERE NAME='". $_POST['nom'] ."'");
						if( $T )
						{	//verifier nom et date
							erreur( "Le nom ou l'heure n'est pas valide....");
						}
						else
						{
							$date = $_POST['date'] . " " . $_POST['heure'] . ":00";
							$req = "INSERT INTO PROJECT (NAME, DATE_BUTOIRE) VALUES ('". $_POST['nom'] ."', '". $date ."')";	
							//echo $req;	//DEBUG
							$id = Ins( $req );


							$e = "INSERT INTO TEACHER_PROJECT (LOGIN, PROJECT_ID ) VALUES ('". $_SESSION['login'] ."', ". $id .")";
							//echo $e;
							$req = Ins($e);

							if( $id == 0) 
							{
								erreur( "La requette n'est pas passer, vérifiez le nom ainsi que la date et l'heure.");
							}
							else
							{			//LA REQUETTE EST PASSEE

								mkdir("upload/project". $id, 0777);
								mkdir("upload/project". $id . "/tests", 0777);

								//$resultat = move_uploaded_file($_FILES['class']['tmp_name'], "upload/project". $id ."/tests/". $_FILES['class']['tmp_name']);

								$nom = "upload/project". $id ."/tests/".$_FILES['class']['name'];
								$resultat = move_uploaded_file($_FILES['class']['tmp_name'], $nom);


								if( !$resultat) { erreur( "Le dossier n'a pas pu etre creer et le fichier copier..." ); }
								else
								{
									success( '<strong>Le projet a été créé avec succès</strong> Nom: ' . $_POST['nom'] . '  <a href="gestion-p.php?P='. $id .'" class="alert-link"> Voir le projet</a>.');
								}
							}
						}
					}
				}
			}

		?>
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