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

 
function ConfirmDelete()
{
  var x = confirm("se va a eliminar un usuario, puede ocurrir un error");
  if (x)
      return true;
  else
    return false;
}
function crearDataTable() {

	  // $('#lista_usuarios').DataTable(); //datateble original
	$('#lista_usuarios').dataTable({ //datatable personalizado
		"columnDefs": [
            {
                "targets": [ 8,9,10 ],
                "visible": false,
                "searchable": false
            },
            {
            	"targets": [7],
            	"createdCell": function (td, cellData, rowData, row, col) {
      				var newData = '';
     
  					 newData += '<div class="contenedor-botones">'; 
  					 newData += '<div class="boton-modificar"><a href="'+rowData[8]+'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="bottom" title="Modificar datos" ><span class="glyphicon glyphicon-pencil grande"></span> </a></div>';
  					 newData += '<div class="boton-contrasena"><a href="'+rowData[9]+'" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="bottom" title="Modificar contraseña"><span class="glyphicon glyphicon-lock grande blanco"></span> </a></div>';	
  					 newData += '<div class="boton-eliminar"><a href="'+rowData[10]+'" Onclick="ConfirmDelete()" data-confirm="Are you sure you want to delete this item?"  class="btn btn-danger btn-xs " data-toggle="tooltip" data-placement="bottom" title="Eliminar"><span class="glyphicon glyphicon-trash grande"></span> </a></div>';	
  					 //newData += '<div class="boton-eliminar"> <button id="btn-cancelar" name="boton" class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#elimUsuario"><span class="glyphicon glyphicon-trash grande"></span></button> <div class="modal fade" id="elimUsuario" tabindex="-1" role="dialog" aria-labelledby="cGuiaLabel"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="cGuiaLabel">Eliminar Usuario</h4></div>  <div class="modal-body"> <div id="alert-warning-save" class="alert alert-warning modal-body-content">	<strong>ATENCIÓN!</strong> Usted está por eliminar un usuario.</div>   </div>    <div class="modal-footer">    <button  type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>  <a  id="btn-modal-save" href="'+rowData[10]+'" type="button" class="btn btn-primary success">Eliminar</a> </div> </div> </div></div>	';
						
  				// 	 <form id="form-eliminaru" class="form-evaluar" role="form" method="post" action="'+rowData[10]+'" > <button id="btn-eliminar" name="boton" class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#eUsuario"><span class="glyphicon glyphicon-trash grande"></span> </button>';
  				// 	 a href="'+rowData[10]+'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><span class="glyphicon glyphicon-trash grande"></span> </a></div>';	
					 // newData += '<div class="boton-eliminar"><a deleteConfirm href="'+rowData[10]+'" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delUsu" data-placement="bottom" title="Eliminar"><span class="glyphicon glyphicon-trash grande"></span> </a></div>';	
					 newData += ' </div>'; 
  					$(td).html(newData);
  					$(td).css("text-align","center");	
    			}
            }
        ],
        "order": [ 0, 'desc' ],
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

	$('#lista_usuarios').removeClass('display')
		.addClass('table table-striped table-bordered');

	var table = $('#lista_usuarios').DataTable();
 
	// $('#lista_usuarios tbody tr').click(
	// 	function () {
 //    		//$( this ).addClass( "active" );	
 //    		document.location = table.row(this).data()[8];
	// 	} 
	// )
	// .css( 'cursor', 'pointer' )
	// .hover(
 //  		function() {
 //    		$( this ).addClass( "info" );
 //  		},
 //  		function() {
 //    		$( this ).removeClass( "info" );
 //  		}
	// );	
}



/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
	});
}