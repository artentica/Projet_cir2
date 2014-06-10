<?php

	
	require 'include/global.php';
	require 'include/bdd.php';
	echo 'Début du Runner <br>';
	connect();

	$U 		= $_GET['U'];
	echo '<h1>'.$U.'</h1>';
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

			if( is_dir($path.$user))
			{
				echo 'Compilation de la classe de test <br>';
				$cmd = 'javac -encoding utf-8 -cp ' . $junit . ':'.$path.$user.':upload/:. '. $path .'tests/*.java 2>&1';
				echo $cmd;
				exec( $cmd , $sortie, $code); // compile tout les .java contenus dans dossier tests

				
				if( $code != 0 )
				{
					print_r( $sortie ) ;
				}
				else{

					echo $user.'Compilation du projet';

					system( 'rm -rf '. $path . $user . '/*.class');	// nettoyage dossier eleve
					exec('javac -encoding utf-8 ' . $path . $user .'/*.java 2>&1', $sortie, $code);		// compilation   sources eleve

					if( $code != 0 )
					{
						print_r( $sortie );
					}
					else{

						echo $user.': Lancement du test';

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

							if( $code != 0 )
							{
								print_r( $sortie );
							}
							else{
								if( file_exists( $path.$user.'/result.txt' )){	//LE FICHIER DE RESULTATS A BIEN ETE ECRIT

									//success('Le test a bien été éxécuté.');

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
			  								$tab[	$i ][5] =	$result[1];
										}
									}
									//print_r($tab);
									foreach ($tab as $k => $inf) {
											// NOM    NOTE_M   VAL_T    STATUS   DESC
										addM($inf[0], $inf[1], $inf[2], $inf[3], $inf[4], $user, $inf[5]	);
									}
									system("rm -rf " . $path.$user.'/result.txt' );
									echo 'fin de programme';
								}

								//print_r($tab);
								foreach ($tab as $k => $inf) {
										// NOM    NOTE_M   VAL_T    STATUS   DESC
									addM($inf[0], $inf[1], $inf[2], $inf[3], $inf[4], $user	);
								}
								// system("rm -rf " . $path.$user.'/result.txt' );
								echo 'fin de programme';
							}
						}
						else{
							//echo 'pas de dossier';
						}
					}
				}
			}
		}
	}
	else
	{
		echo 'Les données ne sont pas bonnes.';
	}

?>