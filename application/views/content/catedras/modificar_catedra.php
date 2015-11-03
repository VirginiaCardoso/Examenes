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
<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/usuarios.js'); ?>"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/catedras/lista_catedras.js'); ?>"></script>

<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>



<link type="text/css" href="<?php echo base_url('assets/css/catedras/lista_catedras.css'); ?>" rel="stylesheet" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<link type="text/css" href="<?php echo base_url('assets/css/datepicker/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" media="screen"/>

	

<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> -->
<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> -->
	 		
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.es.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>

<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/usuarios.js'); ?>"></script>



 
 <div class="div-titulo">

		<label><?php echo '<a href="../lista_catedras" title="Ir la página anterior">Cátedras/</a>';?>Modificar Cátedra</label>
 </div>
  <!-- Contenido pestaña crear nueva catedra  -->
  	<div id="div-form-nuevo" class="form-container">
  				<?php $cat = $catedra['cod_cat']; ?>

				<form id="form-modificarc" class="form-evaluar" role="form" method="post" action="<?php echo site_url('catedras/actualizar/'.$cat);?>">
		
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-4">
								<label for="codigo" class="control-label">Código</label>
								<input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $catedra['cod_cat'];?>"  disabled />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-4">
									<label for="nombre" class="control-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $catedra['nom_cat'];?>"/>
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="row"> 
							<div class="col-xs-4">
                					<label for="carrera" class="control-label" id="carrera" name="carrera" value="<?php echo $catedra['cod_carr'];?>">Carrera</label>
									<?php

                            			/* SELECT DE CARRERAS */

                            			if(!isset($carreras)) // si no existen carreras
                            			{
                            				echo 	'<select id="cod_carr" name="cod_carr" class="select form-control" disabled></select>';
                            			}
                            			else
                            			{ 
                            				echo '<select id="cod_carr" name="cod_carr" class="select form-control">';

                            				foreach ($carreras as $carrera): 

                            					// if($indice == $carreras['selected'])
                            					// {
                            					// 	echo '<option value="'.$carrera['cod_carr'].'" selected = "selected">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
                            					// }
                            					// else
                            					// {
                            						echo '<option value="'.$carrera['cod_carr'].'">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
                            					// }

                            				endforeach;

                            				echo '</select>';
                            			}
                            		?>
                			</div>
		                </div>  	 	
			    	</div> -->
					
					<div class="form-group">
						<div class="row">
							<div class="col-xs-4">
								<label for="select-carrera" class="control-label">Carrera</label>
								<?php
									/* SELECT DE CARRERAS */

									if(!isset($carreras)) // si no existen carreras
									{
										echo 	'<select id="select-carrera" name="carrera" class="select form-control" disabled></select>';
									}
									else
									{  
										echo '<select id="select-carrera" name="carrera" class="select form-control">';

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
						</div>
						<label id="error-carrera" class="label-error errores">Carrera inválida</label>
					</div>

				<div class="form-group-buttons">
					<a id="btn-cancelar" href="<?php echo site_url('catedras/lista_catedras');?>" class="btn btn-default">Cancelar</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Guardar</button>
				</div>		

			</form>
		</div> <!-- cierre contenedor formulario -->
		<?php 
			if(isset($error))
				echo '<label id="error-server" class="label-error">'.$error .'</label> ';
		?>
 	


	