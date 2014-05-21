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
     

        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Collapsible Group Item #1
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    Anim pariatur cliche...
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    Collapsible Group Item #2
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                    Anim pariatur cliche...
                </div>
            </div>
        </div>
    </div>

    
</div>
</div>
</div>

<div class="accordion" id="accordion2">


</div>
</body>
</html>