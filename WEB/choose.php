<?php require 'include/bdd.php';
	  require 'include/global.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'include/head.php'; ?>
    </head>
    <body>
    	<div class="container">
    		<nav class="navbar navbar-inverse">
    			<ul class="nav navbar-nav">
    				<li>	<a href="#" >Créer un projet</a>	</li>
    				<li class="pull-right">	<?php deco(); ?>	</li>
    			</ul>
    		</nav>
    		<div class="row" >
    			<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title text-center">CHOIX DU PROJET</h3>
				  </div>
				  <div class="panel-body">
				    Panel content
				  </div>
				</div>
    		</div>
    	</div>
    </body>
</html>