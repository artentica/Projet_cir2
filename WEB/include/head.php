<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="CSS/global.css" rel="stylesheet">
<?php
	// COMPPILATION DU CSS
	include("include/lessc.inc.php");
	try {
    	lessc::ccompile('css/global.less', 'css/global.css');
	} 
	catch (exception $ex) {
    	exit('Erreur de compilation less:'.$ex->getMessage());
	}
?>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!--link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Auto test</title>