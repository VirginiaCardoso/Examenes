<!--
	AUTOR		Cardoso, Virginia
	AUTOR		Marullo, Matias
	COPYRIGHT	Diciembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
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

		if($evaluar)     // <input type='hidden' name='item-estado[]' class='item-estado' id='estado-item-{$item['id']}' data-item='{$item['id']}' value='-1'/>
		{				// <input type='hidden' name='item-pond[]' class='item-pond' id='pond-item-{$item['id']}' value='{$item['pond']}'/>
			$inputs = 	"<input type='hidden' name='item-id[]' id='input-item-{$item['id']}' value='{$item['id']}'/>
						 <input type='hidden' name='item-pos[]' class='item-pos' id='pos-item-{$item['id']}' value='{$item['pos']}'/>";
		}
		
				$botonera =	$botonera."<div class='item-pond'>	
<input type='text' class='form-control' id='text-item-{$item['id']}' name='item-text[]' value='{$item["pon"]}' />

							</div>";
					$botonera =	$botonera."</div>";

		$texto =	"<div class='item-texto'>						
						<span class='numero'>{$item['nro']}.</span> {$item['nom']}
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
<script type="text/javascript"  src="<?php echo base_url('assets/js/guias/modificar_guia.js'); ?>"></script>

<div class="div-titulo">

	<label>Guia a modificar</label>

</div>


<div id="div-evaluar" data-evaluando="<?php echo $evaluar; ?>">
	
	
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
			// if($guia['itemsestudiante'])
			// {
			// 	echo '<li>';
			// }
			// else 
			// {
				echo '<li class="disabled">';
			// }
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
			<form id="form-modificar" class="form-evaluar" role="form" method="post" action="<?php echo site_url('guias/lista_guias');?>">

			
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

			 	<?php if($evaluar): ?>
					<div class="evaluacion form-group-buttons botonera">
					<a id="btn-cancelar" data-target="#" class="btn btn-default btn-lg">Cancelar</a>
					<a id="btn-modificar" data-target="#" class="btn btn-primary btn-lg">Modificar</a>
				</div>
				<?php endif; ?>

					

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
					<strong>ATENCIÓN!</strong> Usted está por abandonar la guia. Si continúa perderá las modificaciones realizadas.
				</div>

				<div id="alert-warning-save" class="alert alert-warning modal-body-content">
					<strong>ATENCIÓN!</strong> ¿Está realmente seguro de que desea guardar las modificaciones de la guia? 
				</div>

				<div id="alert-success" class="alert alert-success modal-body-content">					
					<div id="response-success"></div>
				</div>

				<div id="alert-error" class="alert alert-danger modal-body-content">					
					<div id="response-error"></div>
				</div>

				<div id="progressbar" class="progress progress-striped active modal-body-content-loadingbar">
					<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						<span>Guardando modificaciones</span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn-modal-cancelar" class="btn btn-default btn-modal-warning" data-dismiss="modal">Cancelar</button>
				<a id="btn-modal-abortar"  class="btn btn-primary btn-modal-warning">Salir</a>  <!-- hace Submit a /generar, o es un link, dependiendo de lo que se cliqueo -->
				<a id="btn-modal-save" class="btn btn-primary">Continuar</a>

				<a id="btn-modal-inicio" href="<?php echo site_url('guias/lista_guias');?>" class="btn btn-default btn-modal-success btn-modal-error">Ir a Listas Guias</a>
				<button id="btn-modal-revisar" class="btn btn-default btn-modal-error" data-dismiss="modal">Revisar modificaciones</button>
				<!-- <a id="btn-modal-ver" class="btn btn-success btn-modal-success" data-link="<?php echo site_url('examen/ver');?>">Ver Examen Archivado</a> -->
				<!-- <a id="btn-modal-nuevo" class="btn btn-primary btn-modal-success btn-modal-error">Iniciar Nuevo Examen</a>-->  <!-- hace Submit a /generar para que tenga datos precargados --> 
						
				<a id="btn-modal-reintentar" class="btn btn-primary btn-modal-error">Reintentar</a>  <!-- hace Submit a generar para que tenga datos precargados -->
				

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>