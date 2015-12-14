<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo, Matias
	COPYRIGHT	Agosto, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->


<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	

<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/usuarios.js'); ?>"></script>


<link type="text/css" href="<?php echo base_url('assets/css/administracion/lista_usuarios.css'); ?>" rel="stylesheet" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/lista_usuarios.js'); ?>"></script>
<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>



 
 <div class="div-titulo">

		<label><?php echo '<a href="usuarios" title="Ir la página anterior">Usuarios/</a>';?>Nuevo usuario </label>
 </div>
  <!-- Contenio pestaña crear nuevos usuarios  -->
  	<div id="div-form-nuevo" class="form-container">

				<form id="form-nuevou" class="form-evaluar" role="form" method="post" action="<?php echo site_url('administracion/nuevo');?>">
		
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-4">
								<label for="legajo" class="control-label">Legajo</label>
								<input type="text" class="form-control " id="legajo" name="legajo" value="" placeholder="Ingrese legajo" required title="Ingrese un Legajo"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
									<label for="pass" class="control-label">Contraseña</label>
									<input type="password" class="form-control" id="pass" name="pass" value="" placeholder="Ingrese contraseña" required title="Ingrese la contraseña"/>
							</div>
							<div class="col-xs-6">
									<label for="passconf" class="control-label">Confirmar Contraseña</label>
									<input type="password" class="form-control" id="passconf" name="passconf" value=""  placeholder="Ingrese nuevamente la contraseña" required title="Vuelva a escribir la contraseña"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
									<label for="apellido" class="control-label">Apellido</label>
									<input type="text" class="form-control" id="apellido" name="apellido" value=""  placeholder="Ingrese apellido" required title="Ingrese Apellido"/>
							</div>
							<div class="col-xs-6">
									<label for="nombre" class="control-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" value=""  placeholder="Ingrese nombre" required title="Ingrese Nombre"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
									<label for="dni" class="control-label">DNI</label>
									<input type="text" class="form-control" id="dni" name="dni" value=""  placeholder="Ingrese número de documento" title="Ingrese DNI"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row"> 
							<div class="col-xs-6">
			    				<label for="email">Email</label>
			    				<input type="text" class="form-control" id="email" name="email" placeholder="Ingrese email" title="Ingrese Email">
			    			</div>
			   
			    			<div class="col-xs-6">
									<label for="tel" class="control-label">Telefono</label>
									<input type="text" class="form-control" id="tel" name="tel" value=""  placeholder="Ingrese número de telefono" title="Ingrese Número de Teléfono"/>
							</div>
			    		</div>
			  		</div>

			  		 <div class="form-group">
			        	<label class="control-label">Privilegio</label>
			        		<div>
			            		<label class="radio-inline">
			                		<input type="radio" name="privilegio" value="superadmin" <?php if ($privilegio_user!=3) {echo "disabled";} else {echo "checked";} ?> /> Super Administrador
			            		</label>
			            		<label class="radio-inline">
			                		<input type="radio" name="privilegio" value="admin" <?php if ($privilegio_user!=3) {echo "disabled";} ?> /> Administrador
			            		</label>
			            		<label class="radio-inline">
			                		<input type="radio" name="privilegio" value="docente" <?php if ($privilegio_user!=2) {echo "disabled";} else {echo "checked";} ?> /> Docente
			           			 </label>
			        		</div>
			    	</div>
			    	
				<div class="form-group-buttons">

					<!-- <a id="btn-cancelar" href="<?php echo site_url('administracion/usuarios');?>" class="btn btn-default">Cancelar</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Guardar</button>
					 -->

					 <button id="btn-cancelar" name="boton" class="btn btn-default btn-lg" type="button" data-toggle="modal" data-target="#cGuardarUsuario">Cancelar</button>
							<!-- <button id="btn-guardar" name="boton" class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#guardarUsuario">Guardar</button> -->
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Guardar</button>
				</div>		

<!-- Modal -->
									<!-- <div class="modal fade" id="guardarUsuario" tabindex="-1" role="dialog" aria-labelledby="gGuiaLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="gGuiaLabel">Agregar Usuario</h4>
									      </div>
									      <div class="modal-body">
									        <div id="alert-warning-save" class="alert alert-warning modal-body-content">
												Usuario agregado correctamente.
											</div>
									      </div>
									      <div class="modal-footer">
									        <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        <button  type="submit" id="btn-modal-save" class="btn btn-primary success">Continuar</button>
									      </div>
									    </div>
									  </div>
									</div> -->

									<div class="modal fade" id="cGuardarUsuario" tabindex="-1" role="dialog" aria-labelledby="cGuiaLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="cGuiaLabel">Cancelar Agregar Usuario</h4>
									      </div>
									      <div class="modal-body">
									        <div id="alert-warning-save" class="alert alert-warning modal-body-content">
												<strong>ATENCIÓN!</strong> Usted está por abandonar la creación del usuario. Si continúa los datos no seran guardados.
											</div>
									      </div>
									      <div class="modal-footer">
									        <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        <a  id="btn-modal-save" href="<?php echo site_url('administracion/usuarios');?>" type="button" class="btn btn-primary success">Salir</a>
									      </div>
									    </div>
									  </div>
									</div>		 
									<!-- Fin Modal -->


			</form>
		</div> <!-- cierre contenedor formulario -->
		<?php 
			if(isset($error))
				echo '<label id="error-server" class="label-error">'.$error .'</label> ';
		?>
 	


	