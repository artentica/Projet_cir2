<?php
	error_reporting(E_ALL);
	$rep = array();

	//  PERMET DE FAIRE DES REQUETTES DE TYPE "SELECT" DANS LA BASE DE DONNÉE
	function Select( $string )
	{
		try
		{
			if( D_sql ) echo "<code>$string</code>";
			// On se connecte à MySQL
			$db  = new PDO('mysql:host=' . host . ';dbname='. dbname, userdb, passwd, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$tmp = $db->query( $string );

			if($tmp != FALSE)
			{
				$rep = $tmp->fetchAll() ;
				if(D_sql) print_r( $rep ); 		//DEBUG
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

	//  PERMET DE FAIRE DES REQUETTES DE TYPE "INSERT" "UPDATE" OU "DELETE" DANS LA BASE DE DONNÉE
	function Ins( $string )
	{
		try
		{	
			if( D_sql ) echo "<code>$string</code>";
			// On se connecte à MySQL
			$db = 	new PDO('mysql:host=' . host . ';dbname='. dbname, userdb, passwd);
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

	function addM( $nom , $N, $VT, $S, $D, $u, $nb_fonction){
		$P = $_GET['P'];  

		$sql = "SELECT TEST_NUM FROM TEST WHERE NAME='$nom' && PROJECT_ID=$P";
		$req = Select($sql);

		if( !empty( $req[0][0]) )	//	LE TEST EXISTE
			$idTest = $req[0][0];	
		else
		{
			$a = Ins("INSERT INTO TEST VALUES(	$P, ". $GLOBALS['num_test']++ .", '$nom', $N)");

			$req = Select("SELECT TEST_NUM FROM TEST WHERE NAME='$nom'");

			$idTest = $req[0][0];
		}
		//ON A L ID DU TEST

		$req = Select("SELECT SUBTEST_NUM FROM SUBTEST WHERE VALEUR='$VT' && TEST_NUM=$idTest && PROJECT_ID=$P ");
		


		if( !empty( $req[0][0]) )	//	LE SOUSTEST EXISTE
			$idSSTest = $req[0][0];	
		else 			//DOIT CREER LE SOUS TEST
		{		
			$a = Ins("INSERT INTO SUBTEST ( PROJECT_ID, TEST_NUM, SUBTEST_NUM,                    KIND,  VALEUR) 
						 		   VALUES( $P,         $idTest ,". $GLOBALS['num_ss_test']++ .", $nb_fonction, '$VT' )");

			$req = Select("SELECT SUBTEST_NUM FROM SUBTEST WHERE VALEUR='$VT' && TEST_NUM=$idTest && PROJECT_ID=$P ");
			$idSSTest = $req[0][0];
		}
		//ON A L ID SS TEST
		$sql = "INSERT INTO RESULT VALUES('$u', $P, $idTest, $idSSTest, $S, '$D'  )";
		if( D_sql ) echo "<code>$cmd</code>";
		$n = Ins($sql);
	}
?>