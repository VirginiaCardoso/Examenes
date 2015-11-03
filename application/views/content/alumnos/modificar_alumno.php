<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo, Matias
	COPYRIGHT	Septiembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->


<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	

<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/alumnos/alumnos.js'); ?>"></script>


<link type="text/css" href="<?php echo base_url('assets/css/administracion/lista_usuarios.css'); ?>" rel="stylesheet" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>





<link type="text/css" href="<?php echo base_url('assets/css/catedras/lista_catedras.css'); ?>" rel="stylesheet" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/catedras/lista_catedras.js'); ?>"></script>



 <div class="div-titulo">

		<label><?php echo '<a href="../lista_alumnos" title="Ir la página anterior">Estudiantes/</a>';?>Modificar Estudiante</label>
 </div>
  <!-- Contenido pestaña crear nueva catedra  -->
  	<div id="div-form-nuevo" class="form-container">
<?php $alu = $alumno['lu_alu']; ?>

				<form id="form-modificaru" class="form-evaluar" role="form" method="post" action="<?php echo site_url('alumnos/actualizar/'.$alu);?>">
		
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-4">
								<label for="legajo" class="control-label">Legajo</label>
								<input type="text" class="form-control " id="legajo" name="legajo" value="<?php echo $alumno['lu_alu'];?>" disabled/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
									<label for="apellido" class="control-label">Apellido</label>
									<input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $alumno['apellido_alu'];?>"/>
							</div>
							<div class="col-xs-6">
									<label for="nombre" class="control-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $alumno['nom_alu'];?>"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
									<label for="dni" class="control-label">DNI</label>
									<input type="text" class="form-control" id="dni" name="dni" value="<?php echo $alumno['dni_alu'];?>"/>
							</div>
						</div>
					</div>
			    	
				<div class="form-group-buttons">
					<a id="btn-cancelar" href="<?php echo site_url('alumnos/lista_alumnos');?>" class="btn btn-default">Cancelar</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Guardar</button>
				</div>		

			</form>
		</div> <!-- cierre contenedor formulario -->
		<?php 
			if(isset($error))
				echo '<label id="error-server" class="label-error">'.$error .'</label> ';
		?>
 	


	