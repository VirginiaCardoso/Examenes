<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Julio, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 


<link type="text/css" href="<?php echo base_url('assets/css/datepicker/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
<!--	<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>	-->
		

<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> -->
<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> -->
<!-- <script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
	 		
<!--<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.es.js'); ?>"></script>-->
<!--
<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>

<div id="div-form" class="form-container">

	<div class="div-titulo">
		<label>Admin</label>
	</div>

</div>-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/admin.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/>


<div id="div-botonera" class="div-container">
	<div class="div-titulo">
		<label><!-- Administrar --><!--  (<?php echo $privilegio_user;?>) --> </label>
	</div>
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('administracion/usuarios');?>" class="btn btn-primary btn-lg btn-block" <?php if ($privilegio_user==0) {echo "disabled";}?> >Usuarios</a>
		</div>
	</div>	
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('catedras/lista_catedras');?>" class="btn btn-primary btn-lg btn-block"  <?php if ($privilegio_user!=2) {echo "disabled";}?>>Cátedras</a>
		</div>
	</div>
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('guias/lista_guias');?>" class="btn btn-primary btn-lg btn-block" <?php if ($privilegio_user==0) {echo "disabled";} ?> >Guías</a>
		</div>
	</div>
	<div class="row row-botonera row-botonera-fila1">
		<div class="col-xs-12 col-boton">
			<a href="<?php echo site_url('alumnos/lista_alumnos');?>" class="btn btn-primary btn-lg btn-block" <?php if ($privilegio_user!=2) {echo "disabled";} ?> >Estudiantes</a>
		</div>
	</div>
	
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>
