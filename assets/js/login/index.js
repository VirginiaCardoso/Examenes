/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_form();
	event_handlers_window();

	$('#error').hide();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.

	$('#input-legajo').focus();

});

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-form');
	});
}

function event_handlers_form() {
	
	$('#form').submit(function(event) {

		 ocultar_errores();

		if(!validar()) {

			event.preventDefault();
			$('#error').show();
		}
	});
}

function validar() {

	if( $('#input-legajo').val() == "" || !es_integer($('#input-legajo').val()) || $('#input-password').val() == "") {

		if($('#input-legajo').val() == "" || $('#input-password').val() == "")
		{
			$('#error').text('Debe completar los campos.');
		}
		else
		{
			if(!es_integer($('#input-legajo').val()))
			{
				$('#error').text('Legajo o contraseña incorrectos.');
			}
		}

		return false;
	}
	
	return true;
}

function ocultar_errores() {

	$('.errores').hide();
}