<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/home/index.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/>


<div id="div-botonera" class="div-container">
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('crear_nueva_guia/crear');?>" class="btn btn-primary btn-lg btn-block">Crear nueva guía</a>
		</div>
	</div>	
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('examen/generar');?>" class="btn btn-primary btn-lg btn-block">Tomar nuevo examen</a>
		</div>
	</div>
	<div class="row row-botonera">
		<div class="col-xs-12 col-sm-5 col-boton col-primer-boton" style="display:none;">
			<a href="#" class="btn btn-default btn-lg btn-block">Cátedras</a>
		</div>
		<div class="col-xs-12 col-sm-6 col-sm-offset-1 col-boton" style="display:none;">
			<a href="#" class="btn btn-default btn-lg btn-block">Vincular Estudiantes</a>	
		</div>
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-boton">
			<a href="<?php echo site_url('examenes/lista_docente'); ?>" class="btn btn-default btn-lg btn-block">Ver exámenes evaluados</a>	
		</div>
	</div>
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>


