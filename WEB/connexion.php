<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	require 'include/head.php';
	require 'include/bdd.php';

	$panel="primary";
	$instruction="Entrez votre identifiant et votre mot de passe";

	if(isset($_POST['username']) && isset($_POST['password'])){

		$rep=Select('SELECT LOGIN, PASSWORD, STATUE FROM UTILISATEUR');
		foreach($rep as $key => $data){
           if ($data['LOGIN']==$_POST['username'] && $data['PASSWORD']==$_POST['password']) {
             $_SESSION['log'] = 'ok';
             $_SESSION['name'] = $_POST['username'];
             $_SESSION['statue'] = $data['STATUE'];
             header('Location: choose.php');             
           }
        	else { 
        		$panel="danger";
        		$instruction="Couple Identifiant/Mot de passe Incorrect";
        	}
	}
}
	?>

</head>

<body>
	<div class="container" >
		<div class="row">


			<div class="panel panel-<?php echo $panel; ?>">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $instruction; ?></h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<form class="form-horizontal" action="connexion.php" method="POST">


							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Identifiant:</label>  
								<div class="col-md-4">
									<input id="textinput" name="username" class="form-control input-md input-xs" type="text" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" required>  
								</div>
							</div>

							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="passwordinput">Mot de passe:</label>
								<div class="col-md-4">
									<input id="passwordinput" name="password" class="form-control input-md" type="password"  required>
								</div>
							</div>

							<!-- Button -->
							<div class="form-group">
								<div class="col-md-4 col-md-offset-5">
									<button id="singlebutton" name="singlebutton" class="btn btn-primary">SE CONNECTER</button>
								</div>
							</div>


						</form>
					</div>
				</div>



			</div>
		</div>
	</div>
</body>
</html>