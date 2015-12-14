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
<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/usuarios.js'); ?>"></script>


<!-- <link type="text/css" href="<?php echo base_url('assets/css/administracion/lista.css'); ?>" rel="stylesheet" media="screen"/>
 -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista -->
<script type="text/javascript"  src="<?php echo base_url('assets/js/administracion/lista_usuarios.js'); ?>"></script>
<!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>

<link type="text/css" href="<?php echo base_url('assets/css/administracion/lista_usuarios.css'); ?>" rel="stylesheet" media="screen"/>



 
 <div class="div-titulo">
		<label><?php echo '<a href="admin" title="Ir la página anterior">Administración/</a>';?>Lista de Usuarios </label>
 </div>
 <div id="lista-usuarios" >
   <a id="btn-agregar" href="<?php echo site_url('administracion/nuevo_usuario');?>" class="btn btn-primary ">Agregar nuevo</a> 	
	<div class="row">
		<div class="lista col-xs-12">
		<!-- <form id="form-modificaru" class="form-evaluar" role="form" method="post" action="<?php echo site_url('administracion/eliminar');?>"> -->
		
			<?php echo $tabla; ?>
		
		<!-- </form> -->
		</div>
	</div>
</div>



<!-- <form id="form-delete-usuario" class="form-delete-usuario" role="form" method="post" action="<?php echo site_url('administracion/eliminar_usuario/'.$user['leg_doc']);?>" > -->

<a id="btn-guardar" name="boton" class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#delUsuario">Guardar</a>

<div class="modal fade" id="delUsuario" tabindex="-1" role="dialog" aria-labelledby="delUsuarioLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delUsuarioLabel">Eliminar Usuario</h4>
        </div>
        <div class="modal-body">
          <div id="alert-warning-save" class="alert alert-warning modal-body-content">
  			<strong>ATENCIÓN!</strong> Usted está por eliminar un usuario.</div>
        </div>
        <div class="modal-footer">
          <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button  type="submit" id="btn-modal-save" class="btn btn-primary success">Eliminar</button>
        </div>
       </div>
      </div>
   </div>
</form>





<!-- 
<div class="boton-eliminar">
 <button id="btn-cancelar" name="boton" class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#elimUsuario">
 <span class="glyphicon glyphicon-trash grande"></span></button> 
 <div class="modal fade" id="elimUsuario" tabindex="-1" role="dialog" aria-labelledby="cGuiaLabel">
  <div class="modal-dialog" role="document">
   <div class="modal-content"> 
   <div class="modal-header"> 
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span></button> 
   <h4 class="modal-title" id="cGuiaLabel">Eliminar Usuario</h4></div>  
   <div class="modal-body"> 
   <div id="alert-warning-save" class="alert alert-warning modal-body-content">	
   <strong>ATENCIÓN!</strong> Usted está por eliminar un usuario.</div>
      </div>   
       <div class="modal-footer">    
       <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> 
        <a  id="btn-modal-save" type="button" class="btn btn-primary success">Eliminar</a>
         </div> </div> </div></div>	'; -->
<?php 
			if(isset($error))
				echo '<label id="error-server" class="label-error">'.$error .'</label> ';
?>

 	


	