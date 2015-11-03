<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Agosto, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

 <link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/> 

 <link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>	

<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>


<link type="text/css" href="<?php echo base_url('assets/css/catedras/lista_catedras.css'); ?>" rel="stylesheet" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/catedras/lista_catedras.js'); ?>"></script>
<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>

 <div class="div-titulo">
	<?php if(count($arreglo)>0): ?>
		<label><?php echo '<a href="../administracion/admin" title="Ir la página anterior">Administración/</a>';?>Cátedras</label>
	<?php else: ?>
		<label>No hay cátedras cargadas en el sistema.</label>
	<?php endif; ?>	
</div>

<div id="lista-catedras" >
  <a id="btn-agregar" href="<?php echo site_url('catedras/nueva_catedra');?>" class="btn btn-primary ">Agregar nueva</a> 
  <div class="row">
    <div class="lista col-xs-12">
    <?php echo $tabla; ?>
    </div>
  </div>
</div>


    <?php 
      if(isset($error))
          echo '<label id="error-server" class="label-error">'.$error .'</label> ';
     ?>
<!-- </div> -->
