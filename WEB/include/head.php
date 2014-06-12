<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
<!--link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" -->

<?php
	// COMPPILATION DU CSS
	// VA CHERCHER css/global.less ET LE CONVERTIE EN global.css QUI EST ENSUITE INCLUT
	include("include/lessc.inc.php");
	try {
    	lessc::ccompile('css/global.less', 'css/global.css');
	} 
	catch (exception $ex) {
    	exit('Erreur de compilation less:'.$ex->getMessage());
	}
?>
<link href="css/global.css" rel="stylesheet">

<!--script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->
<script src="js/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<!--script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script-->

<script type="text/javascript" src="js/global.js"></script>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
 <title>Auto test</title>