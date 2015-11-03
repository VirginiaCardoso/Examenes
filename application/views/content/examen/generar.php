<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<link type="text/css" href="<?php echo base_url('assets/css/datepicker/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
<!--	<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>	-->
		

<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> -->
<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
	 		
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.es.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>

<div id="div-form" class="form-container">

	<div class="div-titulo">
		<label>Generar Examen</label>
	</div>

	<form id="form-generar" class="form-generar" role="form" method="post" action="<?php echo site_url('examen/evaluar');?>">
	
		<div class="form-group-generar form-group-generar-fecha">
			<label for="fecha" class="control-label">Fecha</label>
			<div class="form-group fecha">
                <div id='container-fecha' class='input-group date'>
                    <input id="fecha" class="form-control fecha input-deshabilitado" type="text" name="fecha" value="<?php echo $fecha; ?>" disabled/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
			<label id="error-fecha" class="label-error errores">Fecha inválida</label>
		</div>

		<div class="form-group-generar">
			<div>
				<label for="select-carrera" class="control-label">Carrera</label>
			</div>
			<div>

		<?php

			/* SELECT DE CARRERAS */

			if(!isset($carreras)) // si no existen carreras
			{
				echo 	'<select id="select-carrera" name="carrera" class="select" disabled></select>';
			}
			else
			{ 
				echo '<select id="select-carrera" name="carrera" class="select">';

				foreach ($carreras['list'] as $indice => $carrera): 

					if($indice == $carreras['selected'])
					{
						echo '<option value="'.$carrera['cod_carr'].'" selected = "selected">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
					}
					else
					{
						echo '<option value="'.$carrera['cod_carr'].'">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
					}

				endforeach;

				echo '</select>';
			}
		?>
			</div>
			<label id="error-carrera" class="label-error errores">Carrera inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-catedra" class="control-label">Cátedra</label>
			</div>
			<div>
		<?php

			/* SELECT DE CATEDRAS */

			if(!isset($catedras)) // si no existen cátedras
			{
				echo 	'<select id="select-catedra" name="catedra" class="select" disabled></select>';
			}
			else
			{ 
				echo "<select id='select-catedra' name='catedra' class='select' data-selected='{$catedras['selected']}'>";

				foreach ($catedras['list'] as $indice => $catedra): 
					if($indice == $catedras['selected'])
					{
						echo '<option value="'.$catedra['cod_cat'].'" selected = "selected">'.$catedra['cod_cat'].' - '.$catedra['nom_cat'].'</option>';
					}
					else
					{
						echo '<option value="'.$catedra['cod_cat'].'">'.$catedra['cod_cat'].' - '.$catedra['nom_cat'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}
		?>
			</div>
			<label id="error-catedra" class="label-error errores">Cátedra inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-guia" class="control-label">Guía</label>
			</div>
			<div>
		<?php

			/* SELECT DE GUIAS */

			if(!isset($guias)) // si no existen guías
			{
				echo 	'<select id="select-guia" name="guia" data-live-search="true" class="select" disabled></select>';
			}
			else
			{ 
				echo "<select id='select-guia' name='guia' data-live-search='true' data-selected='{$guias['selected']}' class='select'>";

				foreach ($guias['list'] as $indice => $guia): 
					if($indice == $guias['selected'])
					{
						echo '<option value="'.$guia['id_guia'].'" selected = "selected">'.$guia['nro_guia'].' - '.$guia['tit_guia'].'</option>';
					}
					else
					{
						echo '<option value="'.$guia['id_guia'].'">'.$guia['nro_guia'].' - '.$guia['tit_guia'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}

		?>
			</div>
			<label id="error-guia" class="label-error errores">Guía inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-alumno" class="control-label">Estudiante</label>
			</div>
			<div>	
		<?php

			/* SELECT DE ALUMNOS */

			if(!isset($alumnos)) // si no existen alumnos
			{
				echo '<select id="select-alumno" name="alumno" data-live-search="true" class="select" disabled></select>';
			}
			else
			{ 
				echo "<select id='select-alumno' name='alumno' data-live-search='true' data-selected='{$alumnos['selected']}' class='select'>";

				foreach ($alumnos['list'] as $indice => $alumno): 
					if($indice == $alumnos['selected'])
					{
						echo '<option value="'.$alumno['lu_alu'].'" selected = "selected">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
					}
					else
					{
						echo '<option value="'.$alumno['lu_alu'].'">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}
		?>
			</div>
			<label id="error-alumno" class="label-error errores">Estudiante inválido</label>
		</div>

		<div class="form-group-buttons">
			<a id="btn-cancelar" href="<?php echo site_url('home');?>" class="btn btn-default">Cancelar</a>
			<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Continuar</button>
		</div>

	</form>

	<?php 
		if(isset($error))
			echo '<label id="error-server" class="label-error">'.$error .'</label> ';
	?>
</div>