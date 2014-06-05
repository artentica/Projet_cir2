<html>
	<head>
		<?php require 'include/head.php'; ?>
	</head>
<?php
	require 'include/global.php';
	require 'include/bdd.php';

	$U 		= $_GET['U'];
	$P 		= $_GET['P'];
	$users 	= array();

	$path 	= 	"upload/project" . $_GET['P'] . '/'; 
	$junit 	= 	"upload/junit-4.0.jar";
	$file 	= 	"test.txt";		//fichier resultat

	if( !empty($_GET['U']) && !empty($_GET['P']))
	{
		if($U == 'all')
		{
			$rep = Select('SELECT DISTINCT LOGIN  FROM STUDENT');
			foreach ($rep as $k => $val) {
				array_push($users, $val['LOGIN']);
			}
		}
		else{
			array_push($users, $U);
		}
		//print_r($users);	//DEBUG






		success('############################################### COMPILATION CLASSE DE TEST ##############################################<br>');
		exec('javac -encoding utf-8 -cp ' . $junit . ':. '. $path .'/tests/*.java 2>&1', $sortie, $code); // compile tout les .java contenus dans dossier tests
		
		if( $code != 0 ) print_r( $sortie );
		else{

			success('la classe de test a compiler...<br>');
			success('############################################### COMPILATION PROJET ######################################################<br>');

			foreach ($users as $num => $user) { //POUR CHACUN DES ELEVES

				system( 'rm -rf '. $path . $user . '/*.class');	// nettoyage dossier eleve
				exec('javac -encoding utf-8 ' . $path . $user .'/*.java 2>&1', $sortie, $code);		// compilation   sources eleve

				if( $code != 0 ) print_r( $sortie );
				else{
					success('la classe de l\'eleve a compiler...');
					success('############################################### LANCEMENT DU TEST #######################################################<br>');

					//exec('java -cp ' . $junit . ':' . $path .'/tests:' . $path . $user . ':. Runner 2>&1', $sortie, $code);	//AJOUTER LES PARAMETRES

					if( false /*$code != 0*/ ) print_r( $sortie );
					else{
						if( file_exists($file)){	//LE FICHIER DE RESULTATS A BIEN ETE ECRIT

							success('Le test a bien été éxécuter.');

							$num_test 		= 0;
							$num_ss_test 	= 0;

							$fp = fopen( /*$path .*/ $file ,"r"); 
							while (!feof($fp)) { 
	  							$ligne 		= fgets($fp, 2000); // lecture du contenu de la ligne
	  							$result 	= explode("/$/", $ligne);		//recupere chaque parties sur une ligne de resultat
	  							print_r($result);
	  							$idtest 	= addTest( $P , ++$num_test, $result[0], $result[5]);
	  							$idSStest 	= addSSTest($P, $idtest, ++$num_ss_test, "val", $result[2]);
								addResult( $user, $P, $idtest, $idSStest, $result[3], $result[4] );
							}
						}
					}
				}

				/*$fp = fopen( $path . $file ,"r"); 
				while (!feof($fp)) { 
	  				$page .= fgets($fp, 2000); // lecture du contenu de la ligne


	  				//stock
				}*/

				//system("rm -rf " . $path . $file , $retval);
			}
		}
	}
	else
	{
		erreur('Les données ne sont pas bonnes.');
	}

?>