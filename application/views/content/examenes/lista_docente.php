<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Mayo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->


<!-- CSS de esta vista -->
<link type="text/css" href="<?php echo base_url('assets/css/examenes/lista.css'); ?>" rel="stylesheet" media="screen"/>
<!-- DataTables CSS 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
-->
<!-- DataTables - Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/examenes/lista.js'); ?>"></script>
<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>


<div class="div-titulo">
	<?php if(count($arreglo)>0): ?>
		<label>Lista de exámenes evaluados por <?php echo $docente; ?></label>
	<?php else: ?>
		<label>No hay exámenes evaluados por <?php echo $docente; ?></label>
	<?php endif; ?>	
</div>

<div class="row">
	<div class="lista col-xs-12">
	<?php echo $tabla; ?>
	</div>
</div>
