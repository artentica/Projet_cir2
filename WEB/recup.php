<?php	
	$GLOBALS['check_lunch_test'] = 'aaaaaa';
	require 'include/global.php';
	require 'include/bdd.php';
	connect();

	$U 		= $_GET['U'];
	$P 		= $_GET['P'];
	$users 	= array();

	$path 	= 	"upload/project" . $_GET['P'] . '/'; 
	$junit 	= 	"upload/junit-4.0.jar";

	$tab 	= array();

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


		foreach ($users as $num => $user) { //POUR CHACUN DES ELEVES


			success('############################################### COMPILATION CLASSE DE TEST ##############################################<br>');
			$GLOBALS['check_lunch_test'] = 'bbb';
			$cmd = 'javac -encoding utf-8 -cp ' . $junit . ':'.$path.$user.':upload/:. '. $path .'tests/*.java 2>&1';
			//echo $cmd;
			exec( $cmd , $sortie, $code); // compile tout les .java contenus dans dossier tests

			
			if( $code != 0 ) print_r( $sortie );
			else{

				success('la classe de test a compilé correctement...<br>');
				success('############################################### COMPILATION PROJET ######################################################<br>');
				$GLOBALS['check_lunch_test'] = 'ccc';

				system( 'rm -rf '. $path . $user . '/*.class');	// nettoyage dossier eleve
				exec('javac -encoding utf-8 ' . $path . $user .'/*.java 2>&1', $sortie, $code);		// compilation   sources eleve

				if( $code != 0 ) print_r( $sortie );
				else{
					success('la classe de l\'élève a compilé...');
					success('############################################### LANCEMENT DU TEST #######################################################<br>');
					$GLOBALS['check_lunch_test'] = 'ddd';

					if( is_dir($path.'tests')){
						$dir = opendir($path.'tests'); 
			            $delimiter=".";
			            while($file = readdir($dir)) {
			                if($file != '.' && $file != '..')
			                {
			                  $explode=explode($delimiter, $file);
			                }
			            }

			            closedir($dir);

			            $cmd = 'java -cp ' . $junit . ':' . $path .'tests:' . $path . $user . ':upload:. Runner '. $path.$user ."/ ". $explode[0] .' 2>&1';
			            //echo $cmd.'<br>';
						exec( $cmd , $sortie, $code);	//AJOUTER LES PARAMETRES

						if( $code != 0 ) print_r( $sortie );
						else{
							if( file_exists( $path.$user.'/result.txt' )){	//LE FICHIER DE RESULTATS A BIEN ETE ECRIT

								success('Le test a bien été éxécuté.');

								$GLOBALS['num_test'] 		= 1;
								$GLOBALS['num_ss_test'] 	= 1;
								$i 		= 0;

								if( !$fp = fopen( $path.$user.'/result.txt' ,"r")){
									echo('<h1>fichier pas ouvert</h1>');
								} 
								while (!feof($fp)) { 
		  							$ligne 		= fgets($fp, 2000); // lecture du contenu de la ligne
		  							$result 	= explode("/$/", $ligne);		//recupere chaque parties sur une ligne de resultat
		  							if( isset($result[2]) ){
		  								$tab[ ++$i ][0] =	$result[0];
		  								$tab[   $i ][1] =	$result[5];
		  								$tab[   $i ][2] =	$result[2];
		  								$tab[	$i ][3] =	$result[3];
		  								$tab[	$i ][4] =	$result[4];
									}
								}
								//print_r($tab);
								foreach ($tab as $k => $inf) {
										// NOM    NOTE_M   VAL_T    STATUS   DESC
									addM($inf[0], $inf[1], $inf[2], $inf[3], $inf[4], $user	);
								}
<<<<<<< HEAD
								system("rm -rf " . $path.$user.'/result.txt' );
								$GLOBALS['check_lunch_test'] = 'eee';
=======
								// system("rm -rf " . $path.$user.'/result.txt' );
>>>>>>> b687dab83b9e04ec72e31c102fd018cf5892ba4b
							}
						}
					}
					else{
						echo 'pas de dossier';
					}
				}
			}
		}
	}
	else
	{
		erreur('Les données ne sont pas bonnes.');
	}

?>