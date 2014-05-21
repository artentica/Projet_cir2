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
    <?php require 'include/hello.php';?>
    <div class="row" >
     <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title text-center">CHOIX DU PROJET</h3>
    </div>
    <div class="panel-body">

        <div class="panel-group" id="accordion1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                  Collapsible Group #1
              </a></h4>
          </div>
          <div id="collapseOne" class="panel-body collapse">
              <div class="panel-inner">
                This is a simple accordion inner content...
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
            Collapsible Group #2 (With nested accordion inside)
        </a></h4>
    </div>
    <div id="collapseTwo" class="panel-body collapse">
      <div class="panel-inner">

        <!-- Here we insert another nested accordion -->

        <div class="panel-group" id="accordion2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerOne">
                Collapsible Inner Group Item #1
            </a></h4>
        </div>
        <div id="collapseInnerOne" class="panel-body collapse">
          <div class="panel-inner">
            Anim pariatur cliche...
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerTwo">
        Collapsible Inner Group Item #2
    </a></h4>
</div>
<div id="collapseInnerTwo" class="panel-body collapse">
  <div class="panel-inner">
    Anim pariatur cliche...
</div>
</div>
</div>
</div>

<!-- Inner accordion ends here -->

</div>
</div>
</div>
</div>

</div>
</div>
</div>





</div>
</body>
</html>