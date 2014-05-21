<?php

	$GLOBALS['host'] = "127.0.0.1";
	$GLOBALS['dbname'] = "administrateur";
	$GLOBALS['user'] = "administrateur";
	$GLOBALS['passwd'] = "adminadmin";

	error_reporting(E_ALL);
	$rep = array();

	//Permet de faire des requettes de type SELECT dans la Base de donnée
	function Select( $string )
	{
		try
		{
			// On se connecte à MySQL
			$db = new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['user'], $GLOBALS['passwd']);
			//echo $string; //DEBUG
			$tmp = $db->query( $string );
			if($tmp != FALSE)
			{
				$rep = $tmp->fetchAll() ;
				print_r($rep); 		//DEBUG
			}
			$db = NULL;
			return $rep; 
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo('Impossible de se connecter a la base de donnée...');
	        die('Erreur : '.$e->getMessage());
		}
	}

	//Permet de faire des requettes de type INSERT ou DELETE dans la Base de donnée
	function Insert( $string )
	{
		try
		{
			// On se connecte à MySQL
			$db = new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['user'], $GLOBALS['passwd']);
				try
				{
					$db->exec( $string );
				}
				catch ( PDOException $e )
				{
					echo ("Impossible d'executer la requette." );
					return false;
				}
				return true;
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo('Impossible de se connecter a la base de donnée...');
	        die('Erreur : '.$e->getMessage());
		}
	}



?>