<!--
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Noviembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<link type="text/css" href="<?php echo base_url('assets/css/select2.css'); ?>" rel="stylesheet" media="screen"/>
<link type="text/css" href="<?php echo base_url('assets/css/select2-bootstrap.css'); ?>" rel="stylesheet" media="screen"/>  

<script type="text/javascript"  src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/select2_locale_es.js'); ?>"></script>
<script type="text/javascript"  src="<?php echo base_url('assets/js/estudiantes/estudiantes.js'); ?>"></script>

<!-- <link type="text/css" href="<?php echo base_url('assets/css/administracion/lista.css'); ?>" rel="stylesheet" media="screen"/>
 -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.css'); ?>">

<!-- JS de esta vista 
<script type="text/javascript"  src="<?php echo base_url('assets/js/estudiantes/lista_estudiantes.js'); ?>"></script>
--> <!-- DataTables JS-->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<!-- DataTables - Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/js/dataTables.bootstrap.js'); ?>"></script>

  <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
 
 <div class="div-titulo">
    <label><?php echo '<a href="administracion/admin" title="Ir la página anterior">Administración/</a>';?>Lista de Estudiantes </label>
 </div>
 <div class="container lista col-xs-12">
   <!-- <h1>Ajax CRUD with Bootstrap modals and Datatables</h1> -->
 
    <br />
    <button class="btn btn-primary " onclick="add_estudiantes()"><i class="glyphicon glyphicon-plus"></i> Agregar estudiante</button>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Lu</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <!-- <th>id</th> -->
          <!-- <th>Address</th>
          <th>Date of Birth</th> -->
          <th style="width:125px;">Acción</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
 
      <tfoot>
        <tr>
          <th>Lu</th>
          <th>Apellido</th>
          <th>Nombre</th>
          
          <!-- <th>Address</th>
          <th>Date of Birth</th> -->
          <th>Acción</th>
        </tr>
      </tfoot>
    </table>
  </div>
 <!--
  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
 -->
  <script type="text/javascript">
 
    var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('estudiantes/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
        "language": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ estudiantes",
          "sZeroRecords":    "No se encontraron  estudiantes",
          "sEmptyTable":     "Ningún usuario disponible",
          "sInfo":           "Mostrando  estudiantes del _START_ al _END_ de un total de _TOTAL_",
          "sInfoEmpty":      "Mostrando  estudiantes del 0 al 0 de un total de 0",
          "sInfoFiltered":   "(filtrado de un total de _MAX_  estudiantes)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar: ",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      }
 
      });
    });
 
    function add_estudiantes()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
        // $('[name="lu_alu"]').prop('disabled', true);
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Nuevo Estudiante'); // Set Title to Bootstrap modal title
    }
 
    function edit_estudiantes(lu_alu)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('estudiantes/ajax_edit/')?>/" + lu_alu,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="lu_alu"]').val(data.lu_alu);
            // $('[name="lu_alu"]').prop('disabled', true);
            $('[name="apellido_alu"]').val(data.apellido_alu);
            $('[name="nom_alu"]').val(data.nom_alu);
            // $('[name="id"]').val(data.id);
            // $('[name="address"]').val(data.address);
            // $('[name="dob"]').val(data.dob);
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Modificar estudiante'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
 
    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax
    }
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('estudiantes/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('estudiantes/ajax_update')?>";
      }
 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete_estudiantes(lu_alu)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('estudiantes/ajax_delete')?>/"+lu_alu,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
 
      }
    }
 
  </script>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Estudiante Nuevo</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <!-- <input type="hidden" value="" name="id"/> -->
          <div class="form-body">
          <div class="form-group">
              <label class="control-label col-md-3">Lu</label>
              <div class="col-md-9">
                <input name="lu_alu"  placeholder="lu" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Apellido</label>
              <div class="col-md-9">
                <input name="apellido_alu" placeholder="Apellido" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nombre</label>
              <div class="col-md-9">
                <input name="nom_alu" placeholder="Nombre" class="form-control" type="text">
              </div>
            </div>
            
            <!-- <div class="form-group">
              <label class="control-label col-md-3">Address</label>
              <div class="col-md-9">
                <textarea name="address" placeholder="Address"class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Date of Birth</label>
              <div class="col-md-9">
                <input name="dob" placeholder="yyyy-mm-dd" class="form-control" type="text">
              </div> -->
            <!-- </div> -->
          </div>
        </form>
      </div>
          <div class="modal-footer">
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
             <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
<?php 
			if(isset($error))
				echo '<label id="error-server" class="label-error">'.$error .'</label> ';
?>

