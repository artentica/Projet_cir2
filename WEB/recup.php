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

							$GLOBALS['num_test'] 		= 1;
							$GLOBALS['num_ss_test'] 	= 1;
							$tab 	= array();
							$i 		= 0;

							$fp = fopen( /*$path .*/ $file ,"r"); 
							while (!feof($fp)) { 
	  							$ligne 		= fgets($fp, 2000); // lecture du contenu de la ligne
	  							$result 	= explode("/$/", $ligne);		//recupere chaque parties sur une ligne de resultat
	  							if( isset($result[2]) ){

	  								$tab[ ++$i ][0] =	$result[0];
	  								$tab[   $i ][1] =	$result[5];
	  								$tab[   $i ][2] =	$result[2];
	  								$tab[	$i ][3] =	$result[3];
	  								$tab[	$i ][4] =	$result[4];


	  								//$liT	= addTest( 		$P, $GLOBALS['num_test'], $result[0], $result[5]);
	  								//$liST 	= addSSTest(  	$P, $liT, $GLOBALS['num_ss_test'], "val", $result[2]);
	  								//addResult	  (  $user, $P, $liT, $liST, $result[3], $result[4]);
								}
							}
						}
					}
				}
				//print_r($tab);
				foreach ($tab as $k => $inf) {
						// NOM    NOTE_M   VAL_T    STATUS   DESC
					addM($inf[0], $inf[1], $inf[2], $inf[3], $inf[4]	);
				}






				//system("rm -rf " . $path . $file , $retval);
			}
		}
	}
	else
	{
		erreur('Les données ne sont pas bonnes.');
	}

?>