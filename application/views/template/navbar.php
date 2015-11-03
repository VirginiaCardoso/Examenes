<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<nav id="navbar" class="navbar navbar-default navbar-static-top header-navbar-sombra" role="navigation">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a id="navbar-brand" class="navbar-brand" ><?php echo $nombre." ".$apellido ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div id="navbar-collapse-1" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a id="navbar-home" href="<?php echo site_url('home'); ?>"><span class="glyphicon glyphicon-home"></span> Inicio</a>
						</li>
					<?php if($activo): ?>
					
						<li>
							<a id="navbar-administracion" href="<?php echo site_url('administracion/admin'); ?>"><span class="glyphicon glyphicon-folder-open"></span>  Administración</a>
						</li>
					
						<li>
							<a id="navbar-mis-examenes" href="<?php echo site_url('examenes/lista_docente'); ?>"><span class="glyphicon glyphicon-file"></span> Mis exámenes evaluados</a>
						</li>
						<li>
							<a id="navbar-mis-datos" href="#" style="display:none;"><span class="glyphicon glyphicon-edit"></span> Mis Datos</a>
						</li>
					<?php endif; ?>
						<li>
							<a id="navbar-cerrar-sesion" href="<?php echo site_url('login/desloguear_usuario'); ?>"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a>
						</li>						
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.col -->
		</div><!-- /.row --> 
	</div><!-- /.container-fluid -->
</nav>