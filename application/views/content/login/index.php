<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/login/index.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/login/index.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-form" class="form-container">

	<div class="div-titulo">
		<label>Iniciar Sesión</label>
	</div>

	<form id="form" class="form-login" role="form" method="post" action="<?php echo site_url('login/loguear_usuario');?>">

		<input id="input-legajo" name="legajo" class="form-control" type="text"  placeholder="Legajo"/>
		<input id="input-password" name="password" class="form-control" type="password"  placeholder="Contraseña"/>
		
		<?php 
			if (isset($error_login))
			{
				echo '<label id="error-login" class="label-error errores">'.$error_login.'</label>';
			}

			if (function_exists('validation_errors')) 
			{
				echo '<label class="label-error errores">'.validation_errors().'</label>'; 
			}
		?>

		<label id="error" class="label-error errores"></label>

		<button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">Ingresar</button>
	</form>
</div>