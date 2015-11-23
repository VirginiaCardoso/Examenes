

<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Noviembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 


-->

<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>			

<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> 
<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> 
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/estadisticas/estadisticas.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/>


<div id="div-botonera" class="div-container">
	<div class="div-titulo">
				<label>Estadísticas</label>
	
	</div>
	
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('estadisticas/estadisticas_view/1');?>" class="btn btn-primary btn-lg btn-block" >Estudiantes</a>
		</div>
	</div>	
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('estadisticas/estadisticas_view/2');?>" class="btn btn-primary btn-lg btn-block"  >Guías</a>
		</div>
	</div>
	
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>
