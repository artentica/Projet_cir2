<?php require 'include/bdd.php';
		require 'include/global.php';
		forprof();

		$projets = Select("SELECT * FROM PROJET");
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require 'include/head.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/datepicker3.css">
		<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
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

					<div id="" class="form-group">
						<label class="col-md-4 control-label" for="date">Date limite de depot</label>
						<div id="datepicker-container" class="input-group date">
  							<input class="form-control input-sm" type="text" name="date" >
  								<span class="input-group-addon">
  									<i class="glyphicon glyphicon-calendar"></i>
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
	</body>
	<script type="text/javascript">
		$('.input-group.date').datepicker({
		    format: "dd/mm/yyyy",
		    todayBtn: true,
		    language: "fr",
		    autoclose: true,
		    todayHighlight: true
		});
	</script>
</html>