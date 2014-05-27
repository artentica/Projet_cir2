<?php require 'include/bdd.php';
		require 'include/global.php';
		forprof();

		$projets = Select("SELECT * FROM PROJECT");
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
					<?php acc(); 
						  cre();
					?>
					<form class="navbar-form pull-right">  
						<li class="">	<?php deco(); ?>	</li>
					</form>
				</ul>
			</nav>

			<?php hello(); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title text-center">CHOIX DU PROJET</h3>
				</div>
				<div class="panel-body">

					<div class="panel-group" id="accordion1">
						<?php
							foreach ($projets as $key => $val) {
								echo('
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse'. $val[0] .'">' . $val[2] . '</a>
											</h4>
										</div>
										<div id="collapse'. $val[0] .'" class="panel-body collapse">
											<div class="panel-inner">
												Projet N°'. $val[0] . ":
												<ul>
													<li> Nom: <b>" . $val[2] . "</b></li>
													<li> date de création: <b>". $val[3] . "</b></li>
													<li> date butoire: <b>". $val[4] .'</b></li>
												</ul>
												<a href="gestion-p.php?P=' . $val[0] . '" class="col-md-2 col-md-offset-10 btn btn-primary btn-warning">
													<span class="glyphicon glyphicon-briefcase"></span>
													Voir le Projet
												</a>
											</div>
										</div>
									</div>
									');
							}
						?>
				          <!--div class="panel panel-default">
				            <div class="panel-heading">
				              <h4 class="panel-title">
				                <a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">Collapsible Group #1</a>
				              </h4>
				            </div>
				            <div id="collapseOne" class="panel-body collapse">
				              <div class="panel-inner">
				                This is a simple accordion inner content...
				              </div>
				            </div>
				          </div>
				          <div class="panel panel-default">
				            <div class="panel-heading">
				              <h4 class="panel-title">
				                <a class="panel-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">Collapsible Group #2 (With nested accordion inside)</a>
				              </h4>
				            </div>
				            <div id="collapseTwo" class="panel-body collapse">
				              <div class="panel-inner">

				              	<!-- Here we insert another nested accordion -->

				                <!--div class="panel-group" id="accordion2">
				                  <div class="panel panel-default">
				                    <div class="panel-heading">
				                      <h4 class="panel-title"><a class="panel-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerOne">
				                        Collapsible Inner Group Item #1</a>
				                      </h4>
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
				                        </a>
				                      </h4>
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
	</body>
</html>