
/*  
    AUTOR       Cardoso Virginia
    AUTOR       Marzullo Matias
    COPYRIGHT   Septiembre 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var NO_SELECTED = "";
var mostrando_modal = false;
var submit_on_cancel = true;

var nroItems = 0;
var posicItems =0;
var ingresandoGrupo= false;
var nroGrupo=0;
var contItemsGrupo=0;


$(document).ready(function() {
    crearDataTable();
   //  if(es_dispositivo_movil()) {
   //  NO_SELECTED = -1;
   // }
    event_handlers_window();
    $('#navbar-administracion').parent().addClass('active');

    $('[data-toggle="tooltip"]').tooltip();

    $(window).resize(); // Disparo el evento para que el contenido quede centrado.

    //------------------
    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#lista_items_guia tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#lista_items_guia tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                var td = $("<td></td>", {
                    'text': $('#lista_items_guia tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#lista_items_guia'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
});




    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");

});


function crearDataTable() {
    
  //   $('#lista_items_guia').dataTable({ //datatable personalizado
  //   "columnDefs": [
  //           {
  //               "targets": [ 0 ],
  //               "className": "colEliminar"
  //           }
  //       ],
  //       "order": [ 0, 'desc' ]
  // });
  // $('#lista_items_guia').removeClass('display')
  //        .addClass('table table-striped table-bordered');

  //   var table = $('#lista_items_guia').DataTable();
 
    // $('#lista_items_guia tbody tr').click(
    //     function () {
    //         //$( this ).addClass( "active" );   
    //         document.location = table.row(this).data()[8];
    //     } 
    // )
    // .css( 'cursor', 'pointer' )
    // .hover(
    //     function() {
    //         $( this ).addClass( "info" );
    //     },
    //     function() {
    //         $( this ).removeClass( "info" );
    //     }
    // );  
}



/*  EVENT HANDLERS */

function event_handlers_window() {

    $(window).resize(function() {
        calculos_visualizacion();
    });
}


function addRow(tableID) {

               var table = document.getElementById(tableID);

               var rowCount = table.rows.length;

               var row = table.insertRow(rowCount);

               var text =  document.getElementById("item");

                var cell0 = row.insertCell(0);
               //cell0.innerHTML = rowCount;
               nroItems++;
               posicItems++;
               cell0.innerHTML = nroItems;

               var cell1 = row.insertCell(1);
               cell1.innerHTML = text.value;


               var ponderacion = document.getElementById("pond_item1");
               var cell2 = row.insertCell(2);
               cell2.innerHTML = ponderacion.value;

                var cell3 = row.insertCell(3);
                cell3.innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+rowCount+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

                var formulario = document.getElementById("form-crear-guia");

                var x = document.createElement("INPUT");
                x.setAttribute("type", "hidden"); 
                x.name="item-tipo[]";
                x.id ="input-tipo-"+rowCount;
                x.value="item-nuevo";
                formulario.appendChild(x);

                var y = document.createElement("INPUT");
                y.setAttribute("type", "hidden"); 
                y.name="item-id[]";
                y.id ="input-id-"+rowCount;
                y.value="0";
                formulario.appendChild(y);

                var z = document.createElement("INPUT");
                z.setAttribute("type", "hidden"); 
                z.name="item-texto[]";
                z.id ="input-texto-"+rowCount;
                z.value=text.value;
                formulario.appendChild(z);

                var w = document.createElement("INPUT");
                w.setAttribute("type", "hidden"); 
                w.name="item-pond[]";
                w.id ="input-pond-"+rowCount;
                w.value=cell2.innerHTML;
                formulario.appendChild(w);

                var a = document.createElement("INPUT");
                a.setAttribute("type", "hidden"); 
                a.name="item-posic[]";
                a.id ="input-posic-"+rowCount;
                a.value=posicItems;
                formulario.appendChild(a);

                var b = document.createElement("INPUT");
                b.setAttribute("type", "hidden"); 
                b.name="item-nro[]";
                b.id ="input-nro-"+rowCount;
                b.value=nroItems; 
                formulario.appendChild(b);

                var g = document.createElement("INPUT");
                g.setAttribute("type", "hidden"); 
                g.name="item-grupo[]";
                g.id ="input-grupo-"+rowCount;
                g.value=0; 
                formulario.appendChild(g);


                text.value= "";
                text.placeholder = "Ingrese texto del item";
                ponderacion.value= "";
                ponderacion.placeholder = " % ";



}

function addRow2(tableID) {

               var table = document.getElementById(tableID);

               var rowCount = table.rows.length;

               var row = table.insertRow(rowCount);

                var cell0 = row.insertCell(0);
               // cell0.innerHTML = rowCount;
               nroItems++;
               posicItems++;
               cell0.innerHTML = nroItems;

                var select = document.getElementById("select-item");
               var cell1 = row.insertCell(1);
               cell1.innerHTML = select.options[select.selectedIndex].text;

               var ponderacion = document.getElementById("pond_item2");
               var cell2 = row.insertCell(2);
               cell2.innerHTML = ponderacion.value;

               var cell3 = row.insertCell(3);
                cell3.innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+rowCount+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

                var formulario = document.getElementById("form-crear-guia");

                // var x = document.createElement("INPUT");
                // x.setAttribute("type", "hidden"); 
                // x.name="item-id[]";
                // x.id ="input-item-"+select.value;
                // x.value=select.value;
                // formulario.appendChild(x);

                var x = document.createElement("INPUT");
                x.setAttribute("type", "hidden"); 
                x.name="item-tipo[]";
                x.id ="input-tipo-"+rowCount;
                x.value="item-bd";
                formulario.appendChild(x);

                var y = document.createElement("INPUT");
                y.setAttribute("type", "hidden"); 
                y.name="item-id[]";
                y.id ="input-id-"+rowCount;
                y.value=select.value;
                formulario.appendChild(y);

                var z = document.createElement("INPUT");
                z.setAttribute("type", "hidden"); 
                z.name="item-texto[]";
                z.id ="input-texto-"+rowCount;
                z.value=select.options[select.selectedIndex].text;
                formulario.appendChild(z);

                var w = document.createElement("INPUT");
                w.setAttribute("type", "hidden"); 
                w.name="item-pond[]";
                w.id ="input-pond-"+rowCount;
                w.value=cell2.innerHTML;
                formulario.appendChild(w);

                var a = document.createElement("INPUT");
                a.setAttribute("type", "hidden"); 
                a.name="item-posic[]";
                a.id ="input-posic-"+rowCount;
                a.value=posicItems; 
                formulario.appendChild(a);

                var b = document.createElement("INPUT");
                b.setAttribute("type", "hidden"); 
                b.name="item-nro[]";
                b.id ="input-nro-"+rowCount;
                b.value=nroItems; 
                formulario.appendChild(b);

                var g = document.createElement("INPUT");
                g.setAttribute("type", "hidden"); 
                g.name="item-grupo[]";
                g.id ="input-grupo-"+rowCount;
                g.value=0; 
                formulario.appendChild(g);

                ponderacion.value= "";
                ponderacion.placeholder = " % ";

                // <input type='hidden' name='item-id[]' id='input-item-{$item['id']}' value='{$item['id']}'/>

}

function delRow(nroFila) {
     nroItems--;
     posicItems--;
     var table = document.getElementById('lista_items_guia');
     table.deleteRow(nroFila); //elimino la fila de la tabla

     //elimino los input de esa fila
     var inputtipo = document.getElementById("input-tipo-"+nroFila);
     inputtipo.parentNode.removeChild(inputtipo);
     var inputid = document.getElementById("input-id-"+nroFila);
     inputid.parentNode.removeChild(inputid);
     var inputtexto = document.getElementById("input-texto-"+nroFila);
     inputtexto.parentNode.removeChild(inputtexto);
     var inputpond = document.getElementById("input-pond-"+nroFila);
     inputpond.parentNode.removeChild(inputpond);
     var inputposic = document.getElementById("input-posic-"+nroFila);
     inputposic.parentNode.removeChild(inputposic);
     var inputnro = document.getElementById("input-nro-"+nroFila);
     inputnro.parentNode.removeChild(inputnro);
     var inputgrupo = document.getElementById("input-grupo-"+nroFila);
     inputgrupo.parentNode.removeChild(inputgrupo);

     //actualizar nro item

     var rowCount = table.rows.length;
    for (i = nroFila; i < rowCount; i++) {
        // document.getElementById("myTable").rows[0].cells[0].innerHTML ="hi";
        // if(i!=0){
            
            table.rows[i].cells[3].innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+i+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

           // n=i+1;
            var inputtipo3 = document.getElementById("input-tipo-"+i);
            if ((inputtipo3.value=="item-grupo-nuevo") || (inputtipo3.value=="item-grupo-bd")  ){
                var elem = table.rows[i].cells[0].innerHTML.split(' - ');
                nrog = elem[0];
                nroi = elem[1];
                nrog--;
                table.rows[i].cells[0].innerHTML =  nrog+" - "+nroi;

            }
            else {
              table.rows[i].cells[0].innerHTML =  table.rows[i].cells[0].innerHTML-1;
            }
     
          // }
    }

    //actualizar nombre de los input hiden
    for (j=nroFila+1; j<=rowCount; j++){
      k=j-1;
      var inputtipo2 = document.getElementById("input-tipo-"+j);
      inputtipo2.id="input-tipo-"+k;
        
      var inputid2 = document.getElementById("input-id-"+j);
      inputid2.id="input-id-"+k;
    
      var inputtexto2 = document.getElementById("input-texto-"+j);
      inputtexto2.id="input-texto-"+k;

       var inputpond2 = document.getElementById("input-pond-"+j);
      inputpond2.id="input-pond-"+k;

      var inputposic2 = document.getElementById("input-posic-"+j);
      inputposic2.id="input-posic-"+k;
      inputposic2.value = inputposic2.value-1;

      var inputnro2 = document.getElementById("input-nro-"+j);
      inputnro2.id="input-nro-"+k;
      inputnro2.value=inputnro2.value-1;     

      var inputgrupo2 = document.getElementById("input-grupo-"+j);
      inputgrupo2.id="input-grupo-"+k;
    }
  }

    function clicGrupo(){
      ingresandoGrupo = true;
      document.getElementById("div_grupo").style.visibility = "visible"; 
      document.getElementById("div_items").style.visibility = "hidden";
       }


    function clicItem(){
      ingresandoGrupo =false;
      document.getElementById("div_grupo").style.visibility = "hidden"; 
      document.getElementById("div_items_grupo").style.visibility = "hidden";
      document.getElementById("div_items").style.visibility = "visible";

    }

    function addTitulo() {
     var table = document.getElementById('lista_items_guia');
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
     var text =  document.getElementById("input-tit-grupo");

     var cell0 = row.insertCell(0);
     // cell0.innerHTML = rowCount;
     nroItems++;
     cell0.innerHTML = nroItems;

     // nroGrupo = rowCount;
     nroGrupo = nroItems;
     contItemsGrupo = 0;

     var cell1 = row.insertCell(1);
     cell1.innerHTML = text.value;

     //ponderacion 0 para grupo
      var cell2 = row.insertCell(2);
     cell2.innerHTML = 0;

      var cell3 = row.insertCell(3);
     // cell3.innerHTML =" ";
       cell3.innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+rowCount+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

      var formulario = document.getElementById("form-crear-guia");

      var x = document.createElement("INPUT");
      x.setAttribute("type", "hidden"); 
      x.name="item-tipo[]";
      x.id ="input-tipo-"+rowCount;
      x.value="titulo-grupo-nuevo";
      formulario.appendChild(x);

      var y = document.createElement("INPUT");
      y.setAttribute("type", "hidden"); 
      y.name="item-id[]";
      y.id ="input-id-"+rowCount;
      y.value="0";
      formulario.appendChild(y);

      var z = document.createElement("INPUT");
      z.setAttribute("type", "hidden"); 
      z.name="item-texto[]";
      z.id ="input-texto-"+rowCount;
      z.value=text.value;
      formulario.appendChild(z);

      var w = document.createElement("INPUT");
      w.setAttribute("type", "hidden"); 
      w.name="item-pond[]";
      w.id ="input-pond-"+rowCount;
      w.value=cell2.innerHTML;
      formulario.appendChild(w);

      var a = document.createElement("INPUT");
      a.setAttribute("type", "hidden"); 
      a.name="item-posic[]";
      a.id ="input-posic-"+rowCount;
      a.value=0; 
      formulario.appendChild(a);

      var b = document.createElement("INPUT");
      b.setAttribute("type", "hidden"); 
      b.name="item-nro[]";
      b.id ="input-nro-"+rowCount;
      b.value=nroItems; 
      formulario.appendChild(b);

      var g = document.createElement("INPUT");
      g.setAttribute("type", "hidden"); 
      g.name="item-grupo[]";
      g.id ="input-grupo-"+rowCount;
      g.value= nroGrupo; 
      formulario.appendChild(g);

      text.value= "";
      text.placeholder = "Ingrese titulo para el grupo";

              
      document.getElementById("div_grupo").style.visibility = "hidden"; 

      document.getElementById('nro_grupo').innerHTML="";
      document.getElementById('nro_grupo').innerHTML=cell0.innerHTML;
      document.getElementById("div_items_grupo").style.visibility = "visible"; 

}

function addItemGrupo1(){

  // var nroGrupo = document.getElementById('nro_grupo').innerHTML;

  var table = document.getElementById('lista_items_guia');

  var rowCount = table.rows.length;

  var row = table.insertRow(rowCount);

  var text =  document.getElementById("item_grupo");

  var cell0 = row.insertCell(0);
  //cell0.innerHTML = rowCount;
  //contItems++;
  posicItems++;
  contItemsGrupo++;
  cell0.innerHTML = nroGrupo + " - "+ contItemsGrupo;

  var cell1 = row.insertCell(1);
  cell1.innerHTML = text.value;

  var ponderacion = document.getElementById("pond_item1_grupo");
  var cell2 = row.insertCell(2);
  cell2.innerHTML = ponderacion.value;

  var cell3 = row.insertCell(3);
  cell3.innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+rowCount+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

  var formulario = document.getElementById("form-crear-guia");

  var x = document.createElement("INPUT");
  x.setAttribute("type", "hidden"); 
  x.name="item-tipo[]";
  x.id ="input-tipo-"+rowCount;
  x.value="item-grupo-nuevo";
  formulario.appendChild(x);

  var y = document.createElement("INPUT");
  y.setAttribute("type", "hidden"); 
  y.name="item-id[]";
  y.id ="input-id-"+rowCount;
  y.value="0";
  formulario.appendChild(y);

  var z = document.createElement("INPUT");
  z.setAttribute("type", "hidden"); 
  z.name="item-texto[]";
  z.id ="input-texto-"+rowCount;
  z.value=text.value;
  formulario.appendChild(z);

  var w = document.createElement("INPUT");
  w.setAttribute("type", "hidden"); 
  w.name="item-pond[]";
  w.id ="input-pond-"+rowCount;
  w.value=cell2.innerHTML;
  formulario.appendChild(w);

  var a = document.createElement("INPUT");
  a.setAttribute("type", "hidden"); 
  a.name="item-posic[]";
  a.id ="input-posic-"+rowCount;
  a.value=posicItems; 
  formulario.appendChild(a);

  var b = document.createElement("INPUT");
  b.setAttribute("type", "hidden"); 
  b.name="item-nro[]";
  b.id ="input-nro-"+rowCount;
  b.value=contItemsGrupo;//cell0.innerHTML; 
  formulario.appendChild(b);

  var g = document.createElement("INPUT");
  g.setAttribute("type", "hidden"); 
  g.name="item-grupo[]";
  g.id ="input-grupo-"+rowCount;
  g.value= nroGrupo; 
  formulario.appendChild(g);

  text.value= "";
  text.placeholder = "Ingrese texto del item";
  ponderacion.value= "";
  ponderacion.placeholder = " % ";

}

function addItemGrupo2(){

  // var nroGrupo = document.getElementById('nro_grupo').innerHTML;

  var table = document.getElementById('lista_items_guia');

  var rowCount = table.rows.length;

  var row = table.insertRow(rowCount);

  // var text =  document.getElementById("item_grupo");
  var cell0 = row.insertCell(0);
  //cell0.innerHTML = rowCount;
  //contItems++;
  posicItems++;
  contItemsGrupo++;
  cell0.innerHTML = nroGrupo + " - "+ contItemsGrupo;

  var select = document.getElementById("select-item-grupo");
  var cell1 = row.insertCell(1);
  cell1.innerHTML = select.options[select.selectedIndex].text;
  // var cell1 = row.insertCell(1);
  // cell1.innerHTML = text.value;

  var ponderacion = document.getElementById("pond_item2_grupo");
  var cell2 = row.insertCell(2);
  cell2.innerHTML = ponderacion.value;

  var cell3 = row.insertCell(3);
  cell3.innerHTML = "<div class='boton-eliminar'><a class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='bottom' title='Eliminar'  onclick='delRow("+rowCount+");'><span class='glyphicon glyphicon-trash grande'></span> </a></div>";

   var formulario = document.getElementById("form-crear-guia");

  var x = document.createElement("INPUT");
  x.setAttribute("type", "hidden"); 
  x.name="item-tipo[]";
  x.id ="input-tipo-"+rowCount;
  x.value="item-grupo-bd";
  formulario.appendChild(x);

  var y = document.createElement("INPUT");
  y.setAttribute("type", "hidden"); 
  y.name="item-id[]";
  y.id ="input-id-"+rowCount;
  y.value=select.value;
  formulario.appendChild(y);


  var z = document.createElement("INPUT");
  z.setAttribute("type", "hidden"); 
  z.name="item-texto[]";
  z.id ="input-texto-"+rowCount;
  z.value=cell1.innerHTML;
  formulario.appendChild(z);

  var w = document.createElement("INPUT");
  w.setAttribute("type", "hidden"); 
  w.name="item-pond[]";
  w.id ="input-pond-"+rowCount;
  w.value=cell2.innerHTML;
  formulario.appendChild(w);

  var a = document.createElement("INPUT");
  a.setAttribute("type", "hidden"); 
  a.name="item-posic[]";
  a.id ="input-posic-"+rowCount;
  a.value=posicItems; 
  formulario.appendChild(a);

  var b = document.createElement("INPUT");
  b.setAttribute("type", "hidden"); 
  b.name="item-nro[]";
  b.id ="input-nro-"+rowCount;
  b.value=contItemsGrupo;//cell0.innerHTML; 
  formulario.appendChild(b);

  var g = document.createElement("INPUT");
  g.setAttribute("type", "hidden"); 
  g.name="item-grupo[]";
  g.id ="input-grupo-"+rowCount;
  g.value= nroGrupo; 
  formulario.appendChild(g);

  ponderacion.value= "";
  ponderacion.placeholder = " % ";

}

