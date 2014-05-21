<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	require 'include/head.php';
	require 'include/bdd.php';



	if(isset($_POST['username']) && isset($_POST['password'])){

		$rep=Select('SELECT username, password FROM utilisateur');
		while($data = mysql_fetch_assoc($rep)){
           if ($data['LOGIN']==$_POST['username'] && $data['PASSWORD']==$_POST['password']) {
             $_SESSION['log'] = 'ok';
             header('Location: choose.php');
           }
	}
}
	?>

</head>

<body>
	<div class="container" >
		<div class="row">


			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Entrez votre identifiant et votre mot de passe</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<form class="form-horizontal" action="connexion.php" method="POST">


							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="textinput">Identifiant:</label>  
								<div class="col-md-4">
									<input id="textinput" name="username" class="form-control input-md input-xs" type="text">  
								</div>
							</div>

							<!-- Password input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="passwordinput">Mot de passe:</label>
								<div class="col-md-4">
									<input id="passwordinput" name="password" class="form-control input-md" type="password">
								</div>
							</div>

							<!-- Button -->
							<div class="form-group">
								<div class="col-md-4 col-md-offset-4">
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