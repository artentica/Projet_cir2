<?php
	error_reporting(E_ALL);
	$rep = array();

	//Permet de faire des requettes de type SELECT dans la Base de donnée
	function Select( $string )
	{
		try
		{
			// On se connecte à MySQL
			$db  = new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['userdb'], $GLOBALS['passwd'], array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			echo $string; 				//DEBUG
			$tmp = $db->query( $string );
			if($tmp != FALSE)
			{
				$rep = $tmp->fetchAll() ;
				print_r( $rep ); 		//DEBUG
			}
			$db  = NULL;

			return ( isset($rep) ) ? $rep : False;
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo 	('Impossible de se connecter à la base de donnée!');
	        die 	('Erreur : '.$e->getMessage() );
		}
	}

	//Permet de faire des requettes de type INSERT ou DELETE dans la Base de donnée
	function Ins( $string )
	{
		try
		{	// On se connecte à MySQL
			$db = 	new PDO('mysql:host=' . $GLOBALS['host'] . ';dbname='. $GLOBALS['dbname'], $GLOBALS['userdb'], $GLOBALS['passwd']);
			$nb = 	$db->exec( utf8_decode( $string ) );
			return 	$db->lastInsertId();
		}
		catch( Exception $e )
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			echo('Impossible de se connecter à la base de donnée!');
	        die ('Erreur : '.$e->getMessage());
		}
	}

	//AJOUT DE TESTS
	function addTest( $id, $no, $nom, $note ){
		$req = Select( 'SELECT TEST_NUM FROM TEST WHERE NAME=' . $nom);
		print_r($req);
		if ( !empty($req[0]) ){
			return $req[0][0];
		}
		else //ON AJOUTE LE TEST
		{
			return Ins("INSERT INTO TEST VALUES( $id, $no, '$nom', $note )");
		}
	}

	//AJOUT DU SOUS TEST
	function addSSTest( $id, $no, $noo, $typ, $val){
		$req = Select('SELECT SUBTEST_NUM FROM SUB_TEST WHERE VALEUR=' . $val);
		if ( $req[0] )
		{
			return $req[0][0];
		}
		else{
			return Ins("INSERT INTO SUB_TEST VALUES( $id, $no, $noo, '$typ', '$val' )");
		}
	}

	//AJOUT DU RESULTAT
	function addResult( $user , $P, $no, $noo, $s, $d ){
		Ins("INSERT INTO RESULT VALUES('$user', $P, $no, $noo, $s, '$d')");
	}
?>