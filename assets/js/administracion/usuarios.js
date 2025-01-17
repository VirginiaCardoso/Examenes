/*	
	AUTOR		Cardoso Virginia
	AUTOR		Marzullo Matias
	COPYRIGHT	Julio, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var NO_SELECTED = "";
var mostrando_modal = false;
var submit_on_cancel = true;

$('document').ready(function()
 {
	//event_handlers_nav_tabs();

	if(es_dispositivo_movil()) {
		NO_SELECTED = -1;
	}
	
	// inicializar_selects();
	// inicializar_datepicker();
	event_handlers_window();
	// event_handlers_formulario();



	// inicializar_modal();
	// event_handlers_buttons();
	// event_handlers_keyboard();
	// event_handlers_radio_buttons();		
	// handler_formulario();
	ocultar_errores();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.

	
});

// function inicializar_datepicker() {

// 	$('#container-fecha').datetimepicker({
// 		language: 'es',
// 		pickTime: false
// 	});

// 	//$('#container-fecha').data("DateTimePicker").setDate(fecha_actual());
// }

// function inicializar_selects() {

// 	if(es_dispositivo_movil()) {
// 	 	$('select').addClass('select-mobile');

// 	 	$('#select-carrera').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione una Carrera</option>');
// 	 	$('#select-catedra').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione un Cátedra</option>');
// 	 	$('#select-guia').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione una Guía</option>');
// 	 	$('#select-alumno').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione un Alumno</option>');

// 	 	if($('#select-guia').data('selected') == NO_SELECTED) {
// 	 		$('#select-guia').val(NO_SELECTED);
// 	 	}

// 	 	if($('#select-alumno').data('selected') == NO_SELECTED) {
// 	 		$('#select-alumno').val(NO_SELECTED);
// 	 	}
// 	}
// 	else {

// 		$('#select-carrera, #select-catedra').prepend('<option></option>');		

// 		if($('#select-guia').data('selected') == -1) {
// 			$('#select-guia').prepend('<option selected="selected"></option>');
// 		}
// 		else {
// 			$('#select-guia').prepend('<option></option>');
// 		}
		
// 		if($('#select-alumno').data('selected') == -1) {
// 			$('#select-alumno').prepend('<option selected="selected"></option>');
// 		}
// 		else {
// 			$('#select-alumno').prepend('<option></option>');
// 		}

// 		//Inicialización gráfica de los selects personalizados
// 		inicializar_select('select-carrera', 'Seleccione una Carrera');
// 		inicializar_select('select-catedra', 'Seleccione una Cátedra');
// 		inicializar_select('select-guia', 'Seleccione una Guía');
// 		inicializar_select('select-alumno', 'Seleccione un Alumno');
// 	}

// 	ajustar_ancho_selects();
// 	event_handlers_selects();	
// }

// function inicializar_select(id_select, placeholder) {
// 	$('#'+id_select).select2({
// 		placeholder: placeholder,
// 		containerCssClass: 'select',
// 		width: 'element'
// 	});
// }

/*
 *	Establece el ancho de todos los selects en el rango MAX(250px, MIN(600px, 80% #div-main-content))
 */
function ajustar_ancho_selects() {

	var ancho_main_content = new Array();

	ancho_main_content[0] = parseFloat($("#div-main-content").css("width").split("px")[0]);
	ancho_main_content[1] = parseFloat($("#div-main-content").css("paddingLeft").split("px")[0]) + parseFloat($("#div-main-content").css("paddingRight").split("px")[0]);
	ancho_main_content[2] = parseFloat($("#div-main-content").css("border-left-width").split("px")[0]) + parseFloat($("#div-main-content").css("border-right-width").split("px")[0]);

	var ancho_control = (ancho_main_content[0] - ancho_main_content[1] - ancho_main_content[2]) * 0.8; // 80% del #div-main-content (ancho interior = ancho total - paddings - bordes)

	// $("#legajo").api_set_css("width", ancho_control);
	$("#select-catedra").api_set_css("width", ancho_control);
	// $("#select-guia").api_set_css("width", ancho_control);
	// $("#select-alumno").api_set_css("width", ancho_control);

	$(".form-group-generar-fecha").css("width", ancho_control);
	// $(".form-control").css("width", ancho_control);

	$('#div-form').css('maxWidth', $("#select-carrera").api_get_css("width"));
}

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-nuevousuario');
		ajustar_ancho_selects();
	});
}

// function event_handlers_selects() {

// 	//Actualizar select catedras al seleccionar carrera
// 	$('#select-carrera').change(function(event) {

// 		event.preventDefault();

// 		if($(this).val() != NO_SELECTED && $(this).val() != null) {

// 			$('#select-catedra').api_set_val(NO_SELECTED);
// 			$('#select-catedra').api_enable(false);
// 			$('#select-guia').api_enable(false);
// 			$('#select-alumno').api_enable(false);

// 			$.ajax({ 
// 					data: {carrera: $(this).val()}, // dato enviado en el post: codigo carrera
// 					type: "post",
// 					url: $('body').data('site-url')+"/examen/get_catedras", // controlador

// 					error: function() {
// 						 alert(ERROR_AJAX);
// 					},

// 					success: function(json) { 		

// 						var catedras = $.parseJSON(json);	

// 						if(catedras.ok) {

// 							var catedra = null;

// 							$('#select-catedra').find('option').remove();

// 							if(es_dispositivo_movil()) {

// 							 	$('#select-catedra').append('<option value="'+NO_SELECTED+'" disabled>Seleccione una Cátedra</option>');
// 							}
// 							else {

// 								$('#select-catedra').append('<option></option>');
// 							}					
							

// 							for(var i = 0 ; i < catedras.data.length; i++) {
// 								catedra = catedras.data[i];
// 								$('#select-catedra').append('<option value="'+catedra.cod_cat+'">'+catedra.cod_cat+' - '+catedra.nom_cat+'</option>');
// 							}

// 							$('#select-catedra').api_enable(true);				

// 							$('#select-catedra').api_set_val(catedras.data[0].cod_cat);
// 							$('#select-catedra').change();
// 						}
// 						else {

// 							switch(catedras.status)
// 							{
// 								case STATUS_INVALID_PARAM:
// 									alert("Carrera seleccionada inválida");
// 									break;
// 								case STATUS_EMPTY_POST:
// 									alert("Comunicación inválida con el servidor. Vuelva atrás e intente de nuevo");
// 									break;
// 								case STATUS_REDIRECT:
// 									alert("Error de acceso. Vuelva atrás e intente de nuevo");	
// 									break;
// 								case STATUS_SESSION_EXPIRED:
// 									alert("La sesión ha caducado. Vuelva a iniciar sesión");
// 									break;
// 								default:
// 									alert("Error desconocido. Vuelva atrás e intente de nuevo");
// 									break;
// 							}

							
// 						}
// 					}
// 			});
// 		}
// 		else {
// 			alert("No seleccionó una carrera");
// 		}
// 	});
	
// 	//Actualizar select guias y estudiantes al seleccionar catedra
// 	$('#select-catedra').change(function(event) {
// 		event.preventDefault();

// 		if($(this).val() != NO_SELECTED && $(this).val() != null) {

// 			$('#select-guia').api_enable(false);
// 			$('#select-alumno').api_enable(false);

// 			$.ajax({ 
// 					data: {catedra: $(this).val()}, // dato enviado en el post: codigo catedra
// 					type: "post", 
// 					url: $('body').data('site-url')+"/examen/get_guias_estudiantes", // controlador

// 					error: function() {
// 						 alert(ERROR_AJAX);
// 					},

// 					success: function(json) { 

// 						var guias_estudiantes = $.parseJSON(json);	

// 						if(guias_estudiantes.ok) {

// 							var guias = guias_estudiantes.data.guias;
// 							var estudiantes = guias_estudiantes.data.estudiantes;

// 							var guia = null;
// 							var alumno = null;

// 							$('#select-guia').find('option').remove();		
// 							$('#select-alumno').find('option').remove();					

// 							if(es_dispositivo_movil()) {

// 							 	$('#select-guia').append('<option value="'+NO_SELECTED+'" disabled>Seleccione una Guía</option>');
// 							 	$('#select-alumno').append('<option value="'+NO_SELECTED+'" disabled>Seleccione un Alumno</option>');
// 							}
// 							else {
// 								$('#select-guia, #select-alumno').prepend('<option></option>');
// 							}

// 							for(var i = 0 ; i < guias.length; i++) {

// 								guia = guias[i];
// 								$('#select-guia').append('<option value="'+guia.id_guia+'">'+guia.nro_guia+' - '+guia.tit_guia+'</option>');
// 							}

// 							for(var i = 0 ; i < estudiantes.length; i++) {

// 								alumno = estudiantes[i];
// 								$('#select-alumno').append('<option value="'+alumno.lu_alu+'">'+alumno.lu_alu+' - '+alumno.apellido_alu+', '+alumno.nom_alu+'</option>');
// 							}

// 							$('#select-guia').api_set_val($('#select-guia > option:first').val());
// 							$('#select-alumno').api_set_val($('#select-alumno > option:first').val());

// 							$('#select-guia').api_enable(true);
// 							$('#select-alumno').api_enable(true);
// 						}
// 						else {
// 							switch(catedras.status)
// 							{
// 								case STATUS_EMPTY_POST:
// 									alert("Comunicación inválida con el servidor. Vuelva atrás e intente de nuevo");
// 									break;
// 								case STATUS_REDIRECT:
// 									alert("Error de acceso. Vuelva atrás e intente de nuevo");	
// 									break;
// 								case STATUS_SESSION_EXPIRED:
// 									alert("La sesión ha caducado. Vuelva a iniciar sesión");
// 									break;
// 								default:
// 									alert("Error desconocido. Vuelva atrás e intente de nuevo");
// 									break;
// 							}
// 						}
// 					}
// 			});
// 		}
// 	});
// }

// function event_handlers_formulario() {

// 	ocultar_errores();

// 	$('#form-generar').submit(function(event) {	

// 		ocultar_errores();
// 		$('#error-server').hide();	

// 		if(!validar()) { 
// 			event.preventDefault();
// 		}
// 	});
// }

// function validar() {

// 	var validacion_general = true;

// 	if($('#select-carrera').val() == NO_SELECTED || $('#select-carrera').val() == null) {
// 		validacion_general = false;
// 		$('#error-carrera').show();
// 	}

// 	if($('#select-catedra').val() == NO_SELECTED || $('#select-catedra').val() == null) {
// 		validacion_general = false;
// 		$('#error-catedra').show();
// 	}

// 	if($('#select-guia').val() == NO_SELECTED || $('#select-guia').val() == null) {
// 		validacion_general = false;
// 		$('#error-guia').show();
// 	}

// 	if($('#select-alumno').val() == NO_SELECTED || $('#select-alumno').val() == null) {
// 		validacion_general = false;
// 		$('#error-alumno').show();
// 	}

// 	if($('#fecha').val() == '' || !control_expresion_regular('fecha', $('#fecha').val())) {
// 		validacion_general = false;
// 		$('#error-fecha').show();
// 	}
// 	else {
// 		$('#fecha').attr('disabled', false);
// 	}

// 	return validacion_general;

// }

function ocultar_errores() {
	$('.errores').hide();
}