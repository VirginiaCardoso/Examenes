

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


<div class="div-titulo">
	<?php 
		if($mostrar==1){
			echo '<label>Estadísticas estudiantes</label>';
			
		}
		elseif ($mostrar==2) {
			echo '<label>Estadísticas guías</label>';
		}
	?>
</div>

<div id="div-principal">
	<div class="form-group-generar">	
		<?php
			if($mostrar==1){
				/* SELECT DE ALUMNOS */

				if(!isset($alumnos)) // si no existen alumnos
				{
					echo '<select id="select-alumno" name="alumno" data-live-search="true" class="select" disabled onchange="mostrar_alumno(this.value);"></select>';
				}
				else
				{ 
					echo "<select id='select-alumno' name='alumno' data-live-search='true'  class='select' onchange='mostrar_alumno(this.value);'>";

					foreach ($alumnos['list'] as $indice => $alumno): 
						// if($indice == $alumnos['selected'])
						// {
						// 	echo '<option value="'.$alumno['lu_alu'].'" selected = "selected">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
						// }
						// else
						// {
							echo '<option value="'.$alumno['lu_alu'].'">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
						// }

					endforeach; 
					echo '</select>';
				}
			}
			elseif ($mostrar==2) {
				if(!isset($guias)) // si no existen alumnos
				{
					echo '<select id="select-guia" name="guia" data-live-search="true" class="select" disabled onchange="mostrar_guia(this.value);"></select>';
				}
				else
				{ 
					echo "<select id='select-guia' name='guia' data-live-search='true'  class='select' onchange='mostrar_guia(this.value);'>";

					foreach ($guias['list'] as $indice => $guia): 
						// if($indice == $guia['selected'])
						// {
						// 	echo '<option value="'.$catedra['cod_cat'].'" selected = "selected">'.$catedra['cod_cat'].' - '.$catedra['nom_cat'].' ('.$catedra['nom_carr'].')</option>';
						// }
						// else
						// {
							echo '<option value="'.$guia['id_guia'].'">'.$guia['nro_guia'].' - '.$guia['tit_guia'].' ('.$guia['nom_cat'].')</option>';
						// }

					endforeach; 
					echo '</select>';
				}
			}

		?>
		<div id="div-mostrar" >

		</div>
	</div>
	
	
	
	
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>