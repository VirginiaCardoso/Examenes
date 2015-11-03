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
});


function crearDataTable() {
	
	  // $('#lista_alumnos').DataTable(); //datateble original
	$('#lista_alumnos').dataTable({ //datatable personalizado
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
  					 newData += '<div class="boton-eliminar"><a href="'+rowData[6]+'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><span class="glyphicon glyphicon-trash grande"></span> </a></div>';	
						newData += '</div>'; 
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

	$('#lista_alumnos').removeClass('display')
		.addClass('table table-striped table-bordered');

	var table = $('#lista_alumnos').DataTable();
 
	$('#lista_alumnos tbody tr').click(
		function () {
    		//$( this ).addClass( "active" );	
    		document.location = table.row(this).data()[5];
		} 
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