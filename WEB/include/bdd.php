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
			//echo $string; 				//DEBUG
			$tmp = $db->query( $string );
			if($tmp != FALSE)
			{
				$rep = $tmp->fetchAll() ;
				//print_r( $rep ); 		//DEBUG
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
	/*function addTest( $id, $no, $nom, $note ){
		$req = Select( "SELECT TEST_NUM FROM TEST WHERE NAME='$nom'");
		//print_r($req);		//DEBUG
		if ( !empty($req[0]) ){
			return $req[0][0];
		}
		else //ON AJOUTE LE TEST
		{
			$li = Ins("INSERT INTO TEST VALUES( $id, $no, '$nom', $note )");
			$GLOBALS['num_test'] ++;
			$GLOBALS['num_ss_test'] = 0;
			return $li;
		}
	}

	//AJOUT DU SOUS TEST
	function addSSTest( $id, $no, $noo, $typ, $val){
		$req = Select("SELECT SUBTEST_NUM FROM SUBTEST WHERE VALEUR='$val' AND TEST_NUM=$no ");
		//print_r( $req );
		if ( !empty($req[0]) )
		{
			return $req[0][0];
		}
		else{
			$list =	Ins("INSERT INTO SUBTEST VALUES( $id, $no, $noo, '$typ', '$val' )");
			$GLOBALS['num_ss_test']++;
			return $list;
		}
	}

	//AJOUT DU RESULTAT
	function addResult( $user , $P, $no, $noo, $s, $d ){
		$sql = "INSERT INTO RESULT VALUES('$user', $P, $no, $noo, $s, '$d')";
		//echo($sql);
		Ins($sql);
	}*/

	function addM( $nom , $N, $VT, $S, $D){
		$P = $_GET['P'];  

		$sql = "SELECT TEST_NUM FROM TEST WHERE NAME='$nom' && PROJECT_ID=$P";
		//echo $sql;
		$req = Select($sql);
		//print_r($req);

		if( !empty( $req[0][0]) )	//	LE TEST EXISTE
		{
			$idTest = $req[0][0];	
			//echo "testn $idTest<br>";
		}
		else{
			$t = Ins("INSERT INTO TEST VALUES(	$P, ". $GLOBALS['num_test']++ .", '$nom', $N)");
			$a = Select("SELECT TEST_NUM FROM TEST WHERE NAME='$nom' && PROJECT_ID=$P");
			//print_r($a);
			$idTest = $a[0][0];
			//echo 'test ajouté';
		}
		//ON A L ID DU TEST

		$req = Select("SELECT SUBTEST_NUM FROM SUBTEST WHERE VALEUR='". $VT ."' && PROJECT_ID=$P && TEST_NUM=$idTest");
		//print_r( $req );
		if( !empty( $req[0][0]) )	//	LE SOUSTEST EXISTE
		{
			$idSSTest = $req[0][0];	
<<<<<<< HEAD
			//echo "SStest trouvé $idSSTest";
=======
			echo 'SStest trouvé';
>>>>>>> 8ca69611504741823bcef418b964e200b09381c5
		}
		else{		//DOIT CREER LE SOUS TEST
			$sqlb = "INSERT INTO SUBTEST ( PROJECT_ID, TEST_NUM, SUBTEST_NUM,                    KIND,  VALEUR) 
						 		   VALUES( $P,         $idTest ,". $GLOBALS['num_ss_test']++ .", 'val', '$VT' )";
			echo '<br>'.$sqlb;
			$b = Ins( $sqlb );
			$req = Select("SELECT SUBTEST_NUM FROM SUBTEST WHERE VALEUR='". $VT ."' && PROJECT_ID=$P");
			$idSSTest = $req[0][0];
			echo 'SStest ajouté';
		}
	}
?>