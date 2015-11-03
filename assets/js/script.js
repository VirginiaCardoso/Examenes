/*
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var ERROR_AJAX = "Ha ocurrido un error en el servidor. Por favor intente más tarde.";

var STATUS_OK = 100;
var STATUS_EMPTY_POST = 101;
var STATUS_INVALID_PARAM = 102;
var STATUS_INVALID_POST = 103;
var STATUS_REPEATED_POST = 104;
var STATUS_NO_INSERT = 105;
var STATUS_UNKNOWN_ERROR = 106;
var STATUS_REDIRECT = 108;
var STATUS_SESSION_EXPIRED = 107;

var CALIF_COMPETENCIA_NO_ADQUIRIDA = 0;
var CALIF_COMPETENCIA_MED_ADQUIRIDA =  1;
var CALIF_COMPETENCIA_ADQUIRIDA = 2;
var CALIF_VACIA = -1;

var expresiones_regulares = new Array();

$(document).ready(function(){	 				
	inicializar_expresiones_regulares();
});

function inicializar_expresiones_regulares()
{
	expresiones_regulares['fecha'] = /^(0[1-9]|[12][0-9]|3[01])[\-\/.](0[1-9]|1[012])[\-\/.](19|20)\d\d$/;
}

function calculos_visualizacion() {
	centrar_contenido_header_footer();
	calcular_altura_main_content();
}


function centrar_contenido_header_footer() {

	$('#header-texto').css('margin-top', 0)

	var header_texto = parseFloat($('#header-texto').css('height').split("px")[0]);

	var header_image = parseFloat($('#header-image').css('height').split("px")[0]);

	var header_image_padding_top = parseFloat($('#header-image').css('padding-top').split("px")[0]);

	var header_image_padding_bottom = parseFloat($('#header-image').css('padding-bottom').split("px")[0]);

	var margin_top = (header_image - header_image_padding_top - header_image_padding_bottom - header_texto) / 2;

	if(margin_top < 0) {
		margin_top = 0;
	}

	$('#header-texto').css('margin-top', margin_top);

	if($('#header-sombra').length > 0) { //si se esta mostrando la sombra del header

		$('#header-sombra').css('top', $('#header-principal').css('height'));
	}
}

function calcular_altura_main_content() {

	var wrapper = parseFloat($('.wrapper').css('height').split("px")[0]);

	var header = parseFloat($('#header-image').css('height').split("px")[0]);

	var navbar = 0;

	if($('#navbar')[0]) { //si el elemento existe (en login no existe)
		navbar = parseFloat($('#navbar').css('height').split("px")[0]);
	}

	var footer = parseFloat($('footer').css('height').split("px")[0]);

	var min_height = wrapper - header - navbar - footer;

	if(min_height < 0) {
		min_height = 0;		
	}

	$('#div-main-content').css('min-height', min_height);
}

function centrar_contenido(contenido) {

	var contenedor = parseFloat($('#div-main-content').css('minHeight').split("px")[0]);

	var contenedor_padding_top =  parseFloat($('#div-main-content').css('padding-top').split("px")[0]);

	var contenedor_padding_bottom =  parseFloat($('#div-main-content').css('padding-bottom').split("px")[0]);

	var altura_contenido = parseFloat($('#'+contenido).css('height').split("px")[0]);

	var altura_interior_contenedor = contenedor - contenedor_padding_top - contenedor_padding_bottom;

	if(altura_interior_contenedor > altura_contenido) { // si la altura interna del contenedor es mayor al contenido en el -> centrar

		var margen = (altura_interior_contenedor - altura_contenido) / 2;

		$('#'+contenido).css('marginTop', margen);
	}
	else {
		$('#'+contenido).css('marginTop', 0);
	}
}

function es_integer(valor) {
    return (valor == parseInt(valor));
}


function es_dispositivo_movil() {

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		return true;
	}
	else {
		return false;
	}
}

/*
 *	Retorna la fecha actual en formato yyyy-mm-dd
 */
function fecha_actual() {
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = ((''+day).length<2 ? '0' : '') + day + '/' +
	    ((''+month).length<2 ? '0' : '') + month + '/' +
	    d.getFullYear();

	return output;
}

function control_expresion_regular(tipo_expresion, valor)
{
	if (tipo_expresion == 'fecha') {

		if(expresiones_regulares[tipo_expresion].test(valor.toLowerCase())) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

/*
 *	Estas funciones son solo aplicables a SELECTS. 
 *	Deben ser llamadas de la forma $(selector).nombre_function(parametros)
 */

(function( $ ){
   $.fn.api_set_val = function(valor) {
	
		if(es_dispositivo_movil()) {
			this.val(valor);
		}
		else {
			this.select2('val', valor);
		}
	}; 

	$.fn.api_enable = function(habilitar) {

		if(es_dispositivo_movil()) {
			this.attr('disabled', !habilitar);
		}
		else {
			this.select2('enable', habilitar);
		}
	}; 

	$.fn.api_get_css = function(propiedad) {

		if(es_dispositivo_movil()) {
			return this.css(propiedad);
		}
		else {
			return this.select2("container").css(propiedad);
		}
	}; 

	$.fn.api_set_css = function(propiedad, valor) {

		if(es_dispositivo_movil()) {
			this.css(propiedad, valor);
		}
		else {
			this.select2("container").css(propiedad, valor);
		}
	};
})( jQuery );