

<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Noviembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 


-->

<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/estadisticas/estadisticas.css'); ?>" rel="stylesheet" media="screen"/>

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	
<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>			

<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script> 
<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script> 
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/estadisticas/estadisticas.js'); ?>"></script>

<link  type="text/css" href=<?php echo base_url('assets/css/bootstrap.min.css'); ?> rel="stylesheet" media="screen">

<link type="text/css" href="<?php echo base_url('assets/css/home/index.css'); ?>" rel="stylesheet" media="screen"/>


<div class="div-titulo">
	
		<label>Exámenes <?php echo $apellido.', '.$nombre; ?></label>
			
</div>

<div id="div-principal">
	<div class="form-group-estad">	
		
		<div id="div-mostrar" >


			<div class="list-group">
				<!-- <li class="list-group-item"> hola </li> -->
  				<?php
  						$cant_rend = 0;
  						$cant_adq = 0;
  						$cant_med_adq =0;
  						$cant_no_adq =0;
  						$suma_porc = 0;
						foreach ($guias_est['list'] as $indice => $guia_e): 
							$cant_rend = $cant_rend +1;
							$fecha_hora = explode(" ",  $guia_e['fecha']);
            				$fecha = $this->util->YMDtoDMY($fecha_hora[0]);
            				// ." ".$fecha_hora[1];

							// echo '<li class="list-group-item"> '.$fecha.' - '. $guia_e['tit_guia'].' - ';
							// 	if ($guia_e['calificacion']==2){
							// 		echo 'Competencia adquirida: ';
							// 	} elseif ($guia_e['calificacion']==1){
							// 		echo 'Competencia medianamente adquirida: ';
							// 	} else {
							// 		if ($guia_e['calificacion']==0){
							// 		echo 'Competencia no adquirida: ';
							// 	}
						 // 		}
									
							// echo $guia_e['porcentaje_exam'].'%</li>';
							echo '<a href="'.site_url('examen/ver/'.$guia_e['id_exam']).'" class="list-group-item "> <h4 class="list-group-item-heading">'.$fecha.' - '. $guia_e['tit_guia'].'</h4> <p class="list-group-item-text">';
								if ($guia_e['calificacion']==2){
									echo 'Competencia adquirida: ';
									$cant_adq = $cant_adq +1;
								} elseif ($guia_e['calificacion']==1){
									echo 'Competencia medianamente adquirida: ';
									$cant_med_adq = $cant_med_adq +1;
								} else {
									if ($guia_e['calificacion']==0){
									echo 'Competencia no adquirida: ';
									$cant_no_adq = $cant_no_adq +1;
									}
						 		}
							$suma_porc = $suma_porc + $guia_e['porcentaje_exam'];		
							echo $guia_e['porcentaje_exam'].'% </p></a>';
						
						endforeach; 

						$prom_porc = $suma_porc / $cant_rend;
				?>

			</div>
		</div>
	</div>

	<div class="resumen_exam">
			<h4> Resumen </h4>


			<ul >
  				<li class="lista_resumen"> <b>Cantidad exámenes rendidos:</b> <?php echo $cant_rend; ?></li>
  				<li class="lista_resumen"> <b>Cantidad "Competencia Adquirida":</b> <?php echo $cant_adq; ?></li>
  				<li class="lista_resumen"><b>Cantidad "Competencia Medianamente Adquirida": </b><?php echo $cant_med_adq; ?></li>
  				<li class="lista_resumen" ><b>Cantidad "Competencia No Adquirida":</b> <?php echo $cant_no_adq; ?></li>
  				<li class="lista_resumen"><b>Promedio de porcenjate:</b> <?php echo $prom_porc; ?> %</li>
  			</ul>


	</div>
	
	
	
	<?php 
		if(isset($info))
			echo '<br/><label id="error-server" class="label-error">'.$info .'</label> ';
	?>
</div>