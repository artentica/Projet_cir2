<?php
	session_start();
	//# des fonctions a implementer dans le site

	//Fonction qui affeiche le boutton pour deconnecter
	function deco(){
		echo('<a href="deconnexion.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-user"></span> Deconnexion</a>');
	}

	//fonction de test d'identification , renvoi sur la page login si n'est pas identifier
	function isco(){
		if( !isset( $_SESSION['log'] ) OR $_SESSION['log'] != "ok"){						//     <-- A completer
			header("Location: login.php");
		}
	}

	//fonction de test si la personne connéctée est un prof
	function forprof(){
			isco();
			if( !isset($_SESSION['statut']) OR $_SESSION['statut'] != "Personel"){
				header("Location: erreur.php?erreur=droit");
			}
	}

	//fonction de test si la personne connéctée est un élève
	function foretud(){
			isco();
			if(isset($_SESSION['statue']) && $_SESSION['status'] != "etudiant"){
				header("Location: erreur.php?erreur=droit");
			}
	}

	// Ajoute un boutton acceuil
	function acc(){
		$page = ($_SESSION['statut'] == 'professeur') ? "choose-p" : "choose-e" ;
      	echo ('
      		<div class="navbar-header">
        		<a class="navbar-brand" href="choose-p.php">Accueil</a>
      		</div>
      	');
	}

	// ajoute boutton creer un projet
	function cre(){
		echo '<li>	<a href="create.php" >Créer un projet</a></li>';
	}

	//fonction hello a vincent ;-)
	function hello(){
		echo( "<p>Bonjour " . $_SESSION['name'] . ", il est <b>". date("H:i") ."</b> nous sommes le <b>" . date("d/m/Y") . "</b></p>" );
	}
?>