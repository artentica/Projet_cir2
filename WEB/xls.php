<?php
	require 'include/global.php';
	
	include 'include/PHPExcel.php';
	include	'include/PHPExcel/Writer/Excel2007.php';

	$workbook = new PHPExcel;

	$sheet = $workbook->getActiveSheet();
	$sheet->setCellValue('A1','MaitrePylos');

	$writer = new PHPExcel_Writer_Excel2007($workbook);

	$records = './fichier.xlsx';

	$writer->save($records);



	$file = './fichier.xlsx';

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