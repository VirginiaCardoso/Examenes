<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Julio, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 


-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/admin.js'); ?>"></script>
<!-- <link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/> -->
<link type="text/css" href="<?php echo base_url('assets/css/administracion/ponderacion.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-ppal" ><!-- class="div-container">  -->
	<div class="div-titulo">
		<label> Rango ponderación </label>
	</div>
	<div id="div-form-rango" class="form-container">

				<form id="form-rango" class="form-generar" role="form" method="post" action="<?php echo site_url('ponderacion/actualizar');?>">
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-12">
								<label for="min_adq" class="control-label" id="label_rango">"Competencia adquirida": </label> 
								<input type="text" class="form-control min_adq " id="min_adq" name="min_adq" value=<?php echo '"'.$adq['min_valor'].'"';?>/>
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_adq" name="max_adq" value=" 100" disabled="disabled" />
							</div>
						</div>
						<div class="row"> 
							<div class="col-xs-12">
								<label for="min_med_adq" class="control-label" id="label_rango">"Competencia medianamente adquirida"  </label>
								<input type="text" class="form-control min_adq " id="min_med_adq" name="min_med_adq" value=<?php echo '"'.$med_adq['min_valor'].'"';?>/>
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_med_adq" name="max_med_adq" value=<?php echo '"'.$med_adq['max_valor'].'"';?>  />
							</div>
						</div>
						<div class="row"> 
							<div class="col-xs-12">
								<label for="min_no_adq" class="control-label" id="label_rango">"Competencia no adquirida" </label>
								<input type="text" class="form-control min_adq " id="min_no_adq" name="min_no_adq" value=" 0" disabled="disabled " />
								<label for="min_adq" class="control-label" id="label_rango">  a  </label>
								<input type="text" class="form-control min_adq" id="max_no_adq" name="max_no_ adq" value=<?php echo '"'.$no_adq['max_valor'].'"';?> />
							</div>
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