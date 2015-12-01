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
<!-- <link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/> -->
<link type="text/css" href="<?php echo base_url('assets/css/administracion/ponderacion.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-ppal" class="div-container"> 
	<div class="div-titulo">
		<label> Rango ponderación </label>
	</div>
	<div id="div-form-rango" class="form-container">

				<form id="form-rango" class="form-evaluar" role="form" method="post" action="<?php echo site_url('ponderacion/actualizar');?>">
		
					<div class="form-group">
						<div class="row"> 
							<!-- <div class="col-xs-12"> -->
								<label for="min_adq" class="control-label" id="label_rango">"Competencia adquirida" de  </label>
								<input type="text" class="form-control min_adq " id="min_adq" name="min_adq" value=""/>
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_adq" name="max_adq" value=" 100 %" disabled="disabled" />
							<!-- </div> -->
						</div>
						<div class="row"> 
							<!-- <div class="col-xs-12"> -->
								<label for="min_med_adq" class="control-label" id="label_rango">"Competencia medianamente adquirida" de  </label>
								<input type="text" class="form-control min_adq " id="min_med_adq" name="min_med_adq" value=""/>
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_med_adq" name="max_med_adq" value=" "  />
							<!-- </div> -->
						</div>
						<div class="row"> 
							<!-- <div class="col-xs-12"> -->
								<label for="min_no_adq" class="control-label" id="label_rango">"Competencia no adquirida" de  </label>
								<input type="text" class="form-control min_adq " id="min_no_adq" name="min_no_adq" value=" 0 %" disabled="disabled " />
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_no_adq" name="max_no_ adq" value="" />
							<!-- </div> -->
						</div>
					</div>
					<div class="form-group-buttons">
					<a id="btn-cancelar" href="<?php echo site_url('administracion/admin');?>" class="btn btn-default">Cancelar</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Guardar</button>
				</div>	
				</form>
	</div>
	
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>