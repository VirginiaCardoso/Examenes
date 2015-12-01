<?php 

	$rta_respondidas = 0;
	$rta_correctas = 0;

	/**
	 *	Imprime en HTML los valores del item
	 *
	 * @param 	$item array: id, nro, nom, solo_texto
	 *
	 */
	function _print_item($item) 
	{	
		
		$html = "";

		global $rta_respondidas;
		global $rta_correctas;

		if($item['estado'] == 1)
		{
			
			$rta_respondidas = $rta_respondidas + 1;
			$rta_correctas = $rta_correctas + 1;

			$value = "SI";
			$background_color = "bg-success";
			$value_color = "item-value-si";
		}
		else
		{
			if($item['estado'] == 0)
			{
				$rta_respondidas = $rta_respondidas + 1;
				$value = "NO";
				$background_color = "bg-danger";
				$value_color = "item-value-no";
			}
			else
			{
				$value = "-";
				$background_color = "bg-no-resp";
				$value_color = "";
			}
		}

		if(!$item['solo_texto'])
		{

			$html = $html.
			"<tr class='{$background_color}'>
				<td class='borde item-texto p-left'>
					<span class='numero'>{$item['nro']}.</span> {$item['nom']}
				</td>
				<td class='borde item-texto item-value-titulo'>
					Respuesta:
				</td>
				<td class='borde item-texto item-value {$value_color} p-right'>
					{$value}
				</td>
			</tr>";

			$colspan = 'colspan="3"';
		}
		else 
		{
			$html = $html.
			
			"<tr class='{$background_color}'>
				<td class='borde item-texto p-left p-right'>
					<span class='numero'>{$item['nro']}.</span> {$item['nom']}
				</td>
			</tr>";

			$colspan = '';
		}

		if($item['obs'] != "") {

			$html = $html.
			"<tr class='{$background_color}' >
				<td class='item-obs-container p-left p-right' {$colspan}>					
					<div class='item-obs'>{$item['obs']}</div>
				</td>
			</tr>";
		}

		echo $html;		
	}

	/**
	 *	Imprime en HTML un item
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_item($item) {

		echo "<table class='tabla-item'>";
		_print_item($item);
		echo "</table>";
	}

	/**
	 *	Imprime en HTML un grupoitem
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_grupo_item($grupoitem) {
		echo "
				<table class='tabla-grupoitem borde'>
					<tr>
						<td class='item-texto p-left'>
							<span class='numero'>{$grupoitem['nro']}.</span> {$grupoitem['nom']}
						<td>
					</tr>
				</table>";
	
		echo "<table class='tabla-item' style='margin-left: 10mm; margin-right: -6.5mm;'>";
				foreach ($grupoitem['items'] as $item)  //recorro la lista de items del grupo
				{
					_print_item($item); //imprime inputs y contenido del item
				}

		echo "</table>";
	}

	/**
	 *	Imprime en HTML los datos de una seccion
	 *
	 * @param 	$seccion array: nro, nom
	 * @param 	$primera_seccion boolean: indica si se trata de la primera seccion
	 *
	 */
	function print_seccion($seccion, $primera_seccion) {

		$primera = '';
		
		if(!$primera_seccion)
		{
			$primera = 'tabla-seccion-primera';
		}

		echo "
				<table class='tabla-seccion {$primera}'>
					<tr>
						<td class='seccion'>
							{$seccion['nro']}. {$seccion['nom']}
						<td>
					</tr>
				</table>";

	}
 ?>

<html xml:lang='en' xmlns='http://www.w3.org/1999/xhtml' lang='en'>
<head>
<meta http-equiv='content-type' content='text/html; charset=UTF-8' />
  
</head>

<body>

<div id="header">
  <table>
  	<tbody>
		<tr>
			<td>LABORATORIO DE COMPETENCIAS PROFESIONALES</td>
			<td>
				<table>
					<tr>
						<td style="text-align: right;">UNIVERSIDAD NACIONAL DEL SUR</td>
					</tr>
					<tr>
						<td style="text-align: right;">Departamento de Ciencias de la Salud</td>
					</tr>
			  	</table>
			</td>
			
		</tr>
	</tbody>
  </table>
</div>

<div id="footer">
  <div class="page-number"></div>
</div>

<link type="text/css" href="<?php echo base_url('assets/css/examen/examen_pdf.css'); ?>" rel="stylesheet" media="screen"/>


<table class="tabla-titulo">
	<tbody>
		<tr>
			<td class="col-titulo-guia">
				Guía N° <?php echo $guia['tit_guia']; ?>
									<!-- $guia['nro_guia'].': '. -->
			</td>
		</tr>
		<tr>
			<td class="col-subtitulo-guia">
				<?php 
					if($guia['subtit_guia']) {
						echo $guia['subtit_guia']; 
					}
				?>	
			</td>
		</tr>
	</tbody>
</table>

<table class="tabla-datos">
	<tbody>
		<tr>
			<td class="div-titulo">
				Carrera:
			</td>
			<td>
				<?php echo $carrera['cod_carr'].' - '.$carrera['nom_carr']; ?>	
			</td>
		</tr>
		<tr>
			<td class="div-titulo">
				Cátedra:
			</td>
			<td>
				<?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?>
			</td>
		</tr>
		<tr>
			<td class="div-titulo">
				Docente:
			</td>
			<td>
				<?php echo $docente['leg_doc'].' - '.$docente['apellido_doc'].', '.$docente['nom_doc']; ?>
			</td>
		</tr>

		<tr>
			<td class="div-titulo">
				Estudiante:
			</td>
			<td>
				<?php echo $alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu']; ?>
			</td>
		</tr>

		<tr>
			<td class="div-titulo">
				ID Examen:
			</td>
			<td>
				<?php echo $examen['id_exam']; ?>
			</td>
		</tr>

		<tr>
			<td class="div-titulo">
				Fecha del Examen:
			</td>
			<td>
				<?php				
					$fecha_hora = explode(" ", $fecha);
					echo $this->util->YMDtoDMY($fecha_hora[0])." - ".$fecha_hora[1];
				?>
			</td>
		</tr>
	</tbody>

</table>


	<?php 

		$tiene_secciones = false;
		$primera_seccion = true;

		foreach ($guia['items'] as $item) 
		{
			if($item['tipo'] == 'seccion') //si el item es una seccion
			{
				$tiene_secciones = true;

				print_seccion($item, $primera_seccion);

				foreach ($item['items'] as $item2)  //recorro la lista de items de la seccion
				{
					if($item2['tipo']=='grupoitem') //si el item es un grupoitem
					{ 
						print_grupo_item($item2);
					}
					else //item suelto en la seccion
					{
						print_item($item2);
					}		
				}
				echo "<div class='borde borde-final'></div>"; //último borde de la seccion

				$primera_seccion = false;
			} 
			else
			{
				if ($item['tipo']=='grupoitem') //si el item es un grupoitem
				{ 
					print_grupo_item($item);	
				}
				else // item suelto en la guia
				{
					print_item($item);
				}
			}
		}

		if(!$tiene_secciones) {
			echo "<div class='borde borde-final'></div>"; //último borde
		}
 	?>	

 	<?php 

		if($examen['obs_exam'] != "")
		{
			$obs_gral = $examen['obs_exam'];
		}
		else
		{
			$obs_gral = "-";
		}

		global $rta_respondidas;
		global $rta_correctas;

		$porcentaje_correcto = 0;

		if($rta_respondidas > 0) {
			$porcentaje_correcto = ($rta_correctas * 100) / $rta_respondidas;
			$porcentaje_correcto = number_format((float)$porcentaje_correcto, 2, '.', '');
		}

		$porcentaje_correcto = $porcentaje_correcto."%  - (".$rta_correctas." / ".$rta_respondidas.")";
			
		
	?>

 	<table class="tabla-obs-gral">
 		<tbody>
 			<tr>
 				<td class="observacion-general" colspan="2">
 					Observación General del Examen
 				</td>
 			</tr>
 			<tr>
				<td class='item-obs-container' colspan="2">					
					<div class='item-obs'><?php echo $obs_gral; ?></div>
				</td>
			</tr>
			<tr>
				<td class="observacion-general-small">					
					Porcentaje correctas:
				</td>
				<td class="observacion-general-value">
					<?php echo $porcentaje_correcto; ?>
				</td>
			</tr>
			<tr>
				<td class="observacion-general observacion-general-small" >					
					CALIFICACION:
				</td>
				<td class="observacion-general-value">
					<?php
		 				switch($examen['calificacion'])
		 				{
		 					case CALIF_COMPETENCIA_NO_ADQUIRIDA:
		 															echo "<span class='span-calificacion no-adquirida'>Competencia no adquirida.</span>";
		 															break;

		 					case CALIF_COMPETENCIA_MED_ADQUIRIDA:	echo "<span class='span-calificacion medianamente-adquirida'>Competencia medianamente adquirida.</span>";
		 															break;

		 					case CALIF_COMPETENCIA_ADQUIRIDA:		echo "<span class='span-calificacion adquirida'>Competencia adquirida.</span>";
		 															break;
		 					default:
		 															echo "Sin calificar.";
		 				}
			 		?>
				</td>
			</tr>
 		</tbody>
 	</table>

</body>

</html>