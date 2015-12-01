<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->
   
<?php 
	/**
	 *	Imprime en HTML los valores del item, incluyendo los input hidden y las opciones de seleccion
	 *
	 * @param 	$item array: id, nro, nom, solo_texto
	 * @param 	$item_suelto boolean: indica si es item individual o subitem
	 *
	 */
	function _print_item($evaluar, $item, $item_suelto) 
	{	
		
		$botonera = "<div class='item-botonera pull-right'>";

		$solo_texto = "solotexto";
		$inputs = "";
		$value = "";

		if($evaluar) 
		{				// <input type='hidden' name='item-pond[]' class='item-pond' id='pond-item-{$item['id']}' value='{$item['pond']}'/>
			$inputs = 	"<input type='hidden' name='item-id[]' id='input-item-{$item['id']}' value='{$item['id']}'/>
						 <input type='hidden' name='item-estado[]' class='item-estado' id='estado-item-{$item['id']}' data-item='{$item['id']}' value='-1'/>
						 <input type='hidden' name='item-pond[]' class='item-pond' id='pond-item-{$item['id']}' value='{$item['pon']}'/>";
		}
		else
		{
			$value = "data-estado='{$item['estado']}'";
		}

		if(!$item['solo_texto'])
		{
			$solo_texto = "";			

			if($evaluar) 
			{
				$botonera =	$botonera.
							"<div class='btn-group evaluacion' data-toggle='buttons'>
						 	  	<label class='boton-si btn btn-default'>
									<input type='checkbox'> Sí
							    	<span class='glyphicon glyphicon-ok'></span>
							  	</label>
								<label class='boton-no btn btn-default'>
									<input type='checkbox'> No
									<span class='glyphicon glyphicon-remove'></span>
								</label>
							</div>";
			}

			$botonera =	$botonera."<span class='item-value-titulo calificacion'>Respuesta: </span><span class='item-value calificacion' {$value}>-</span> <input type='hidden' name='item-pond[]' class='item-pond' id='pond-item-{$item['id']}' value='{$item['pon']}'/>";
			// <span class='item-value-pond ponderacion calificacion'>{$item['pon']}</span>";
		}
		else 
		{
			if(!$evaluar)
			{
				$botonera =	$botonera."<span class='item-value calificacion' {$value}></span>";
			}
		}

		if($evaluar) 
		{
			$botonera =	$botonera."<a class='btn btn-default boton-obs pull-right evaluacion'>Obs <span class='glyphicon glyphicon-pencil'></span></a>";
		}

			$botonera =	$botonera."</div>";

		$texto =	"<div class='item-texto'>						
						<span class='numero'>{$item['nro']}.</span> {$item['nom']} ({$item['pon']}%)
					</div>";

		$fin = 	"	<div class='clearboth'></div>";

		$value = "";
		$observacion = "";

		if($evaluar) 
		{
			$fin = $fin."<div class='item-obs-container {$solo_texto}'>
						<textarea name='item-obs[]' class='form-control item-obs observaciones input-deshabilitado' rows='2' placeholder='Ingrese una observación aquí'></textarea>
						<div class='label-obs span-item-obs-container'>
							<span class='span-item-obs'></span>
						</div>
					</div>";
		}
		else
		{
			$observacion = $item['obs'];

			if($item['obs'] != "") {
				$fin = $fin."<div class='item-obs-container {$solo_texto}'>
							<div class='label-obs span-item-obs-container'>
							<span class='span-item-obs'>{$observacion}</span>
						</div>
					</div>";
			}
		}		

		if($item_suelto) 
		{
			echo $inputs.$botonera.$texto.$fin;
		}
		else
		{
			echo "<div class='item borde-item'>".$inputs.$botonera.$texto.$fin."</div>";
		}		
	}

	/**
	 *	Imprime en HTML un item
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_item($evaluar, $item) {

		echo "<div class='grupo-item borde-grupoitem'>";
				_print_item($evaluar, $item, true); //imprime inputs y contenido del item
		echo "</div>";

	}

	/**
	 *	Imprime en HTML un grupoitem
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_grupo_item($evaluar, $grupoitem) {
		echo 	"<div class='grupo-item borde-grupoitem'>
					<div class='item-texto'>
						<span class='numero'>{$grupoitem['nro']}</span>. {$grupoitem['nom']}<br/>"; //nombre del grupoitem
		echo "		</div>
				</div>				
			  	<div class='sangria'>";	
					foreach ($grupoitem['items'] as $item)  //recorro la lista de items del grupo
					{
						_print_item($evaluar, $item, false); //imprime inputs y contenido del item
					}
		echo "  </div>";
	}

	/**
	 *	Imprime en HTML los datos de una seccion
	 *
	 * @param 	$seccion array: nro, nom
	 *
	 */
	function print_seccion($seccion) {
		echo "<div class='seccion'>{$seccion['nro']}. {$seccion['nom']}</div>"; //nombre de la seccion

	}
 ?>

<link type="text/css" href="<?php echo base_url('assets/css/examen/examen.css'); ?>" rel="stylesheet" media="screen"/>
<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/examen.js'); ?>"></script>

<div class="div-titulo">
<?php if($evaluar): ?>
	<label>Evaluar examen</label>
<?php else: ?>
	<label>Vista de examen archivado</label>
<?php endif; ?>
</div>


<div id="div-evaluar" data-evaluando="<?php echo $evaluar; ?>">
	
	<div class="tabla">
		<div class="fila">	
			<div class="columna field-name">
				Carrera:
			</div>
			<div class="columna">
				<?php echo $carrera['cod_carr'].' - '.$carrera['nom_carr']; ?>
			</div>
		</div>

		<div class="fila">	
			<div class="columna field-name">
				Cátedra:
			</div>
			<div class="columna">
				<?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?>
			</div>
		</div>

		<?php if(!$evaluar): ?>
		<div class="fila">	
			<div class="columna field-name">
				Docente:
			</div>
			<div class="columna">
				<?php echo $docente['leg_doc'].' - '.$docente['apellido_doc'].', '.$docente['nom_doc']; ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="fila">	
			<div class="columna field-name">
				Estudiante:
			</div>
			<div class="columna">
				<?php echo $alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu']; ?>
			</div>
		</div>

		<?php if(!$evaluar): ?>
		<div class="fila">	
			<div class="columna field-name">
				ID Examen:
			</div>
			<div class="columna">
				<?php echo $examen['id_exam']; ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="fila">	
			<div class="columna field-name">
				Fecha del Examen:
			</div>
			<div class="columna">
			<?php
				if($evaluar)
				{
					echo $fecha;
				}
				else
				{
					$fecha_hora = explode(" ", $fecha);
					echo $this->util->YMDtoDMY($fecha_hora[0])." - ".$fecha_hora[1];
				}
			?>
			</div>
		</div>

		<?php if(!$evaluar): ?>
		<div class="fila">	
			<div class="columna field-name">
				Calificación:
			</div>
			<div class="columna">
				<?php switch($examen['calificacion'])
	 				{
	 					case CALIF_COMPETENCIA_NO_ADQUIRIDA:
	 						echo "Competencia no adquirida"; break;

	 					case CALIF_COMPETENCIA_MED_ADQUIRIDA:
	 						echo "Competencia medianamente adquirida";break;

	 					case CALIF_COMPETENCIA_ADQUIRIDA:
	 						echo "Competencia adquirida"; break;
	 					default:
	 						echo "Sin calificar.";
					}				
				?>
			</div>
		</div>
		<?php endif; ?>

	</div>

	<div class="barra-division"></div>

	<div class="col-xs-12 col-titulo-guia">
		"<?php echo $guia['tit_guia']; ?>"
		<!-- $guia['nro_guia'].': '. -->
	</div>
	<div class="col-xs-12 col-subtitulo-guia">
		<?php 
			if($guia['subtit_guia']) {
				echo $guia['subtit_guia']; 
			}
		?>		
	</div>
			
	<!-- Nav tabs -->
	<ul id="tab" class="nav nav-tabs">
		<?php 
			if($guia['desc'])
			{
				echo '<li>';
			}
			else 
			{
				echo '<li class="disabled">';
			}
		?>
			<a href="#descripcion" class="nav-tab-link" data-toggle="tab">Descripción</a>
		</li>
		<li class="active">
			<a href="#evaluacion" class="nav-tab-link" data-toggle="tab">Evaluación</a>
		</li>
		<?php 
			if($guia['itemsestudiante'])
			{
				echo '<li>';
			}
			else 
			{
				echo '<li class="disabled">';
			}
		?>
			<a href="#guia-estudiante" class="nav-tab-link" data-toggle="tab">Guía Estudiante</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div id="descripcion" class="tab-pane fade" > 
			<div class="tabla fila-spacing">
			<?php foreach ($guia['desc'] as $desc): ?> 
				<div class='fila'>		
					<div class='columna div-descripcion-titulo'>
						<?php echo $desc['nom_desc']; ?>:
					</div>
					<div class='columna'>
						<?php echo $desc['contenido_desc']; ?>	
					</div>									
				</div>
			
			<?php endforeach; ?>				
			</div>
		</div>
		<div id="guia-estudiante" class="tab-pane fade" >
			<ul class='ul-item-estudiante'>
				<?php foreach ($guia['itemsestudiante'] as $itemest): ?>
				<li>
					<?php echo $itemest['nom_itemest']; ?>
				</li>				
				<?php endforeach; ?>
			</ul>	
		</div>
		<div id="evaluacion" class="tab-pane fade in active">
			<?php if($evaluar): ?>
			<div class="col-titulo-guia titulo-revision calificacion clearboth">[REVISIÓN DE LAS RESPUESTAS]</div>
			
			<!--Action default del FORM: vuelve a generar (envia de vuelta los parametros). El guardar examen lo hace por AJAX -->
			<form id="form-evaluar" class="form-evaluar" role="form" method="post" action="<?php echo site_url('examen/generar');?>">

				<input type="hidden" name="fecha" id="input-fecha" value="<?php echo $fecha; ?>"/>
				<input type="hidden" name="carrera" id="input-carrera" value="<?php echo $carrera['cod_carr']; ?>"/>
				<input type="hidden" name="catedra" id="input-catedra" value="<?php echo $catedra['cod_cat']; ?>"/> <!-- no es necesario -->
				<input type="hidden" name="alumno" id="input-alumno" value="<?php echo $alumno['lu_alu']; ?>"/>
				<input type="hidden" name="guia" id="input-guia" value="<?php echo $guia['id_guia']; ?>"/>

			<?php endif; ?>

				<?php 

					$tiene_secciones = false;

					foreach ($guia['items'] as $item) 
					{
						if($item['tipo'] == 'seccion') //si el item es una seccion
						{
							$tiene_secciones = true;

							print_seccion($item);

							foreach ($item['items'] as $item2)  //recorro la lista de items de la seccion
							{
								if($item2['tipo']=='grupoitem') //si el item es un grupoitem
								{ 
									print_grupo_item($evaluar, $item2);
								}
								else //item suelto en la seccion
								{
									print_item($evaluar, $item2);
								}		
							}
							echo "<div class='borde-grupoitem borde-final'></div>"; //último borde de la seccion
						} 
						else
						{
							if ($item['tipo']=='grupoitem') //si el item es un grupoitem
							{ 
								print_grupo_item($evaluar, $item);	
							}
							else // item suelto en la guia
							{
								print_item($evaluar, $item);
							}
						}
					}

					if(!$tiene_secciones) {
						echo "<div class='borde-grupoitem borde-final'></div>"; //último borde
					}
			 	?>	

			 	<span class="span-calif-obsGral">Observación General del Examen</span>			 	
			 	
			 	<div class='label-obs label-obs-gral span-examen-obs-container'>
					<span class='span-examen-obs'>
						<?php 
							if(!$evaluar)
							{ 
								if($examen['obs_exam'] != "")
								{
									echo $examen['obs_exam'];
								}
								else
								{
									echo "&nbsp;";
								}
								
							} 
						?>
					</span>
				</div>

				<?php if($evaluar): ?>
				<textarea id="examen-obs" name="examen-obs" class="examen-obs form-control input-deshabilitado" rows="3" placeholder="Ingrese una observación aquí"></textarea>

			 	<div class="evaluacion form-group-buttons botonera">
					<a id="btn-cancelar" data-target="#" class="btn btn-default btn-lg">Cancelar</a>
					<a id="btn-calificar" data-target="#" class="btn btn-primary btn-lg">Calificar</a>
				</div>
				<?php endif; ?>

				<div class="calificacion container-calificacion">
				 	Respuestas correctas:  <span id="porcentaje-realizado">porcentaje</span>
				 	<br>
				 	Porcentaje ponderación: <span id="ponderacion-realizado">ponderacion</span>
				 	<input type="hidden" name="examen-pond" id="examen-pond" value="0">


				 	<input type="hidden" name="min-adq" id="min-adq" value=<?php echo '"'.$adq['min_valor'].'"';?>>
				 	<input type="hidden" name="min-med-adq" id="min-med-adq" value=<?php echo '"'.$med_adq['min_valor'].'"';?>>
				 	<br>
				 	<br>
				 	<!-- Sugerencia calificación: <span id="sugerencia-calificacion">calificación</span> -->

				 	<div class="examen-calificacion">
					 	<span class="span-calif-obsGral">CALIFICACION: </span> 
					 	<span id="sugerencia-calificacion"></span>
				 		<input type="hidden" name="examen-calif" id="examen-calif" value="-1">
					 	
			<!-- 		 	<?php

				 			// if(!$evaluar)
				 			// {
				 			// 	switch($examen['calificacion'])
				 			// 	{
				 			// 		case CALIF_COMPETENCIA_NO_ADQUIRIDA:
				 			// 												echo "<span class='span-calificacion no-adquirida'>Competencia no adquirida.</span>";
				 			// 												break;

				 			// 		case CALIF_COMPETENCIA_MED_ADQUIRIDA:	echo "<span class='span-calificacion medianamente-adquirida'>Competencia medianamente adquirida.</span>";
				 			// 												break;

				 			// 		case CALIF_COMPETENCIA_ADQUIRIDA:		echo "<span class='span-calificacion adquirida'>Competencia adquirida.</span>";
				 			// 												break;
				 			// 		default:
				 			// 												echo "Sin calificar.";
				 			// 	}
				 			// }
				 			// else {

				 			// 	echo '<span id="sugerencia-calificacion"></span>
				 			// 						 	<input type="hidden" name="examen-calif" id="examen-calif" value="-1">';
				 				// echo '
				 				// 	<div id="examen-calificacion" class="opciones-calificacion">
								 // 		<input type="radio" name="examen-calif" id="calificacion-1" value="-1" style="display:none" checked="checked">
								 // 		<div class="radio">
									//  	<label>						 		
									// 		<input type="radio" name="examen-calif" id="calificacion2" value="2">
									// 		<span class="radio-texto">Competencia adquirida</span>
									//  	</label>
									//  	</div>
									//  	<div class="radio">
									//  	<label>
									// 		<input type="radio" name="examen-calif" id="calificacion1" value="1">
									// 		<span class="radio-texto">Competencia medianamente adquirida</span>
									//  	</label>
									//  	</div>
									//  	<div class="radio">
									//  	<label>
									// 		<input type="radio" name="examen-calif" id="calificacion0" value="0">
									// 		<span class="radio-texto">Competencia no adquirida</span>
									//  	</label>
									//  	</div>
									// </div>
									// <label id="error-radio" class="label-error errores"></label>
				 				// ';
				 			// }
				 		?>
					 	 -->
					</div>

					
					<div class="form-group-buttons  botonera">
						<?php if($evaluar): ?>
						<a id="btn-atras" href="#" class="btn btn-default btn-lg">Modificar respuestas</a>
						<a id="btn-confirmar" name="boton" class="btn btn-primary btn-lg">Confirmar</a>
						<?php else: ?>
						<a id="btn-inicio" href="<?php echo site_url('home');?>" class="btn btn-primary btn-lg">Inicio</a>
						<?php endif; ?>
					</div>	

					

				</div>

			<?php if($evaluar): ?>
			</form>
			<?php endif; ?>
		</div>		
	</div>
</div>

<?php if($evaluar): ?>
<div id="modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="modal-titulo" class="modal-title"></h4>
			</div>
			<div class="modal-body">

				<div id="alert-warning-exit" class="alert alert-warning modal-body-content">
					<strong>ATENCIÓN!</strong> Usted está por abandonar el examen. Si continúa perderá los datos y deberá generar el examen nuevamente.
				</div>

				<div id="alert-warning-save" class="alert alert-warning modal-body-content">
					<strong>ATENCIÓN!</strong> ¿Está realmente seguro de que desea guardar este examen? <br/> El mismo, una vez archivado, no podrá ser modificado.
				</div>

				<div id="alert-success" class="alert alert-success modal-body-content">					
					<div id="response-success"></div>
				</div>

				<div id="alert-error" class="alert alert-danger modal-body-content">					
					<div id="response-error"></div>
				</div>

				<div id="progressbar" class="progress progress-striped active modal-body-content-loadingbar">
					<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						<span>Guardando Examen</span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn-modal-cancelar" class="btn btn-default btn-modal-warning" data-dismiss="modal">Cancelar</button>
				<a id="btn-modal-abortar" class="btn btn-primary btn-modal-warning">Abortar</a>  <!-- hace Submit a /generar, o es un link, dependiendo de lo que se cliqueo -->
				<a id="btn-modal-save" class="btn btn-primary">Continuar</a>

				<a id="btn-modal-inicio" href="<?php echo site_url('home');?>" class="btn btn-default btn-modal-success btn-modal-error">Inicio</a>
				<button id="btn-modal-revisar" class="btn btn-default btn-modal-error" data-dismiss="modal">Revisar Examen</button>
				<a id="btn-modal-ver" class="btn btn-success btn-modal-success" data-link="<?php echo site_url('examen/ver');?>">Ver Examen Archivado</a>
				<a id="btn-modal-nuevo" class="btn btn-primary btn-modal-success btn-modal-error">Iniciar Nuevo Examen</a>  <!-- hace Submit a /generar para que tenga datos precargados -->
						
				<a id="btn-modal-reintentar" class="btn btn-primary btn-modal-error">Reintentar</a>  <!-- hace Submit a generar para que tenga datos precargados -->
				

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>