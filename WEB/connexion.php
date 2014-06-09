<html>
	<head>
		<? require 'include/head.php'; ?>
	</head>
	<body>
		<div class="container">
		<?php
			require 'include/bdd.php';
			require 'include/global.php';

//======================================================== DONNEES FACTICES ISSUENT DE L ENT =====================================================
			if( isset($_POST['choix']) && $_POST['choix'] == 'elev'){

				$userData["Login"]		 = 		"rcolli17";
				$userData["FirstName"]	 = 		"rémi";
				$userData["LastName"]	 = 		"collignon";
				$userData["Mail"] 		 = 		"rcd18@hotmail.fr";
				$groupeISEN 			 = 		"CIR2";
			}
			else{

				$userData["Login"]		 = 		"prof1";
				$userData["FirstName"]	 = 		"Didier";
				$userData["LastName"]	 = 		"Le Foll";
				$userData["Mail"] 		 = 		"rcd18@hotmail.fr";
				$groupeISEN 			 = 		"Personnel";
			}



//===============================================================================================================================================
							// RECUPERATION INFORMATION CAS
			$_SESSION['login'] 	= $userData["Login"];
			$_SESSION['prenom'] = $userData["FirstName"];
			$_SESSION['nom'] 	= $userData["LastName"];
			$_SESSION['mail']	= $userData["Mail"];
			$_SESSION['groupe'] = $groupeISEN;
//===============================================================================================================================================

			$prof = ( $_SESSION['groupe'] == $GLOBALS['p_group'] ) ? TRUE : FALSE ; // DETECTE SI C'EST UN PROF

			$user = ($prof) ? Select("SELECT * FROM TEACHER WHERE TEACHER.LOGIN='" . $userData["Login"] ."'") :	//LE RECHERCHE DANS LA BASE DE DONNEE
							  Select("SELECT * FROM STUDENT WHERE STUDENT.LOGIN='" . $userData["Login"] ."'");

			if( $user )	// SI IL EXISTE DANS LA BDD
			{
				echo '<div class="row col-sm-6 col-sm-offset-3">
						<table class="table table-striped table-bordered table-hover ">';

				foreach ($user as $key => $val) {	//REPERTORIE LES INFOS DE L UTILISATEUR
					echo('<tr><td>Identifiant   </td><td>' . $val['LOGIN'] . '</td></tr>');
					echo('<tr><td>Nom           </td><td>' . $val['LASTNAME'] . '</td></tr>');
					echo('<tr><td>Prénom        </td><td>' . $val['FIRSTNAME'] . '</td></tr>');
					echo('<tr><td>E-Mail        </td><td>' . $val['MAIL'] . '</td></tr>');
				}
				echo '  </table> ';
			}
			else  	//CREE L'UTILISATEUR EN BDD
			{
				echo '<p>inconnu, Premiere connexion</p>';
				if( $prof ){		//SI C EST UN PROF
					$nb = Ins("INSERT INTO TEACHER (LOGIN, LASTNAME, FIRSTNAME, MAIL) 
							   VALUES ('". $_SESSION['login'] ."', '". $_SESSION['nom'] ."', '". $_SESSION['prenom'] ."', '". $_SESSION['mail'] ."')" );
				}
				else
				{
					$nb = Ins("INSERT INTO STUDENT (LOGIN, LASTNAME, FIRSTNAME, MAIL) 
							   VALUES ('". $_SESSION['login'] ."', '". $_SESSION['nom'] ."', '". $_SESSION['prenom'] ."', '". $_SESSION['mail'] ."')" );
				}
			}
		?>
		</div>
		<div   class="row col-sm-2 col-sm-offset-5">
			<a class="btn btn-primary btn-success"href="choose-p.php" >
				<span class="glyphicon glyphicon-new-window"></span> Acceder a la page d'acceuil
			</a>
		</div>
	</div>
	</body>
</html>