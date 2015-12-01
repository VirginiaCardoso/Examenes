<!-- 	AUTOR		
	AUTOR		
		COPYRIGHT	Septiembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-- -->


	<link type="text/css" href="<?php echo base_url('assets/css/examen/examen.css'); ?>" rel="stylesheet" media="screen"/> 
	<link type="text/css" href="<?php echo base_url('assets/css/crear_nueva_guia/crear_nueva_guia.css'); ?>" rel="stylesheet" media="screen"/>
	<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/examen.js'); ?>"></script>
	
	<script type="text/javascript"  src="<?php echo base_url('assets/js/crear_nueva_guia/guia.js'); ?>"></script>



<!-- 

	<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>
 -->
	<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
	<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
	<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>	


	<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> 
	<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> 
	<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>

	 <script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

	<link type="text/css" href="<?php echo base_url('assets/css/crear_nueva_guia/crear_nueva_guia.css'); ?>" rel="stylesheet" media="screen"/>


	<div id="div-guardada" class="div-container">

		<!-- <div class="div-titulo"> -->
		<center>
			<label><?php echo $mensaje; ?> </label>
		</center>
			<br>
		<!--<?php
				// print_r ($arreglo_items);
			?>-->
		<!-- </div> -->

		<div class="form-group-buttons">
			<!-- <div class="row row-botonera row-botonera-fila1">
				<div class="col-xs-12 col-boton"> -->
					<a id="btn-inicio" href="<?php echo site_url('home'); ?>" class="btn btn-default">Inicio</a>
				<!-- </div>
				<div class="col-xs-12 col-boton">	 -->
					<a href="<?php echo site_url('guias/lista_guias');?>" class="btn btn-primary  " >Lista de Guias </a>
				<!-- </div>	
			</div> -->
		</div>	

		<?php 
		if(isset($error))
			echo '<label id="error-server" class="label-error">'.$error .'</label> ';
	?>

	</div>