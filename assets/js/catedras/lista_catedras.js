/*	
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Agosto, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$(document).ready(function() {
	crearDataTable();
	
	event_handlers_window();
	$('#navbar-administracion').parent().addClass('active');
	$('[data-toggle="tooltip"]').tooltip();
	$(window).resize(); // Disparo el evento para que el contenido quede centrado.
});


function crearDataTable() {
	

	$('#lista_catedras').dataTable({
		"columnDefs": [
            {
                "targets": [ 4,5,6,7 ],
                "visible": false,
                "searchable": false
            },
            {
            	"targets": [3],
            	"createdCell": function (td, cellData, rowData, row, col) {
      				var newData = '';
     
  						newData += '<div class="contenedor-botones">'; 
  					 newData += '<div class="boton-modificar"><a href="'+rowData[4]+'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="bottom" title="Estudiantes" ><span class="glyphicon glyphicon-list-alt grande"></span> </a></div>';		
  					 newData += '<div class="boton-modificar"><a href="'+rowData[5]+'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="Vincular Docentes" ><span class="glyphicon glyphicon-user grande"></span> </a></div>';		
  					 newData += '<div class="boton-modificar"><a href="'+rowData[6]+'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Modificar datos" ><span class="glyphicon glyphicon-edit grande"></span> </a></div>';	
  					 newData += '<div class="boton-modificar"><a href="'+rowData[7]+'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Eliminar" ><span class="glyphicon glyphicon-trash grande"></span> </a></div>';	
						newData += '</div>'; 
  					$(td).html(newData);
  					$(td).css("text-align","center");	
    			}
            }
        ],
        "order": [ 0, 'desc' ],
		"language": {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ cátedras",
		    "sZeroRecords":    "No se encontraron cátedras",
		    "sEmptyTable":     "Ningúna cátedra disponible",
		    "sInfo":           "Mostrando cátedras del _START_ al _END_ de un total de _TOTAL_",
		    "sInfoEmpty":      "Mostrando cátedras del 0 al 0 de un total de 0",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ cátedras)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar: ",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primera",
		        "sLast":     "Última",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
	});

	$('#lista_catedras').removeClass('display')
		.addClass('table table-striped table-bordered');

	var table = $('#lista_catedras').DataTable();
 
	$('#lista_catedras tbody tr').click(
		function () {
    		//$( this ).addClass( "active" );	
    		document.location = table.row(this).data()[6];
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

// function ordenamientoFecha() {
// 	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
// 	    "date-euro-pre": function ( a ) {
// 	        var x;
	 
// 	        if ( $.trim(a) !== '' ) {
// 	            var frDatea = $.trim(a).split(' ');
// 	            var frTimea = frDatea[1].split(':');
// 	            var frDatea2 = frDatea[0].split('/');
// 	            x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
// 	        }
// 	        else {
// 	            x = Infinity;
// 	        }
	 
// 	        return x;
// 	    },
	 
// 	    "date-euro-asc": function ( a, b ) {
// 	        return a - b;
// 	    },
	 
// 	    "date-euro-desc": function ( a, b ) {
// 	        return b - a;
// 	    }
// 	} );

// }

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
	});
}