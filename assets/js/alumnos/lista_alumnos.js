/*	
	AUTOR		Cardoso Virginia
	AUTOR 		Marzullo Matias
	COPYRIGHT	Septimbre 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$(document).ready(function() {
	crearDataTable();
	
	event_handlers_window();
	$('#navbar-administracion').parent().addClass('active');

	$('[data-toggle="tooltip"]').tooltip();

	$(window).resize(); // Disparo el evento para que el contenido quede centrado.


	event_handlers_modal_buttons();
});



function event_handlers_modal_buttons() {

	$('#confirm').click(function(event) {

		
			event.preventDefault();
			$('#form-eliminar').submit();
		
	});
}


function crearDataTable() {
	
	  // $('#lista_estudiantes').DataTable(); //datateble original
	$('#lista_estudiantes').dataTable({ //datatable personalizado
		"columnDefs": [
            {
                "targets": [ 5,6 ],
                "visible": false,
                "searchable": false
            },
            {
            	"targets": [4],
            	"createdCell": function (td, cellData, rowData, row, col) {
      				var newData = '';
     
  					 newData += '<div class="contenedor-botones">';
  					 newData += '<div class="boton-modificar"><a href="'+rowData[5]+'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Modificar datos" ><span class="glyphicon glyphicon-pencil grande"></span> </a></div>';
  					 newData += '<div class="boton-eliminar"> <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a></div>';                         
  					
  					 // '<div class="boton-eliminar"> <form method="POST" action="'+rowData[6]+'" accept-charset="UTF-8" style="display:inline"> <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button></form> </div>';
  					 $(td).html(newData);
  					 $(td).css("text-align","center");	
    			}
            }
        ],
        "order": [ 0, 'asc' ],
		"language": {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ usuarios",
		    "sZeroRecords":    "No se encontraron usuarios",
		    "sEmptyTable":     "Ningún usuario disponible",
		    "sInfo":           "Mostrando usuarios del _START_ al _END_ de un total de _TOTAL_",
		    "sInfoEmpty":      "Mostrando usuarios del 0 al 0 de un total de 0",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ usuarios)",
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

	$('#lista_estudiantes').removeClass('display')
		.addClass('table table-striped table-bordered');

	var table = $('#lista_estudiantes').DataTable();
 
	$('#lista_estudiantes tbody tr').click(
		// function () {
  //   		//$( this ).addClass( "active" );	
  //   		document.location = table.row(this).data()[5];
		// } 
	)
	.css( 'cursor', 'pointer' )
	.hover(
  		function() {
    		$( this ).addClass( "info" );
  		},
  		function() {
    		$( this ).removeClass( "info" );
  		}
	);	
}



/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
	});
}


  $('#confirmDelete').on('show.bs.modal', function (e) {
      $message = $(e.relatedTarget).attr('data-message');
      $(this).find('.modal-body p').text($message);
      $title = $(e.relatedTarget).attr('data-title');
      $(this).find('.modal-title').text($title);

      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
  });

  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
      $(this).data('form').submit();
  });
