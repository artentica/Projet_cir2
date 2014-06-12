<?php
	session_start();
	require 'include/global.conf';		// INCLUSION DU FICHIER DE CONFIGURATION
	//# des fonctions a implementer dans le site

//########################################MENU#############################################
	
	// Ajoute un boutton acceuil
	function acc()
	{
		$page = ($_SESSION['groupe'] == p_group ) ? "choose-p" : "choose-p" ;
      	echo ('
      		<div class="navbar-header">
        		<a class="navbar-brand" href="' . $page . '.php">Accueil</a>
      		</div>
      	');
	}
	// Ajoute boutton creer un projet
	function cre()
	{
		echo '<li>	<a href="create.php" >Créer un projet</a></li>';
	}
	//PERMET DE DEPOSER UN FICHIER
	function depot()
	{	
		if(isset($_GET['P']))
		echo('<li><a href="depot.php?P=' . $_GET['P'] . '">Déposer les sources</a></li>');
	}
	//PERMET DE METTRE UN BOUTON POUR RETOURNER A LA FICHE DU PROJET
	function retour()
	{
		$page    = ( C_prof() ) ? 'p' : 'e';
		echo('<li>
            	<a href="gestion-' . $page . '.php?P=' . $_GET['P'] . '" >
              		Retour au projet 
            	</a>
          	</li>');
	}
	//FONCTION QUI AFFEICHE LE BOUTTON POUR DECONNECTER
	function deco()
	{
		echo('<a href="deconnexion.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-user"></span> Deconnexion</a>');
	}
	//FONCTION HELLO A VINCENT ;-)
	function hello()
	{
		echo( "<p>Bonjour <b>" . $_SESSION['prenom'] ." ". $_SESSION['nom'] ."</b>, il est <b>". date("H:i") ."</b> nous sommes le <b>" . date("d/m/Y") . "</b>.</p>" );
	}

//########################################UTILISATEUR#######################################

	//VERIFIE SI L UTILISATEUR EST CONNECTER
	function connect()
	{
		if( !isset($_SESSION['login']) ){
			header("Location: erreur.php?erreur=droit");
		}
	}
	//FONCTION DE TEST SI LA PERSONNE CONNÉCTÉE EST UN PROF
	function C_prof()
	{
		return ($_SESSION['groupe'] == p_group ) ? TRUE : FALSE ;
	}
	// pages reserver aux professeurs
	function forprof()
	{
			if( !C_prof() ){
				header("Location: erreur.php?erreur=droit");
			}
	}
	// pages reservées aux etudiants
	function foretud()
	{
			if( !in_array( $_SESSION['groupe'], p_group ) ){
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
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 alert alert-dismissable alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					'. $S .'
				</div>
			</div>
		');
	}
	//Fonction pour deposer les tests dans le bon dossier, supprime tout si non vide
	function Dpottest($id, $f){
		print_r($f);
		$path	= 	"upload/project". $id ."/tests/";
		$nom 	= 	$path . $f['name'];

		system('rm -rf ' . $path ."*" , $retval );
		$resultat 	= 	move_uploaded_file($f['tmp_name'], $nom);
		return true;
	}
?>
