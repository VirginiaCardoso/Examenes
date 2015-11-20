/*	
	AUTOR		Cardoso Virginia
	COPYRIGHT	Noviembre 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_window();
	$(window).resize(); // Disparo el evento para que el contenido quede centrado.
	$('#navbar-estadisticas').parent().addClass('active');
});

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-botonera');
	});

}

function mostrar_alumno(nro){
	var divmostrar = document.getElementById("div-mostrar");
	divmostrar.innerHTML= "";
	divmostrar.innerHTML = "<br> Eligio al alumno LU:"+ nro;

}


function mostrar_catedra(nro){
	var divmostrar = document.getElementById("div-mostrar");
	divmostrar.innerHTML= "";
	divmostrar.innerHTML = "<br> Eligio catedra nro "+ nro;

}