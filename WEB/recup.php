<?php
	require 'include/global.php';
	require 'include/bdd.php';

	$U 		= $_GET['U'];
	$P 		= $_GET['P'];
	$users 	= array();

//	executer le runner
//####################################################################################
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
//####################################################################################
		//print_r($users);	//DEBUG

		$path = "upload/project" . $P . '/'; 
		$file = "mon fichier";

		echo('############################################### COMPILATION CLASSE DE TEST ##############################################<br>');
		exec("javac -encoding utf-8 -cp upload/junit-4.0.jar:. ". $path ."/tests/*.java 2>&1", $sortie, $code); // compile tout les .java contenus dans dossier tests
		
		if( $code != 0 ) print_r( $sortie );
		else{

			echo('la classe de test a compiler...<br>');
			echo('############################################### COMPILATION PROJET ######################################################<br>');
			foreach ($users as $num => $user) { //POUR CHACUN DES ELEVES

				system( 'rm -rf '. $path . $user . '/*.class');	// nettoyage dossier eleve
				exec('javac -encoding utf-8 ' . $path . $user .'/*.java 2>&1', $sortie, $code);		// compilation   sources eleve
				if( $code != 0 ) print_r( $sortie );
				else{
					echo('la classe de l\'eleve a compiler...');
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