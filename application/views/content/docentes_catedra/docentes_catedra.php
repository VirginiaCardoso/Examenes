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



<script type="text/javascript"  src="<?php echo base_url('assets/js/alumnos/alumnos.js'); ?>"></script>


<!-- <link type="text/css" href="<?php echo base_url('assets/css/administracion/lista.css'); ?>" rel="stylesheet" media="screen"/>
 -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/docentes_catedra/lista_doc_cat.js'); ?>"></script>

<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>

<link type="text/css" href="<?php echo base_url('assets/css/administracion/lista_usuarios.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-form" class="form-container">

	<div class="div-titulo">
		<label><?php echo '<a href="../lista_catedras" title="Ir la página anterior">Cátedras/</a>';?>Agregar Docentes a Cátedra: <?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?></label> 
	</div>

	<?php $cat = $catedra['cod_cat']; ?>
	<form id="form-generar" class="form-generar" role="form" method="post" action="<?php echo site_url('catedras/agregar_doc_cat/'.$cat);?>"> <!-- $catedra['cod_cat'] -->
	

		<div class="form-group-generar">

			<div>	
		<?php

			/* SELECT DE ALUMNOS */

			if(!isset($docentes)) // si no existen docentes
			{
				echo '<select id="select-docente" name="docente" data-live-search="true" class="select" disabled></select>';
			}
			else
			{ 
				echo "<select id='select-docente' name='docente' data-live-search='true' data-selected='{$docentes['selected']}' class='select'>";

				foreach ($docentes['list'] as $indice => $docente): 
					if($indice == $docentes['selected'])
					{
						echo '<option value="'.$docente['leg_doc'].'" selected = "selected">'.$docente['leg_doc'].' - '.$docente['apellido_doc'].', '.$docente['nom_doc'].'</option>';
					}
					else
					{
						echo '<option value="'.$docente['leg_doc'].'">'.$docente['leg_doc'].' - '.$docente['apellido_doc'].', '.$docente['nom_doc'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}
		?>
			</div>
			<label id="error-docente" class="label-error errores">Docente inválido</label>
		</div>

	<!-- 	<div class="form-group-buttons">
			<a id="btn-cancelar" href="<?php echo site_url('home');?>" class="btn btn-default">Cancelar</a> -->
			   <button id="btn-submit" name="boton" style="margin-left: 5px" class="btn btn-primary" type="submit">Agregar</button>
	<!-- 	</div> -->

	</form>

 <!-- TABLA DE ALUMNOS DE LA CÁTEDRA  -->
 <div id="lista-usuarios" >
    	
	<div class="row">
		<div class="lista col-xs-12">
		<?php echo $tabla; ?>
		</div>
	</div>
 </div>

	<?php 
		if(isset($error))
			echo '<label id="error-server" class="label-error">'.$error .'</label> ';
	?>
</div>