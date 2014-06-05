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
		print_r($users);

		$path = "upload/project" . $P; 
		$file = "mon fichier";

		exec("javac -cp upload/junit-4.0.jar:/var/www/Projet_cir2/JAVA/TestRunner/projet/depot:. /var/www/Projet_cir2/JAVA/TestRunner/projet/test/MoneyTest.java 2>&1", $cs);
		print_r( $cs );

		/*foreach ($users as $num => $user) { //POUR CHACUN DES ELEVES
			
			system();		//lance le runner et crée le fichier

			$fp = fopen( $path . $file ,"r"); 
			while (!feof($fp)) { 
  				$page .= fgets($fp, 2000); // lecture du contenu de la ligne


  				//stock
			}

			system("rm -rf " . $path . $file , $retval);
		}*/

	}
	else
	{
		erreur('Les données ne sont pas bonnes.');
	}

?>