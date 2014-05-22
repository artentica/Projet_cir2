<?php
	session_start();
	//# des fonctions a implementer dans le site

	//Fonction qui affeiche le boutton pour deconnecter
	function deco(){
		echo('<a href="connexion.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> Deconnexion</a>');
	}

	//fonction de test d'identification , renvoi sur la page login si n'est pas identifier
	function isco(){
		if( !isset( $_SESSION['log'] ) OR $_SESSION['log'] != "ok"){						//     <-- A completer
			header("Location: login.php");
		}
	}

	//fonction de test si la personne connéctée est un prof
	function forprof(){
		if(){

		}
	}

	//fonction de test si la personne connéctée est un élève
	function foretud(){

	}