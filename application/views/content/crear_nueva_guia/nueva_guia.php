
<!-- 	AUTOR		
	AUTOR		
		COPYRIGHT	Agosto, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-- -->


	<link type="text/css" href="<?php echo base_url('assets/css/examen/examen.css'); ?>" rel="stylesheet" media="screen"/> 
	<link type="text/css" href="<?php echo base_url('assets/css/crear_nueva_guia/crear_nueva_guia.css'); ?>" rel="stylesheet" media="screen"/>
	<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/examen.js'); ?>"></script>
	 
	<script type="text/javascript"  src="<?php echo base_url('assets/js/crear_nueva_guia/guia.js'); ?>"></script>




	<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

	<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
	<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
	<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>	


	<!--<script type="text/javascript"  src="<?php //echo base_url('assets/js/bootstrap-select.js'); ?>"></script> -->
	<!--<script type="text/javascript"  src="<?php // echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> -->
	<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
	<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>

	 <script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

	<script type="text/javascript"  src="<?php echo base_url('assets/js/crear_nueva_guia/agregar_items.js'); ?>"></script>
	<!-- <div id="div-form" class="form-container"> -->

		<!-- <div class="div-titulo">
			<label>Agregar items a guía </label>
		</div> -->

		<!-- obtengo los datos de la guía creada resientemente por medio de la session 	-->
		<?php
			$id = $this->session->flashdata('id');
			$tit = $this->session->flashdata('tit');
		?>
		<div class="tabla">
			<div class="fila">	
				<div class="columna field-name">
				Título guía:
				</div>
				<div class="columna">
					<?php echo $tit; ?>
				</div>
			</div>

			<div class="fila">	
				<div class="columna field-name">
					Número guía:
				</div>
				<div class="columna">
					<?php echo $id; ?>
				</div>
			</div>
			
		</div>

	<div class="barra-division"></div>

	<!-- AQUI VA LA TABLA DE ITEMS   -->
		Items agregados

	<!-- <div class="barra-division"></div> -->

	<div id="div-form" class="form-container">

				<form id="form-crear-guia" class="form" role="form" method="post" action="<?php echo site_url('crear_nueva_guia/guardar_nueva');?>">
		
			  		 <div class="form-group">
			        	<label class="control-label"> Tipo: </label>
			        		<div>
			            		<label class="radio-inline">
			                		<input type="radio" name="tipoitem" value="1" checked="checked" onclick="check(this.value)" /> Item simple
			            		</label>
			            		<label class="radio-inline">
			                		<input type="radio" name="tipoitem" value="2" onclick="check(this.value)" /> Grupo de items
			            		</label>
			            		<label class="radio-inline">
			                		<input type="radio" name="tipoitem" value="3" onclick="check(this.value)" /> Seccion de items
			           			 </label>
			        		</div>
			    	</div>
			    	
					<!-- div para agregar los nuevos campos segun lo que se selecciona -->
					<div id="div-nuevos">
						<label> Agregar item: </label> 
						 <br>
						 <div >
							<input type="radio" name="itemnuevo" value="4" checked="checked" onclick="check2(this.value)" /> Nuevo 
							<input type='text' value='' class='form-control' name='nuevoitem' id='nuevoitem' placeholder='Ingrese Item' />
			            </div>
						<br>

					</div>

				<div class="form-group-buttons">
					<a id="btn-cancelar" href="<?php echo site_url('crear_nueva_guia/crear');?>" class="btn btn-default">Cancelar</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Agregar Nuevo</button>
				</div>		

			</form>
		</div> <!-- cierre contenedor formulario -->

 <!-- Sector para agregar Items a una guía  -->


 <!-- 
 <div class="tab-content">
    <div id="crear" class="tab-pane fade in active">
  		<div id="div-form" class="form-container">

  		<div class="fila">	
				<div class="columna field-name">
					ITEM
				</div>
			</div>

				<!-- FORM para agregar un Item nuevo  -->
		<!-- 	<form id="form-evaluar" class="form-evaluar" role="form" method="post" action="<?php echo site_url('crear_nueva_guia/agregar_items_guia');?>">

				<div class="form-group">
					<div class="row"> 
						<div class="col-xs-12">
							<input type="text" class="form-control " id="item" name="item" value="" placeholder="Ingrese Item" />
						</div>
					</div>
				</div>
				<div class="form-group-buttons">
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Agregar Item</button>
				</div>		
			</form><br>
			<!-- FORM para agregar Item de la Lista de Items  -->
		<!-- 	<form id="form-evaluar" class="form-evaluar" role="form" method="post" action="<?php  // echo site_url('crear_nueva_guia/agregar_items_guia');?>">
		 		<div class="form-group">
		 		 		<?php
					/* SELECT DE ITEM */
						// echo '<select class="form-control" id="select-item" name="values[] ">
						// 	          <option value="" disabled selected>Seleccione Item</option>';

						// 	foreach ($items['list'] as $indice => $item): 

						// 		echo '<option value="'.$item['id_item'].'" >'.$item['id_item']." - ".$item['nom_item'].'</option>';

						// 	endforeach;

						// echo '</select>';
				?>
				</div>	
				<div class="form-group-buttons">
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Agregar Item</button>
				</div>		

			</form><br>


			<div class="fila">	
				<div class="columna field-name">
					GRUPO ITEM
				</div>
			</div>

			<form id="form-evaluar" class="form-evaluar" role="form" method="post" action="<?php //echo site_url('crear_nueva_guia/agregar_items_guia');?>">
				
				<div class="form-group">
					<div class="row"> 
						<div class="col-xs-12">
							<input type="text" class="form-control " id="item" name="item" value="" placeholder="Ingrese Nombre de Gurpo Item" />
						</div>
					</div>
				</div>

				<div class="form-group">
				<?php
					/* SELECT DE GRUPOSITEMS */
						// echo '<select class="form-control" id="select-catedra" name="values[] ">
						// 	          <option value="" disabled selected>Seleccione Grupo de Item</option>';

						// 	foreach ($grupositems['list'] as $indice => $grupositems): 

						// 		echo '<option value="'.$grupositems['nom_grupoitem'].'" >'.$grupositems['nom_grupoitem'].'</option>';

						// 	endforeach;

						// echo '</select>';
				?>
				</div>	


				<div class="form-group-buttons">

					<div class="container">
						<div class="columna field-name">Seleccione Items</div>
						<div class="row">
							<div class="form-group form-group-multiple-selects col-xs-11 col-sm-8 col-md-6">
								<div class="input-group input-group-multiple-select col-xs-12">
									<select class="form-control" name="values[]">
										<option value"">Seleccionar Item</option>

										<?php /* foreach ($items['list'] as $indice => $item): 

										echo '<option value="'.$item['id_item'].'" >'.$item['id_item']." - ".$item['nom_item'].'</option>';
										
										endforeach;*/
										?>
									</select>
									<span class="input-group-addon input-group-addon-remove">
										<span class="glyphicon glyphicon-remove"></span>
									</span>
								</div>
							</div>
						</div>
					</div>


				
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Agregar Grupo de Items</button>
				</div>		

			</form>
		</div> 
	</div>
  </div>


<?php
/*
if (isset($_POST['insert'])) {
	$name = $_POST['p_item'];
}

?> -->
		<table id="data" class="display">
			<thead>
				<tr>
					<th>Item</th>
					<th></th>
					<th>Eliminar</th>
				</tr>

			</thead>
			<tbody>
				<?php
					if (isset($_POST['delete'])) {
						
						// ELIMINA DE LA BD EL ITEM
					}*/
				?>

				<tr>
					<form action="" method="POST">
						<td><center><?php //echo $row['p_item'] ?></center></td>
						<td><center><input type="submit" name="Eliminar" value="delete"></center></td>
					</form>	
				</tr>

			</tbody>
		</table>
			<form action="" method="POST">
							<input type="text" name='p_item'>
	                        <input type="submit" value="Agregar Item" name="insert">
			</form>	

 
 -->

		




			

<!-- 
				<form id="form-generar" class="form-generar" role="form" method="post" action="<?php // echo site_url('crear_nueva_guia/nueva_guia');?>">

			<div class="container">
				<table class="table table-bordered table-hover table-sortable" id="tab_logic">
					<tbody>
						<tr id='addr0' data-id="0" class="hidden">

                  
                       		 <td data-name="desc">
	                        	<select class="form-control" name="values[]">
						<option value"">Seleccionar Item</option>

						<?php // foreach ($items['list'] as $indice => $item): 

					//		echo '<option value="'.$item['id_item'].'" >'.$item['id_item']." - ".$item['nom_item'].'</option>';
						
				//	endforeach;
					?>
					</select>
							</td>
							<td data-name="del">
								
									<button nam"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
							</td>
						</tr>
					</tbody>
				</table>
		</div>




   		<a id="add_row" class="btn btn-primary pull-left">Agregar Item</a>

   		<div class="form-group-buttons">
				<a id="btn-cancelar" href="<?php //echo site_url('crear_nueva_guia/crear');?>" class="btn btn-default">Cancelar</a>
				<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Finalizar</button>
					

		</form>
 -->
 


	<!-- <div class="container">
		<div class="columna field-name">Seleccione Items</div>
		<div class="row">
			<div class="form-group form-group-multiple-selects col-xs-11 col-sm-8 col-md-6">
				<div class="input-group input-group-multiple-select col-xs-12">
					<select class="form-control" name="values[]">
						<option value"">Seleccionar Item</option>

						<?php// foreach ($items['list'] as $indice => $item): 

					//		echo '<option value="'.$item['id_item'].'" >'.$item['id_item']." - ".$item['nom_item'].'</option>';
						
					//endforeach;
					?>
					</select>
					<span class="input-group-addon input-group-addon-remove">
						<span class="glyphicon glyphicon-remove"></span>
					</span>
				</div>
			</div>
		</div>
	</div> -->

<!-- <div class="container">
	<div class="columna field-name">Ingrese Items</div>
	<div class="row">
		<div class="form-group form-group-options col-xs-11 col-sm-8 col-md-6">
			<div class="input-group input-group-option col-xs-12">
				<input type="text" name="option[]" class="form-control" placeholder="Ingrese Item">
				<span class="input-group-addon input-group-addon-remove">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</div>
		</div>
	</div>
</div> -->
<!-- <div class="form-group form-group-multiple-selects col-xs-11 col-sm-8 col-md-6">
							<div class="input-group input-group-multiple-select col-xs-11 col-sm-8 col-md-6"> 
								<select class="form-control" name="values[]" id="select_item">
									<option value"">Seleccionar Item</option>

									 <?php //foreach ($items['list'] as $indice => $item):  

									// echo '<option value="'.$item['id_item'].'" >'.$item['id_item']." - ".$item['nom_item'].'</option>';

									// endforeach;
									// ?>
								</select>
								<span class="input-group-addon input-group-addon-remove">
									<span class="glyphicon glyphicon-remove"></span>
								</span>
							</div>
						</div>  -->