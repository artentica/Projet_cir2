<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	<body>
	<p>Hello ISEN php pour debutant</p>
		<form action="connexion.php" method="POST">
			<label>Séléctionner un utilisateur</label>
			<select name="choix">
				<option value="prof">professeur</option>
				<option value="elev">élève</option>
			</select>
			<input type="submit"/>

		</form>
	<?php phpinfo(); ?>
	</body>
</html>
