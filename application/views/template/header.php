<!DOCTYPE html>
<html lang="es" >
<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	AUTOR		Virginia Cardoso
	AUTOR		Matias Marzullo
	COPYRIGHT	Octubre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->
	<head>
		   	<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" href="<?php echo base_url('assets/images/favicon.ico');?>" type="image/gif">

		    <title><?php echo $title; ?></title>	   	
		

		    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
			<link type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet" media="screen"/>		

	 
		    <script type="text/javascript"src="<?php echo base_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>
			
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		      <script type="text/javascript"  src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
		      <script type="text/javascript"  src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
		    <![endif]-->
			
	 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>	
	 		<script type="text/javascript"  src="<?php echo base_url('assets/js/script.js'); ?>"></script>
	 			
	</head>
	<body data-site-url="<?php echo site_url(); ?>">
		<div class="wrapper">	

			<header id="header-principal" class="container-fluid">
				<a href="<?php echo site_url('home'); ?>">
				<div class="row header-footer-color">
					<div id="header-image" class="col-xs-12 col-sm-10 col-sm-offset-1 header header-image">					
						<div class="header-logo logo-uns"></div>
						<div class="header-logo logo-dcs"></div>
						
						<div id="header-texto" class="header-texto">
							<div id="header-texto-linea1" class="header-texto-linea1">
								<span id="header-texto-linea1-uns" class="header-texto-linea1-uns">UNIVERSIDAD NACIONAL DEL SUR -</span>
								<span class="header-texto-linea1-dpto">DEPARTAMENTO DE CIENCIAS DE LA SALUD</span>
							</div>
							<div id="header-texto-linea2" class="header-texto-linea2">
								<span>LABORATORIO DE COMPETENCIAS PROFESIONALES</span>
							</div>
						</div>
						
					</div>
					<?php
						if(! isset($navbar))							
						{
							echo '<div id="header-sombra" class="header-sombra"></div>';
						}
					?>				
				</div>	
				</a>	
			</header>			
			
			<?php 
				if(isset($navbar)) 
				{
					$this->view('template/navbar', $navbar);
				} 
			?>
			
			<div class="container-fluid">
				<div class="row outer-content"><!-- col content-->
					<div id="div-main-content" class="col-xs-12 col-sm-10 col-sm-offset-1 inner-content">				
				