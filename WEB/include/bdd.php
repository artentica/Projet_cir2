<?php

	$host = "localhost";
	$dbname = "administrateur";
	$user = "administrateur";
	$passwd = "adminadmin";

	$rep = array();

	try
	{
		// On se connecte à MySQL
		$db = new new PDO('mysql:host='. $host .';dbname='. $dbname, $user, $passwd);
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		echo('Impossible de se connecter a la base de donnée...');
        die('Erreur : '.$e->getMessage());
	}

	//Permet de faire des requettes de type SELECT dans la Base de donnée
	function Select( $string ){

		$tmp = $db->query( $string );
		$rep = $tmp->fetchAll();
		return ( $rep != NULL ) ? TRUE : FALSE; 

	}

	//Permet de faire des requettes de type INSERT ou DELETE dans la Base de donnée
	function Insert( $string ){

	}
?>