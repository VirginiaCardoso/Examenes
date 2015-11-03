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


	<div id="div" class="container">

		<div class="div-titulo">
			<label><?php echo $mensaje; ?> </label>
			<br>
			<?php
				print_r ($arreglo_items);
			?>
		</div>

	</div>