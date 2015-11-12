
<!-- 	AUTOR		
	AUTOR		
		COPYRIGHT	Septiembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-- -->

<link type="text/css" href="<?php echo base_url('assets/css/datepicker/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
<link type="text/css" href="<?php echo base_url('assets/css/examen/examen.css'); ?>" rel="stylesheet" media="screen"/> 
<link type="text/css" href="<?php echo base_url('assets/css/crear_nueva_guia/crear_nueva_guia.css'); ?>" rel="stylesheet" media="screen"/>
<!--	<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>	-->
		

<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> -->
<!--<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
	 		
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/css/datepicker/js/bootstrap-datetimepicker.es.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/examen.js'); ?>"></script>
	
<script type="text/javascript"  src="<?php echo base_url('assets/js/crear_nueva_guia/guia.js'); ?>"></script>
	
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>



	<div id="div" class="container">

		<div class="div-titulo">
			<label>Agregar items a Guía </label>
		</div>
		<!-- obtengo los datos de la guía creada resientemente por medio de la session 	
		<?php
			$id = $this->session->flashdata('id');
			$tit = $this->session->flashdata('tit');
		?>-->
		<div class="tabla">
			<div class="fila">	
				<div class="columna field-name">
				Guía:
				</div>
				<div class="columna">
					<?php echo $nro_guia.' - '.$tit_guia; ?> 					
				</div>
			</div>
					 		
		</div>


	<div class="contenedor_guia container">
		
			<!-- AQUI VA LA TABLA DE ITEMS   -->
				<div class="items_guia row">
					<div class="lista col-xs-12 table-responsive">
						<?php echo $tabla; ?>
					</div>   <!--  -->
					 <form id="form-crear-guia" class="form-crear-guia" role="form" method="post" action="<?php echo site_url('crear_nueva_guia/guardar_guia');?>" >

						<!-- <input type="hidden" name="input-cod-carr" id="input-cod-carr" value="<?php echo $cod_carr; ?>"/> -->
						<input type="hidden" name="input-cod-cat" id="input-cod-cat" value="<?php echo $cod_cat; ?>"/>
						<input type="hidden" name="input-nro-guia" id="input-nro-guia" value="<?php echo $nro_guia; ?>"/>
						<input type="hidden" name="input-tit-guia" id="input-tit-guia" value="<?php echo $tit_guia; ?>"/>
					 	<div class="guardar-guia form-group-buttons botonera">

							<!-- <a id="btn-cancelar" href="<?php echo site_url('crear_nueva_guia/crear');?>" class="btn btn-default ">Cancelar</a> -->
						<!-- 	<a id="btn-guardar" data-target="#" class="btn btn-primary btn-lg">Guardar</a> -->
							<button id="btn-cancelar" name="boton" class="btn btn-default btn-lg" type="button" data-toggle="modal" data-target="#cGuia">Cancelar</button>
							<button id="btn-guardar" name="boton" class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#gGuia">Guardar</button>
						</div>
					<!-- Modal -->
									<div class="modal fade" id="gGuia" tabindex="-1" role="dialog" aria-labelledby="gGuiaLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="gGuiaLabel">Guardar Guía</h4>
									      </div>
									      <div class="modal-body">
									        <div id="alert-warning-save" class="alert alert-warning modal-body-content">
												<strong>ATENCIÓN!</strong> ¿Está realmente seguro de que desea guardar esta Guía? <br/> La misma, una vez creada, no podrá ser modificada.
											</div>
									      </div>
									      <div class="modal-footer">
									        <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        <button  type="submit" id="btn-modal-save" class="btn btn-primary success">Si, Guardar</button>
									      </div>
									    </div>
									  </div>
									</div>

									<div class="modal fade" id="cGuia" tabindex="-1" role="dialog" aria-labelledby="cGuiaLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="cGuiaLabel">Cancelar Guía</h4>
									      </div>
									      <div class="modal-body">
									        <div id="alert-warning-save" class="alert alert-warning modal-body-content">
												<strong>ATENCIÓN!</strong> Usted está por abandonar la creación de una Guía. Si continúa perderá los datos y deberá generar la guía nuevamente.
											</div>
									      </div>
									      <div class="modal-footer">
									        <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									        <a  id="btn-modal-save" href="<?php echo site_url('home');?>" type="button" class="btn btn-primary success">Salir</a>
									      </div>
									    </div>
									  </div>
									</div>		 
									<!-- Fin Modal -->
					 </form> 
				</div>
				
		<div class="forms_items " >

			<div class="form-group form-radio">
		    	<div>
				    <label class="radio-inline">
				        <input type="radio" name="tipoitem" value="itemsimple"  checked="checked" onclick="clicItem();"/> Item simple
				    </label>
				    <label class="radio-inline">
				        <input type="radio" name="tipoitem" value="grupoitems" onclick="clicGrupo();" /> Grupo items
				    </label>
				</div>
			</div>
			<div id="div_grupo" style="visibility: hidden;">
				<div class="row row_items" > 
								
					<div class="col-xs-10 input_item" id="tituloGrupo" >
										<label for="item" class="control-label">Ingrese nuevo o elija un titulo para el grupo</label>
										<input type="text" class="form-control " id="input-tit-grupo" name="input-tit-grupo" value="" placeholder="Ingrese titulo para el grupo" />
					</div>
					<div class="col-xs-2 add" id="botontituloGrupo">
										<button id="btn-submit-grupo" name="boton" class="btn btn-primary" type="submit" onclick="addTitulo();"> + </button>
								
					</div>
							
				</div> 
				
			</div> <!-- div grupo -->

			<!-- div Items para grupo -->
			<div id="div_items_grupo" style="visibility: hidden;">
				<label class="control-label">Ingrese o elija items para el grupo </label> <label id="nro_grupo">  </label>
										
		
					<div class="row row_items_grupo"> 
							
							<div class="col-xs-8 input_item_grupo">
									
									<input type="text" class="form-control " id="item_grupo" name="item_grupo" value="" placeholder="Ingrese texto del item" />
							</div>
							<div class="col-xs-2 input_pond_grupo">
									
									<input type="text" class="form-control " id="pond_item1_grupo" name="pond_item1_grupo" value="" placeholder="%"  />
							</div>
							<div class="col-xs-2 add_grupo">
									<button id="btn-submit_grupo" name="boton" class="btn btn-primary" type="submit" onclick="addItemGrupo1();"> + </button>
							</div>
						
					</div> 

				

				<div class=" row row_items_grupo">
					
					<div class="col-xs-8 input_item_grupo">

						<?php

						/* SELECT DE items */

						if(!isset($items)) // si no existen items
						{
							echo 	'<select id="select-item-grupo" name="select-item-grupo" class="select form-control" disabled></select>';
						}
						else
						{ 
							echo '<select id="select-item-grupo" name="select-item-grupo" class="select form-control select-i">';

							foreach ($items['list'] as $indice => $item): 

								if($indice == $items['selected'])
								{
									echo '<option value="'.$item['id_item'].'" selected = "selected">'.$item['nom_item'].'</option>';
								}
								else
								{
									echo '<option value="'.$item['id_item'].'">'.$item['nom_item'].'</option>';
								}

							endforeach;

							echo '</select>';
						}
						?>
					</div>	
					<div class="col-xs-2 input_pond">
									
									<input type="text" class="form-control " id="pond_item2_grupo" name="pond_item2_grupo" value="" placeholder="%"  />
							</div>
					<div class="col-xs-2 add">
						<button id="btn-submit2_grupo" name="boton" class="btn btn-primary" type="submit" onclick="addItemGrupo2();"> + </button>
					</div>
				</div >
			</div><!--  div items grupo -->

			<!-- div Items -->
			<div id="div_items">
					 <div class="row row_items"> 
							
							<div class="col-xs-8 input_item">
									
									<input type="text" class="form-control " id="item" name="item" value="" placeholder="Ingrese texto del item" />
							</div>
							<div class="col-xs-2 input_pond">
									
									<input type="text" class="form-control " id="pond_item1" name="pond_item1" value="" placeholder="%"  />
							</div>
							
							<div class="col-xs-2 add">
									<button id="btn-submit" name="boton" class="btn btn-primary" type="submit" onclick="addRow('lista_items_guia');"> + </button>
							</div>
						
					</div> 

				

				<div class=" row row_items">
					
					<div class="col-xs-8 input_item">

						<?php

						/* SELECT DE items */

						if(!isset($items)) // si no existen items
						{
							echo 	'<select id="select-item" name="select-item" class="select form-control" disabled></select>';
						}
						else
						{ 
							echo '<select id="select-item" name="select-item" class="select form-control select-i">';

							foreach ($items['list'] as $indice => $item): 

								if($indice == $items['selected'])
								{
									echo '<option value="'.$item['id_item'].'" selected = "selected">'.$item['nom_item'].'</option>';
								}
								else
								{
									echo '<option value="'.$item['id_item'].'">'.$item['nom_item'].'</option>';
								}

							endforeach;

							echo '</select>';
						}
						?>
					</div>	
					<div class="col-xs-2 input_pond">
									
									<input type="text" class="form-control " id="pond_item2" name="pond_item2" value="" placeholder="%"  />
							</div>
					<div class="col-xs-2 add">
						<button id="btn-submit2" name="boton" class="btn btn-primary" type="submit" onclick="addRow2('lista_items_guia');"> + </button>
					</div>
				</div> 
			</div><!--  div items -->
		</div>
	</div>

	

</div>