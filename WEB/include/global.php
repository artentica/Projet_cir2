<?php
	session_start();
	require 'include/global.conf';
	//# des fonctions a implementer dans le site

	// Ajoute un boutton acceuil
	function acc()
	{
		$page = ($_SESSION['groupe'] == $GLOBALS['p_group']) ? "choose-p" : "choose-p" ;
      	echo ('
      		<div class="navbar-header">
        		<a class="navbar-brand" href="' . $page . '.php">Accueil</a>
      		</div>
      	');
	}

	// ajoute boutton creer un projet
	function cre()
	{
		echo '<li>	<a href="create.php" >Créer un projet</a></li>';
	}

	//PERMET DE DEPOSER UN FICHIER
	function depot(){
		echo('<li><a href="depot.php?P=' . $_GET['P'] . '">Déposer les sources</a></li>');
	}

	//Fonction qui affeiche le boutton pour deconnecter
	function deco()
	{
		echo('<a href="deconnexion.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-user"></span> Deconnexion</a>');
	}

	//fonction hello a vincent ;-)
	function hello()
	{
		echo( "<p>Bonjour " . $_SESSION['prenom'] ." ". $_SESSION['nom'] .", il est <b>". date("H:i") ."</b> nous sommes le <b>" . date("d/m/Y") . "</b></p>" );
	}

	//fonction de test si la personne connéctée est un prof
	function C_prof()
	{
		return ($_SESSION['groupe'] == $GLOBALS['p_group'] ) ? TRUE : FALSE ;
	}

	function forprof()
	{
			if( !C_prof() ){
				header("Location: erreur.php?erreur=droit");
			}
	}

	//fonction de test si la personne connéctée est un élève
	function foretud()
	{
			if( !in_array( $_SESSION['groupe'], $GLOBALS['p_group'] ) ){
				header("Location: erreur.php?erreur=droit");
			}
	}

	//fonction pour afficher les erreurs
	function erreur( $E )
	{
		echo('
			<div class="col-sm-8 col-sm-offset-2 alert alert-dismissable alert-danger">
			    <button type="button" class="close" data-dismiss="alert">×</button>
			    <strong>Oups...</strong> ' . $E . '.
			</div>
		');
	}

	//AFFICHE UNE BOX POUR QUELQUE CHOSE QUI A REUSSI
	function success( $S )
	{
		echo('
			<div class="col-sm-8 col-sm-offset-2 alert alert-dismissable alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				'. $S .'
			</div>
		');
	}
?>
