<?php
	require 'include/global.php';
	require 'include/bdd.php';
	require 'include/PHPExcel.php';
	require 'include/PHPExcel/Writer/Excel5.php';
	connect();
	forprof();

	$P 			= 	$_GET['P'];
	$path 		= 	"./upload/project" . $P . "/";

	$workbook 	= 	new PHPExcel;
	$S 			= 	$workbook->getActiveSheet();
	$req 		= 	Select('SELECT * FROM PROJECT WHERE PROJECT_ID=' . $P);
	$pro 		= 	$req[0];

	//ENTETE TABLEAU
	$S->setCellValueByColumnAndRow( 0, 1, "PROJET:" 			);
	$S->setCellValueByColumnAndRow( 1, 1, $pro['NAME'] 			);
	$S->setCellValueByColumnAndRow( 2, 1, "DATE:" 				);
	$S->setCellValueByColumnAndRow( 3, 1, $pro['DATE_BUTOIRE'] 	);
	$S->setCellValueByColumnAndRow( 4, 1, "MOYENNE:" 			);

	//DEBUT REMPLISSAGE NOTES
	$resume = array();
	$req 	= Select('SELECT * FROM RESULT WHERE PROJECT_ID=' . $P );

	foreach ($req as $k => $val) {
			if( !isset( $resume[($val['LOGIN'])] )	){
				$resume[ ($val['LOGIN']) ] = $val['STATUS'];
			}
			else{
				$resume[ ($val['LOGIN']) ] += $val['STATUS'];
			}	
	}

	//BAREME
	$B 		= Select('SELECT SUM(MARK) FROM TEST WHERE PROJECT_ID=' . $P );
	$bareme = $B[0][0];

	$i = 3; 	//COMMENCE A LA LIGNE 3

	foreach ($resume as $k => $v) {
		$S->setCellValueByColumnAndRow( 0, $i, $k 		);
		$S->setCellValueByColumnAndRow( 1, $i, $v 		);
		$S->setCellValueByColumnAndRow( 2, $i, $bareme 	);
		$i++;
	}

	$S->setCellValueByColumnAndRow( 5, 1, '=(SUM(B3:B200))/' . count($resume) );			//MOYENNE

	print_r($resume);

	//STYLE FEUILLE

		//TAILLE COLONES
	$S->getColumnDimension('D')->setWidth(20);
	$S->getColumnDimension('E')->setWidth(10);
		//POLICE
	$S->getStyle('A1')->		 getFont()->setBold(true);
	$S->getStyle('A1')->		 getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
	$S->getStyle('C1')->		 getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
	$S->getStyle('E1')->		 getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
	$S->getStyle('A3:A200')->	 getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
		//BORDERS
	$S->getStyle('A1:C200')->	 getBorders()->applyFromArray(
		array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array(
					'rgb' => '808080'
				)
			)
		)
    );

	//RENDU DU FICHIER ET ENVOI
	$writer 	= new PHPExcel_Writer_Excel5($workbook);
	$records 	= $path . $GLOBALS['nom_xls'];
	$writer->save($records);

	$file = $path . $GLOBALS['nom_xls'];
	if (file_exists($file)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    ob_clean();
	    flush();
	    readfile($file);
	    exit;
	}
?>