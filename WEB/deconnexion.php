<?php require 'include/global.php'; ?>
<!DOCTYPE html>
<html>
	<head>
	<?php require 'include/head.php'; 
		  session_destroy(); 
	?>
	</head>

<body>
	<div class="container">
		<article class="row" style="margin-top: 20%;" >
			<div class="panel panel-primary col-sm-offset-2 col-sm-8" style=" padding-left:0; padding-right:0;">
				<div class="panel-heading">
			    	<h3 class="panel-title">Service Central de Gestion des Utilisateurs</h3>
			  	</div>
			  	<div class="panel-body">
			    	Vous venez d'être déconnécter...
			    	Vous allez être rediriger...
			    		<script type="text/javascript">
							var obj = 'window.location.replace("<?= $GLOBALS['page_connexion'] ?>");';
							setTimeout(obj,5000); 
						</script>
			  	</div>
			</div>
		</article>
	</div>
</body>