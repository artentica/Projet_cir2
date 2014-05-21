<?php
	//# des fonctions a implementer dans le site

	//Fonction qui affeiche le boutton pour deconnecter
	function deco(){
		echo('<a href="connexion.php" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-user"></span> Deconnexion</a>');
	}

	//fonction de test d'identification , renvoi sur la page login si n'est pas identifier
	function isco(){
		if( !isset($var) OR $var != ""){						//     <-- A completer
			header("Location: login.php");
		}
	}
?>