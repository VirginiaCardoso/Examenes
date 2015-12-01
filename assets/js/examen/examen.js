/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	AUTOR		Cardoso Virginia
	AUTOR 		Marzullo Matias
	COPYRIGHT	Septimbre 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var mostrando_modal = false;

var ITEM_NO = 0;
var ITEM_SI = 1;
var ITEM_VACIO = -1;

var CALIF_COMPETENCIA_NO_ADQUIRIDA = 0;
var CALIF_COMPETENCIA_MED_ADQUIRIDA = 1;
var CALIF_COMPETENCIA_ADQUIRIDA = 2;

var submit_on_cancel = true;

$('document').ready(function() {

	event_handlers_nav_tabs();

	if($('#div-evaluar').data('evaluando')) {

		inicializar_modal();
		event_handlers_buttons();
		event_handlers_keyboard();
		event_handlers_radio_buttons();		
		handler_formulario();
		ocultar_errores();	
	}
	else {

		revisar_items(false);
		set_estilos_revision(true);

		$('.calificacion').show();
		$('.label-obs').show();
		$('.item-obs-container').show();
	}

	event_handlers_window();

	$(window).resize(); // Disparo el evento para que el contenido quede centado
});


/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-evaluar');
	});
}

function event_handlers_keyboard() {

	$('.observaciones, #examen-obs').keydown(function(event) {

		 var code = event.keyCode || event.which;	

		if (code == 13) //Enter keycode
		{
		    if (event.shiftKey !== true)
		    {
		         $(this).blur();
		    }		    
		}
	});
}

function event_handlers_nav_tabs() {

	$('.nav-tab-link').click(function (event) {

		if($(this).parent().hasClass('disabled'))
		{
			return false; //cancelo el evento para que la pestaña no se muestre
		}
	})
}

function event_handlers_buttons() {

	$('.boton-si').click(function(e){

		if($(this).is('.active')) {
			desactivar_boton($(this), ITEM_SI);
		}
		else {
			activar_boton($(this), ITEM_SI);
		}
	});

	$('.boton-no').click(function(e){
		if($(this).is('.active')) {
			desactivar_boton($(this), ITEM_NO);
		}
		else {
			activar_boton($(this), ITEM_NO);
		}
	});

	$('.boton-obs').click(function(e){

		$(this).parent().nextAll('.item-obs-container:first').toggle().find('.item-obs').focus();
		$(this).toggleClass('active');
	});

	$('#btn-calificar, #btn-atras').click(function(event) {

		$(window).scrollTop(0);

		$('.calificacion').toggle();
		$('.evaluacion').toggle();

		if($('.calificacion').is(':visible')) {

			set_estilos_revision(true);
			 
			revisar_items(true);

			$('.solotexto').each(function() {
				manage_observacion(true, $(this));	
			});

			manage_observacion_gral_examen(true);

		}
		else {

			set_estilos_revision(false);

			$('.item-estado').each(function() {

				$(this).parent().removeClass('bg-success').removeClass('bg-danger').removeClass('bg-no-resp');	
				manage_observacion(false, $(this).nextAll('.item-obs-container'));			
			});

			$('.solotexto').each(function() {				
				manage_observacion(false, $(this));
			});

			manage_observacion_gral_examen(false);
		}
	});

	$('#btn-cancelar, #navbar-brand, #navbar-mis-examenes, #navbar-mis-datos, #navbar-cerrar-sesion').click(function(event) {

		event.preventDefault();

		if(($(this).attr('id') == 'navbar-mis-examenes') 
			|| ($(this).attr('id') == 'navbar-mis-datos') 
			|| ($(this).attr('id') == 'navbar-cerrar-sesion')
			|| ($(this).attr('id') == 'navbar-brand'))
		{

			$('#btn-modal-abortar').attr('href', $(this).attr('href'));
			submit_on_cancel = false;
		}
		else {
			submit_on_cancel = true;
		}

		mostrar_modal('warning-exit');		
	});

	$('#btn-confirmar').click(function(event) {

		if(validar()) {
			mostrar_modal('warning-save');
		}
	});
}	

function event_handlers_radio_buttons() {
	$('.radio-texto').click(function() {
		$(this).prev().click();
	});
}

function handler_formulario() {

	$('#btn-modal-save, #btn-modal-reintentar').click(function(event) {
		event.preventDefault();

		mostrar_modal('loading-bar');

		//DEBUG////////////////////////////////////////////////////////////////////////
		//$('#form-evaluar').attr('action', $('body').data('site-url')+"/examen/archivar");
		//$('#form-evaluar').submit();
		///////////////////////////////////////////////////////////////////////////////////
		
		$.ajax({ 
				data: $('#form-evaluar').serialize(), // dato enviado en el post: codigo carrera
				type: "post",
				url: $('body').data('site-url')+"/examen/archivar", // controlador
				dataType: "json",
				timeout: 10000,

				error: function(jqXHR, textStatus, errorThrown) {
					
					var msj = 'Error de comunicación con el servidor. Intente de nuevo.';
					//DEBUG/////////////////////////////////////////////////////////
					//msj+='<br/>'+JSON.stringify(jqXHR)+' '+textStatus+' '+errorThrown;
					////////////////////////////////////////////////////////////////
					
					$("#response-error").html(msj);
					mostrar_modal('error');	

				},

				success: function(json) { 
					//var response = $.parseJSON(json);  //dataType json, ya lo parsea
					var response = json;
					if(response.ok) 
					{
						var msj = "El examen fue archivado exitosamente en la base de datos, con ID: "+response.data.id_exam+". ";
						//DEBUG//////////////////////////////
						//msj += "<br/>"+JSON.stringify(response.data);
						///////////////////////////////////
						$("#response-success").html(msj);

						$('#btn-modal-ver').attr('href', $('#btn-modal-ver').data('link')+'/'+response.data.id_exam);

						mostrar_modal('success');	
					}
					else
					{
						var status;
						switch(response.status)
						{
							case STATUS_EMPTY_POST:
								status = "<strong>ACCESO INVÁLIDO</strong>";
								break;
							case STATUS_INVALID_POST:
								status = "<strong>DATOS INVÁLIDOS</strong>";
								break;
							case STATUS_REPEATED_POST:
								status = "<strong>ACCESO REPETIDO</strong>";
								break;
							case STATUS_INVALID_PARAM:
								status = "<strong>DATOS INVÁLIDOS</strong>";
								break;
							case STATUS_NO_INSERT:
								status = "<strong>ERROR EN EL SERVIDOR- archivar examen</strong>";
								break;
								case STATUS_NO_INSERT2:
								status = "<strong>ERROR EN EL SERVIDOR- archivar items</strong>";
								break;
							case STATUS_REDIRECT:
								status = "<strong>ERROR DE ACCESO</strong>";	
								break;
							case STATUS_SESSION_EXPIRED:
								status = "<strong>SESIÓN INVALIDA</strong>"
								break;
							default:
								status = "<strong>ERROR DESCONOCIDO</strong>";
								break;
						}

						var msj = response.data.error_msj;
						//DEBUG/////////////////////////////
						//msj += "<br/>"+JSON.stringify(response.data);
						///////////////////////////////////
						$("#response-error").html(status+"<br/>"+msj);
						mostrar_modal('error');	
						if(response.status==STATUS_REPEATED_POST) //examen ya guardado, cambian los botones
						{
							$('#btn-modal-ver').attr('href', $('#btn-modal-ver').data('link')+'/'+response.data.id_exam);
							$('#btn-modal-ver').show();
							$('#btn-modal-reintentar').hide();
							$('#btn-modal-revisar').hide();
						}
						else if(response.status==STATUS_REDIRECT || response.status==STATUS_SESSION_EXPIRED)  //redireccion, solo boton inicio
						{ 
							$('.btn-modal-error').hide();
							$('#btn-modal-inicio').show();
						}
					}
								
				}
		});

	});	
}


function set_estilos_revision(agregar) {

	if(agregar) {

		$('.item-texto').addClass('item-texto-padding');
		$('.borde-item').addClass('borde-grupoitem');
		$('.item-botonera').addClass('item-value-botonera-calificar');
	}
	else {

		$('.item-texto').removeClass('item-texto-padding');
		$('.borde-item').removeClass('borde-grupoitem');
		$('.item-botonera').removeClass('item-value-botonera-calificar');
	}
}

/*
 *	Calcula el porcentaje de respuestas correctas y establece
 *	los estilos correspondientes para cada item cuando se está
 *	calificando el examen o bien cuando se accede a ver el examen
 */
function revisar_items(evaluando) {

	var rta_correctas = 0;
	var nota = 0;
	var rta_respondidas = 0;
	var pond = 0;
	var preguntas = 0;			

	if(evaluando) {			

		$('.item-estado').each(function() {
				if($(this).val() == ITEM_SI) {   // 	VAL() DA EL VALOR DEL <input value="lo que sea"> 
				rta_correctas ++;
				rta_respondidas ++;
				
				$(this).parent().addClass('bg-success');
				var p =  parseFloat($(this).next('.item-pond').val());
				pond = pond+p;
				
				manage_observacion(true, $(this).nextAll('.item-obs-container'));
			}
			else {
				if($(this).val() == ITEM_NO) {

					rta_respondidas ++;
					$(this).parent().addClass('bg-danger');	

					manage_observacion(true, $(this).nextAll('.item-obs-container'));
				}
				else {

					$(this).parent().addClass('bg-no-resp');

					manage_observacion(true, $(this).nextAll('.item-obs-container'));
				}
			}
			preguntas++;					
		});
	}

	else {
		$('.item-value').each(function() {

			if($(this).data('estado') == ITEM_SI) {
				rta_correctas ++;
				rta_respondidas ++;
				
				var p = parseFloat($(this).next('.item-pond').val());
				pond = pond+p;
				$(this).parent().parent().addClass('bg-success');
				$(this).html('sí').addClass('item-value-si');
			}
			else {
				if($(this).data('estado') == ITEM_NO) {

					rta_respondidas ++;
					$(this).parent().parent().addClass('bg-danger');	
					$(this).html('no').addClass('item-value-no');
				}
				else {

					$(this).parent().parent().addClass('bg-no-resp');
				}
			}
			preguntas++;					
		});

	}


	var porcentaje_correcto = 0;

	if(rta_respondidas > 0) {
		// porcentaje_correcto = (rta_correctas * 100) / rta_respondidas;
		porcentaje_correcto = (rta_correctas * 100) / preguntas;
		porcentaje_correcto = porcentaje_correcto.toFixed(2);
	}
	$('#porcentaje-realizado').html(rta_correctas+" de "+preguntas+" ("+ porcentaje_correcto + "% )");
	// $('#porcentaje-realizado').html(porcentaje_correcto + "%  - ("+rta_correctas+" / "+rta_respondidas+") ");
	$('#ponderacion-realizado').html(pond + "%");
	document.getElementById('examen-pond').value = pond;

 	var min_adq = document.getElementById('min-adq').value;
 	var min_med = document.getElementById('min-med-adq').value;

	if (pond<min_med){
		$('#sugerencia-calificacion').html("Competencia no adquirida");
		$('#sugerencia-calificacion').addClass('span-calificacion no-adquirida');
		document.getElementById('examen-calif').value = 0;
		//document.getElementById("calificacion0").checked = true;
	}
	else {
		if (pond<min_adq){
			$('#sugerencia-calificacion').html("Competencia medianamente adquirida");
			$('#sugerencia-calificacion').addClass('span-calificacion medianamente-adquirida');
			document.getElementById('examen-calif').value = 1;
			//document.getElementById("calificacion1").checked = true;
		}
		else {
			$('#sugerencia-calificacion').html("Competencia adquirida");	
			$('#sugerencia-calificacion').addClass('span-calificacion adquirida');
			document.getElementById('examen-calif').value = 2;
			//calificacion2
			 // document.getElementById("calificacion2").checked = true;
		}

	}

}

/*
 *	Se encarga de mostrar el textarea correspondiente
 *	a la observación general del examen o de mostrar el contenido
 *	del mismo en el label si se está calificando el examen
 *
 *	calificando: indica si se esta calificando el examen
 */
function manage_observacion_gral_examen(calificando) {

	if(calificando) {
		
		$('.examen-obs').hide();

		if($('.examen-obs').val() != '') {
			
			$('.span-examen-obs-container > span').text($('.examen-obs').val());
		}
		else {

			$('.span-examen-obs-container > span').html("&nbsp;");			
		}

		$('.span-examen-obs-container').show();
	}
	else {	

		$('.span-examen-obs-container').hide();
		$('.examen-obs').show();
	}	
}

/*
 *	Se encarga de mostrar el textarea correspondiente
 *	a la observación de un item o de mostrar el contenido
 *	del mismo en el label si se está calificando el examen
 *
 *	calificando: indica si se esta calificando el examen
 *	container: div contenedor del textarea
 */
function manage_observacion(calificando, container) {

	var observacion = container.find('.observaciones');
	var container_label_observacion = container.find('.span-item-obs-container');

	if(calificando) {
		
		if(observacion.val() != '') {
			
			container_label_observacion.find('.span-item-obs').text(observacion.val());
			container_label_observacion.show();
			observacion.hide();
			container.show();
		}
		else {
			
			container.siblings('.item-botonera').find('.boton-obs').removeClass('active'); //quito el estado activo para los botones de obs que no poseen comentarios
			container.hide();
		}
	}
	else {	
		container_label_observacion.hide();
		observacion.show();	
	}	
}

/*
 *	Se encarga de mostrar el validar el examen

 */
function validar() {

	ocultar_errores();

	// if( !$('#calificacion0').is(':checked') && 
	// 	!$('#calificacion1').is(':checked') &&
	// 	!$('#calificacion2').is(':checked'))
	// {
	// 	$('#error-radio').text('Debe seleccionar una calificación');
	// 	$('#error-radio').show();
	// 	return false;
	// }
	// else {
		
	// 	if( ($('#calificacion0').is(':checked') && ($('#calificacion0').val() != CALIF_COMPETENCIA_NO_ADQUIRIDA)) ||
	// 	    ($('#calificacion1').is(':checked') && ($('#calificacion1').val() != CALIF_COMPETENCIA_MED_ADQUIRIDA)) ||
	// 	    ($('#calificacion2').is(':checked') && ($('#calificacion2').val() != CALIF_COMPETENCIA_ADQUIRIDA)))
	// 	{
	// 		$('#error-radio').text('El valor de la opción seleccionada es inválido');
	// 		$('#error-radio').show();
	// 		return false;
	// 	}
	// }

	return true;
}

function ocultar_errores() {
	$('.errores').hide();
}

function inicializar_modal() {

	$('#modal').modal({
		backdrop: 'static',
		keyboard: 'false',
		show: false
	});

	$('#modal').on('hidden.bs.modal', function (event) {
	  mostrando_modal = false;
	});

	event_handlers_modal_buttons();
}

function event_handlers_modal_buttons() {

	$('#btn-modal-abortar').click(function(event) {

		if(submit_on_cancel)
		{
			event.preventDefault();
			$('#form-evaluar').submit();
		}
	});

	$('#btn-modal-nuevo').click(function(event) {

		event.preventDefault();

		$('#input-alumno').val('');
		$('#form-evaluar').submit();
	});
}

function activar_boton(boton, valor) {

	if(valor == ITEM_SI) {

		boton.addClass('btn-success').removeClass('btn-default');
		boton.siblings('.boton-no').removeClass('btn-danger active').addClass('btn-default');
		var parent = boton.parent();
		parent.parent().siblings('.item-estado').val(ITEM_SI);	
		parent.siblings('span.item-value').html('sí').removeClass('item-value-no').addClass('item-value-si');	
	}
	else {

		boton.addClass('btn-danger').removeClass('btn-default');
		boton.siblings('.boton-si').removeClass('btn-success active').addClass('btn-default');
		var parent = boton.parent();
		parent.parent().siblings('.item-estado').val(ITEM_NO);
		parent.siblings('span.item-value').html('no').removeClass('item-value-si').addClass('item-value-no');
	}
}

function desactivar_boton(boton,valor) {

	if(valor == ITEM_SI) {
		boton.removeClass('btn-success').addClass('btn-default');
	}
	else {
		boton.removeClass('btn-danger').addClass('btn-default');	
	}
	var parent = boton.parent();
	parent.parent().siblings('.item-estado').val(ITEM_VACIO);
	parent.siblings('span.item-value').html('-').removeClass('item-value-si').removeClass('item-value-no');
}

function mostrar_modal(mensaje) {

	switch(mensaje)
	{
		case 'warning-exit': 
						$('#modal-titulo').html("Abortar Examen");
						$('#alert-warning-save').hide();
						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();

						$('#alert-warning-exit').show();
						$('.btn-modal-warning').show();
						break;

		case 'warning-save': 
						$('#modal-titulo').html("Guardar Examen");
						$('#alert-warning-exit').hide();
						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();

						$('#progressbar').hide();

						$('.btn-modal-warning').hide();

						$('#btn-modal-cancelar').show();
						$('#btn-modal-save').show();
						$('#alert-warning-save').show();
						
						break;

		case 'success':
						$('#modal-titulo').html("Examen guardado correctamente");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();
						$('#alert-success').show();
						$('.btn-modal-success').show();	

						break;
		case 'error':
						$('#modal-titulo').html("ERROR");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();

						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').show();
						$('.btn-modal-error').show();					
						break;
		
		case 'loading-bar':
						$('#modal-titulo').html("Guardar Examen");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();
						
						$('#btn-modal-save').hide();

						$('#progressbar').show();
						break;
		default:
						$('#modal-titulo').html("");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#alert-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-success').hide();
						$('.btn-modal-error').hide();

						$('#btn-modal-save').hide();
							
						$('#progressbar').hide();
						break;

	}

	// permite llamar a esta funcion dos veces evitando que existan multiples backdrops
	if(!mostrando_modal) {  
		$('#modal').modal('show');
		mostrando_modal = true;
	}
}