/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Mayo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$(document).ready(function() {
	crearDataTable();
	
	event_handlers_window();
	$('#navbar-mis-examenes').parent().addClass('active');
	$(window).resize(); // Disparo el evento para que el contenido quede centrado.
});


function crearDataTable() {
	ordenamientoFecha();

	$('#lista_examenes').dataTable({
		"columnDefs": [
            {
                "targets": [ 5,6 ],
                "visible": false,
                "searchable": false
            },
            {
            	"targets": [0],
            	"type": 'date-euro'
            },
            {
            	"targets": [4],
            	"createdCell": function (td, cellData, rowData, row, col) {
      				var newData = '';
      				switch(parseInt(cellData)) {
      					case CALIF_COMPETENCIA_NO_ADQUIRIDA:
      						newData += '<div class="icon-calif"><span class="glyphicon glyphicon-remove-sign rojo grande"></span></div>'
      						break;
      					case CALIF_COMPETENCIA_MED_ADQUIRIDA:
      						newData += '<div class="icon-calif"><span class="glyphicon glyphicon-minus-sign amarillo grande"></span></div>'
      						break;
      					case CALIF_COMPETENCIA_ADQUIRIDA: 
      						newData += '<div class="icon-calif"><span class="glyphicon glyphicon-ok-sign verde grande"></span></div>'
      						break;
      					default:
      						newData += '<div class="icon-calif"><span class="glyphicon glyphicon-question-sign grande"></span></div>'
  					}
  					newData+= '<div class="boton-pdf"><a href="'+rowData[6]+'" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-file"></span> PDF</a></div>'	
  					$(td).html(newData);
  					$(td).css("text-align","center");	
    			}
            }
        ],
        "order": [ 0, 'desc' ],
		"language": {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ exámenes",
		    "sZeroRecords":    "No se encontraron exámenes",
		    "sEmptyTable":     "Ningún examen disponible",
		    "sInfo":           "Mostrando exámenes del _START_ al _END_ de un total de _TOTAL_",
		    "sInfoEmpty":      "Mostrando exámenes del 0 al 0 de un total de 0",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ exámenes)",
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

	$('#lista_examenes').removeClass('display')
		.addClass('table table-striped table-bordered');

	var table = $('#lista_examenes').DataTable();
 
	$('#lista_examenes tbody tr').click(
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

function ordenamientoFecha() {
	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	    "date-euro-pre": function ( a ) {
	        var x;
	 
	        if ( $.trim(a) !== '' ) {
	            var frDatea = $.trim(a).split(' ');
	            var frTimea = frDatea[1].split(':');
	            var frDatea2 = frDatea[0].split('/');
	            x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
	        }
	        else {
	            x = Infinity;
	        }
	 
	        return x;
	    },
	 
	    "date-euro-asc": function ( a, b ) {
	        return a - b;
	    },
	 
	    "date-euro-desc": function ( a, b ) {
	        return b - a;
	    }
	} );

}

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
	});
}