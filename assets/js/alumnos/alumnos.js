$(document).ready(function () {
    //editamos datos del alumno
    $(".editar").on('click', function () {
 
        var id = $(this).attr('id_alu');
        var nombre = $("#nombre" + id).html();
        var email = $("#email" + id).html();
 
        $("<div class='edit_modal'><form name='edit' id='edit' method='post' action='http://localhost/crud_ci/crud/multi_user'>"+
            "<label>Nombre</label><input type='text' name='nombre' class='nombre' value='"+nombre+"' id='nombre' /><br/>"+
            "<input type='hidden' name='id' class='id' id='id' value="+id+">"+
            "<label>Email</label><input type='email' name='email' class='email' value='"+email+"' id='email' /><br/>"+
            "</form><div class='respuesta'></div></div>").dialog({
 
                resizable:false,
                title:'Editar Estudiante.',
                height:300,
                width:450,
                modal:true,
                buttons:{
                    
                    "Editar":function () {
                        $.ajax({
                            url : $('#edit').attr("action"),
                            type : $('#edit').attr("method"),
                            data : $('#edit').serialize(),
 
                            success:function (data) {
 
                                var obj = JSON.parse(data);
 
                                if(obj.respuesta == 'error')
                                {
                                    
                                        $(".respuesta").html(obj.nombre + '<br />' + obj.email);
                                        return false;
 
                                }else{
 
                                    $('.edit_modal').dialog("close");
 
                                    $("<div class='edit_modal'>El estudiante fué editado correctamente</div>").dialog({
 
                                        resizable:false,
                                        title:'Estudiante editado.',
                                        height:200,
                                        width:450,
                                        modal:true
 
                                    });
 
                                    setTimeout(function() {
                                        window.location.href = "http://localhost/crud_ci/crud";
                                    }, 2000);
 
                                }
 
                            }, error:function (error) {
                                $('.edit_modal').dialog("close");
                                $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                                    resizable:false,
                                    title:'Error editando!.',
                                    height:200,
                                    width:450,
                                    modal:true
                                });
                            }
 
                        });
                        return false;
                    },
                    Cancelar:function () {
                        $(this).dialog("close");
                    }
                }
            });
    });



// $(document).on("ready",inicio);

// function inicio(){
// 	mostrarDatos("");
// 	$("#buscar").keyup(function(){
// 		buscar = $("#buscar").val();
// 		mostrarDatos(buscar);
// 	});
// 	$("#btnbuscar").click(function(){
// 		mostrarDatos("");
// 	});
// 	$("#btnactualizar").click(actualizar);
// 	$("form").submit(function (event){

// 		event.preventDefault();

// 		$.ajax({
// 			url:$("form").attr("action"),
// 			type:$("form").attr("method"),
// 			data:$("form").serialize(),
// 			success:function(respuesta){
// 				alert(respuesta);
// 			}
// 		});
// 	});
// 	$("body").on("click","#listaEmpleados a",function(event){
// 		event.preventDefault();
// 		lu_alusele = $(this).attr("href");
// 		nombre_alusele = $(this).parent().parent().children("td:eq(1)").text();
// 		apellido_alusele = $(this).parent().parent().children("td:eq(2)").text();
// 		dnisele = $(this).parent().parent().children("td:eq(3)").text();
// 		telefonosele = $(this).parent().parent().children("td:eq(4)").text();
// 		emailsele = $(this).parent().parent().children("td:eq(5)").text();

// 		$("#lu_alusele").val(lu_alusele);
// 		$("#nombre_alusele").val(nombre_alusele);
// 		$("apellido_alusele").valapellido_alusele);
// 		$("#dnisele").val(dnisele);
// 		$("#telefonosele").val(telefonosele);
// 		$("#emailsele").val(emailsele);
// 	});
// 	$("body").on("click","#listaEmpleados button",function(event){
// 		lu_alusele = $(this).attr("value");
// 		eliminar(idsele);
// 	});
// }

// function mostrarDatos(valor){
// 	$.ajax({
// 		url:"http://localhost/empresa/empleados/mostrar",
// 		type:"POST",
// 		data:{buscar:valor},
// 		success:function(respuesta){
// 			//alert(respuesta);
// 			var registros = eval(respuesta);
			
// 			html ="<table class='table table-responsive table-bordered'><thead>";
//  			html +="<tr><th>#</th><th>Nombres</th><th>Apellidos</th><th>DNI</th><th>Telefono</th><th>Email</th><th>Accion</th></tr>";
// 			html +="</thead><tbody>";
// 			for (var i = 0; i < registros.length; i++) {
// 				html +="<tr><td>"+registros[i]["id_empleado"]+"</td><td>"+registros[i]["nombres_empleado"]+"</td><td>"+registros[i]["apellidos_empleado"]+"</td><td>"+registros[i]["dni_empleado"]+"</td><td>"+registros[i]["telefono_empleado"]+"</td><td>"+registros[i]["email_empleado"]+"</td><td><a href='"+registros[i]["id_empleado"]+"' class='btn btn-warning' data-toggle='modal' data-target='#myModal'>E</a> <button class='btn btn-danger' type='button' value='"+registros[i]["id_empleado"]+"'>X</button></td></tr>";
// 			};
// 			html +="</tbody></table>";
// 			$("#listaEmpleados").html(html);
// 		}
// 	});
// }

// function actualizar(){
// 	$.ajax({
// 		url:"http://localhost/empresa/empleados/actualizar",
// 		type:"POST",
// 		data:$("#form-actualizar").serialize(),
// 		success:function(respuesta){
// 			alert(respuesta);
// 			mostrarDatos("");
// 		}
// 	});
// }

// function eliminar(lu_alusele){
// 	$.ajax({
// 		url:"http://localhost/empresa/empleados/eliminar",
// 		type:"POST",
// 		data:{lu_alu:lu_alusele},
// 		success:function(respuesta){
// 			alert(respuesta);
// 			mostrarDatos("");
// 		}
// 	});
// }

