<?php
	if( isset( $_GET['P']))
	{
		require 'include/global.php';
		require 'include/bdd.php';

		$P 		= $_GET['P'];

		$sql 	= "DELETE FROM RESULT WHERE PROJECT_ID=$P";
		if( D_sql ) echo '<code>$sql</code>'; 
		$n  	= Ins( $sql );

		$sql 	= "DELETE FROM SUBTEST WHERE PROJECT_ID=$P";
		if( D_sql ) echo '<code>$sql</code>'; 
		$n  	= Ins( $sql );

		$sql 	= "DELETE FROM TEST WHERE PROJECT_ID=$P";
		if( D_sql ) echo '<code>$sql</code>'; 
		$n  	= Ins( $sql );
	}
	else
		echo('Probleme sur le numero du projet.')
?>