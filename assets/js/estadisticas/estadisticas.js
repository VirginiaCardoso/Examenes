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
	divmostrar.innerHTML = "<br> Eligio al alumno LU:"+ nro + "<br>  <a id='btn-mostrar' href='"+$('body').data('site-url')+"/estadisticas/mostrar_examenes_alu/"+ nro +"' class='btn btn-primary'>Mostrar exámenes rendidos</a> ";

}


function mostrar_guia(nro){
	var divmostrar = document.getElementById("div-mostrar");
	divmostrar.innerHTML= "";
	divmostrar.innerHTML = "<br> Eligio guía id "+ nro;
	

}