<?php

	$GLOBALS['host'] = "127.0.0.1";
	$GLOBALS['dbname'] = "administrateur";
	$GLOBALS['userdb'] = "administrateur";
	$GLOBALS['passwd'] = "adminadmin";

	error_reporting(E_ALL);
	$rep = array();

	//Permet de faire des requettes de type SELECT dans la Base de donnée
	function Select( $string )
	{
		try
		{
			// On se connecte à MySQL
			$db = new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['userdb'], $GLOBALS['passwd'], array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			echo $string; //DEBUG
			$tmp = $db->query( $string );
			if($tmp != FALSE)
			{
				$rep = $tmp->fetchAll() ;
				print_r($rep); 		//DEBUG
			}
			$db = NULL;
			return (isset($rep)) ? $rep : False;
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo('Impossible de se connecter a la base de donnée...');
	        die('Erreur : '.$e->getMessage());
		}
	}

	//Permet de faire des requettes de type INSERT ou DELETE dans la Base de donnée
	function Ins( $string )
	{
		try
		{
			// On se connecte à MySQL
			$db = new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['userdb'], $GLOBALS['passwd']);
			$nb = $db->exec( utf8_decode($string) );
			return $db->lastInsertId();
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo('Impossible de se connecter a la base de donnée...');
	        die('Erreur : '.$e->getMessage());
		}
	}



?>