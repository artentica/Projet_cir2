<?php
	require 'include/global.php';
	require 'include/bdd.php';
	echo 'Début du Runner <br>';
	connect();

	$U 		= 	$_GET['U'];
	$P 		= 	$_GET['P'];
	$users 	= 	array();
	$path 	= 	"upload/project$P/"; 
	$junit 	= 	"upload/junit-4.0.jar";
	$tab 	= 	array();

	echo '<h1>'.$U.'</h1>';

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


		foreach ($users as $num => $user)		//POUR CHACUN DES ELEVES 
		{ 
			if( is_dir($path.$user) )
			{
				echo 'Compilation de la classe de test <br>';

				$cmd = "javac -encoding utf-8 -cp $junit:$path$user:upload/:. $path"."tests/*.java 2>&1";
				if(D_cmd) echo "<code>$cmd</code>";
				exec( $cmd , $sortie, $code); // compile tout les .java contenus dans dossier tests
				
				if( $code != 0 )
					print_r( $sortie ) ;
				else
				{
					echo 'Compilation du projet<br>';

					system( "rm -rf $path$user/*.class");	// nettoyage dossier eleve
					$cmd = "javac -encoding utf-8 $path$user/*.java 2>&1";
					if(D_cmd) echo "<code>$cmd</code>";
					exec($cmd, $sortie, $code);		// compilation   sources eleve

					if( $code != 0 )
						print_r( $sortie );
					else
					{
						echo 'Lancement du test<br>';

						if( is_dir($path.'tests'))
						{
							$dir = opendir($path.'tests'); 

							while($file = readdir($dir)) {

								if($file != '.' && $file != '..' && !strstr( $file, ".java" )) //EN GROS QUE LES .class
								{
									$explode=explode( ".", $file);
									$cmd = "java -cp $junit:$path"."tests:$path"."$user:upload:. Runner $path"."$user/ $explode[0] 2>&1";
									if(D_cmd) echo "<code>$cmd</code>";
									exec( $cmd , $sortie, $code);	//AJOUTER LES PARAMETRES
									if( $code != 0 )
										print_r( $sortie );
								}
							}
							closedir($dir);

							$useless=Ins("DELETE FROM RESULT WHERE PROJECT_ID=$P AND LOGIN='$user'");

							if( file_exists( $path.$user.'/result.txt' ))  //LE FICHIER DE RESULTATS A BIEN ETE ECRIT
							{	

								echo 'Le test a bien été éxécuté.<br>traitement du fichier<br>';

								$GLOBALS['num_test'] 		= 1;
								$GLOBALS['num_ss_test'] 	= 1;
								$i 		= 0;

								if( !$fp = fopen( $path.$user.'/result.txt' ,"r"))
								{
									echo('<h1>fichier pas ouvert</h1>');
								} 
								while (!feof($fp)) 
								{ 
		  							$ligne 		= fgets($fp, 2000); // lecture du contenu de la ligne
		  							$result 	= explode("/$/", $ligne);		//recupere chaque parties sur une ligne de resultat
		  							if( isset($result[2]) )
		  							{
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
		  							
										// NOM    NOTE_M   VAL_T    STATUS   DESC     LOGIN  NB_FOIS_TESTER
		  							addM($inf[0], $inf[1], $inf[2], $inf[3], $inf[4], $user, $inf[5]	);
		  						}
								system("rm -rf " . $path.$user.'/result.txt' );
		  						echo 'fin de programme<br>';
		  					}
			  				else
			  				{
							//echo 'pas de dossier';
			  				}
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