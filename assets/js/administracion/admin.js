/*	
	AUTOR		Cardoso Virginia
	COPYRIGHT	Agosto 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_window();
	$(window).resize(); // Disparo el evento para que el contenido quede centrado.
	$('#navbar-administracion').parent().addClass('active');
});

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-botonera');
	});

}