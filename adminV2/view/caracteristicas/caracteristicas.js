var tabla;

function init(){}

$(document).ready(function(){

    ConsultarTipoPropiedades();
    ConsultarCaracteristicas();
    $('#btnsave').click(function(){           
        SaveInformation();
    });
    

});

function ConsultarCaracteristicas()
{

    var parametros = {
        "Opc" : "ConsultarCaracteristicas"
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/caracteristicasPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            jQuery('#imgcargando').hide();
            jQuery('#divtblCaracteristicas').html(response);
            jQuery("#tblCaracteristicas").DataTable(
                {
                    "order": [[ 0, "desc" ]]
                    ,dom: 'Bfrtip',
                    responsive:true,
                    lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 Registros', '25 Registros', '50 Registros', 'Mostrar Todo' ]
                    ],
                    buttons: [
                        //'copy', 'csv', 'excel', 'pdf', 'print'
                        /*
                        { extend: 'pageLength', className: 'btn-success' },
                        { extend: 'copy', className: 'btn-outline-secondary' },
                        { extend: 'csv', className: 'btn-success' },
                        { extend: 'excel', className: 'btn-primary' },
                        { extend: 'pdf', className: 'btn-warning' },
                        { extend: 'print', className: 'btn-danger' },
                        */
                    ]
                }
    
               );
       }
    });

}


function SaveInformation()
{
    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmCaracteristicas").serialize(),
        url: '../../controller/caracteristicasPropiedad.controller.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#imgcargando').show();

        },
        success: function(response) {
            if (jQuery.trim(response) == "OK")
            {
                jQuery("#myModalLabel2").text("Mensaje Informativo");
                jQuery("#msnModal").html("Se ha creado correctamente la característica ingresada");
            } else {
                jQuery("#myModalLabel2").text("Error");
                jQuery("#msnModal").html("Se ha generado un problema en el momento del ingreso");
            }
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando').hide();
            ConsultarCaracteristicas();
        }

    })
}


function ConsultarTipoPropiedades()
{

  
    var parametros = {
        "Opc" : "ConsultarTipoPropiedades"
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/tiposPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            jQuery('#imgcargando').hide();
            jQuery('#lstTipoPropiedad').html(response)
       }
    });

}






function ConfirmDialogDelete(idCaracteristica, idtipopropiedad ) {
    $('<div></div>').appendTo('body')
        .html('<div><h6>¿Desea eliminar la caracteristica ' + idCaracteristica+' ? </h6></div>')
        .dialog({
        modal: true,
        title: 'Borrar',
        zIndex: 10000,
        autoOpen: true,
        width: '350px',
        resizable: false,
        buttons: {
            Si: function() {
            // $(obj).removeAttr('onclick');                                
            // $(obj).parents('.Parent').remove();
    
            //$('body').append('<h1>Confirm Dialog Result: <i>Si</i></h1>');
    
            $(this).dialog("close");
                eliminar(idCaracteristica, idtipopropiedad);
            },
            No: function() {
             // $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');
    
            $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            $(this).remove();
        }
        });
};


function eliminar(idCaracteristica, idtipopropiedad){

    var parametros = {
        "Opc" : "EliminarCaracteristica",
        "idCaracteristica":idCaracteristica,
        'idtipo':idtipopropiedad
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/caracteristicasPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
        
            jQuery('#imgcargando').hide();
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            ConsultarCaracteristicas();
            
       }
    });
}


function editar(codcliente){

    jQuery("#main_form").show(1000,"swing");
    jQuery("#txtaction").val("EditProduct");


    var parametros = {
        "Opc" : "FindProduct",
        "idProduct":codcliente
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(datos){
            
            jQuery('#imgcargando').hide();
            var dataJson = eval(jQuery.trim(datos));
                for(var i in dataJson){
                     
                    if (dataJson[i].cliente_lead == "S"){
                        jQuery("#chkclientelead").prop("checked", "checked");
                    } else {
                        jQuery("#chkclientelead").prop("checked", "");
                    }    

                    jQuery("#lstcomercial").val(dataJson[i].codasesor);
                    jQuery("#codcliente").val(dataJson[i].codigo);

                    jQuery("#chksucursal").prop("checked", ""); //Revisar trim
                    jQuery("#lstciudades").val(dataJson[i].codsucursal);
                    jQuery("#lstciudades").trigger('change');
                    jQuery("#nit").val(dataJson[i].nit);
                    jQuery("#chkautonumerico").prop("checked", "");//Revisar truncate 
                    jQuery("#txtrazonsocial").val(dataJson[i].razon_social);
                    jQuery("#txttelefonofijo").val(dataJson[i].telefono);
                    jQuery("#txtcelular").val(dataJson[i].celular);
                    jQuery("#txtdireccionPrincipal").val(dataJson[i].direccion_principal);
                    jQuery("#txtdireccioncorrespondencia").val(dataJson[i].direccion_correspondencia);
                    jQuery("#txtcorreoprincipal").val(dataJson[i].correo_principal);
                    jQuery("#txtcorreofacturacion").val(dataJson[i].correo_facturacion);

                    Dropzone.forElement('#txtrut').removeAllFiles(true);//Revisar agregar atributo
                    Dropzone.forElement('#txtcamaracomercio').removeAllFiles(true);
                    Dropzone.forElement('#txtestadoresultados').removeAllFiles(true);
                    Dropzone.forElement('#txtreferenciacomercial').removeAllFiles(true);

                    jQuery("#txtRutname").val(dataJson[i].rut);
                    jQuery("#txtccname").val(dataJson[i].camara_comercio);
                    jQuery("#txtresultadosname").val(dataJson[i].estado_resultados);
                    jQuery("#txtreferencianame").val(dataJson[i].referencia_comercial);

                    jQuery("#txtplazodepago").val(dataJson[i].plazo_pago);

                    jQuery("#lstformadepago").val(dataJson[i].forma_pago);
                    jQuery("#txtcodigopostal").val(dataJson[i].codigo_postal);
              
                    if (dataJson[i].estado == "A"){
                        /*
                            jQuery("#stateActive").prop('checked', 'checked');
                            jQuery("#idstateinactive").attr('checked', true);
                            jQuery("#lblstateactive").addClass('active focus')
                        */
                        jQuery("#stateActive").click();
                    }else {
                        jQuery("#idstateinactive").click();
                    }

                    jQuery("#digcode").val(dataJson[i].coddigver);
                    jQuery("#txtsigla").val(dataJson[i].sigla);
                    

               }

               jQuery("#codcliente").css('background-color','#c2c2c2');
               jQuery("#codcliente").prop('readonly',true);
               jQuery("#NuevaCotizacion").attr("href","../cotizacion/cotizacion.php?cod="+codcliente);
               jQuery("#NuevaCotizacion").show();
               jQuery("#Nuevatarea").attr("href","../tareas/tareas.php?cod="+codcliente);
               jQuery("#Nuevatarea").show();
               jQuery("#btnImprimirCliente").prop("disabled",false);
               jQuery("#btnAdicionarContacto").prop("disabled",false);
            
            
       }
    });
}



function imprimir(codcliente){
    
    cadena = "tcpdf/examples/getrptcliente.php?idcliente=" + codcliente;
    window.open(cadena);
    
}

function CleanForm(){
    jQuery("#chkclientelead").prop("checked", "");
    jQuery("#lstcomercial").val("");
    jQuery("#codcliente").css('background-color','#FFFFFF');
    jQuery("#codcliente").prop('readonly',true);
    jQuery("#codcliente").val("");
    jQuery("#chksucursal").prop("checked", "");
    jQuery("#codsucursal").val("");
    jQuery("#nit").val("");
    jQuery("#digcode").val("");
    jQuery("#chkautonumerico").prop("checked", "");
    jQuery("#txtrazonsocial").val("");
    jQuery("#txttelefonofijo").val("");
    jQuery("#txtcelular").val("");
    jQuery("#txtdireccionPrincipal").val("");
    jQuery("#txtdireccioncorrespondencia").val("");
    jQuery("#txtcorreoprincipal").val("");
    jQuery("#txtcorreofacturacion").val("");

    Dropzone.forElement('#txtrut').removeAllFiles(true);
    jQuery("#txtRutname").val("");

    Dropzone.forElement('#txtcamaracomercio').removeAllFiles(true);
    jQuery("#txtccname").val("");

    Dropzone.forElement('#txtestadoresultados').removeAllFiles(true);
    jQuery("#txtresultadosname").val("");
    
    Dropzone.forElement('#txtreferenciacomercial').removeAllFiles(true);
    jQuery("#txtreferencianame").val("");

    jQuery("#txtplazodepago").val("0");
    jQuery("#lstciudades").val("NA");
    jQuery("#lstformadepago").val("NA");
    jQuery("#txtcodigopostal").val("");
    jQuery("#stateActive").click();
    jQuery("#txtaction").val("");
}

function ConsultarClientes(){

    var parametros = {
        "Opc" : "ConsultarTodoslosclientes",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            
            jQuery("#divtblclientes").html(response);
            jQuery("#tblclientes").DataTable(
            {
                "order": [[ 1, "desc" ]]
                ,dom: 'Bfrtip',
                responsive:true,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 Registros', '25 Registros', '50 Registros', 'Mostrar Todo' ]
                ],
                buttons: [
                    //'copy', 'csv', 'excel', 'pdf', 'print'
                    /*
                    { extend: 'pageLength', className: 'btn-success' },
                    { extend: 'copy', className: 'btn-outline-secondary' },
                    { extend: 'csv', className: 'btn-success' },
                    { extend: 'excel', className: 'btn-primary' },
                    { extend: 'pdf', className: 'btn-warning' },
                    { extend: 'print', className: 'btn-danger' },
                    */
                ]
            }

           );
           jQuery('#imgcargando').hide();

       }
    });

}

function ConsultarDatos(){
    
    var parametros = {
        "Opc" : "ConsultarCiudades",
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/ciudad.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
    
            jQuery("#divlstsucursal").html(response);
            jQuery("#lstciudades").select2();


       }
    });

}


function ConsultarConsecutivo(){
    
    var parametros = {
        "Opc" : "ConsultarConsecutivo",
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            jQuery("#codcliente").val(response);
        }
    });

}

function ConsultarComerciales(){
    var parametros = {
        "Opc" : "ConsultarComerciales",
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            jQuery("#divlstComercial").html(response);
        }
    });

}

function ConsultarDigitoVerificacion(nit)
{

    var parametros = {
        "Opc" : "ConsultarDigitoVerificacion",
        "nit":nit
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            jQuery("#digcode").val(response);
            ConsultarClientexNit(nit);
        }
    });

}

function ConsultarClientexNit(nit)
{

    var parametros = {
        "Opc" : "FindClient",
        "nit":nit
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/clientes.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            var dataJson = eval(jQuery.trim(response));
            var mensaje = "El nit ingresado tiene los siguientes datos relacionados: <br><hr>";
            for(var i in dataJson){
                mensaje = mensaje + " Código: " + dataJson[i].codigo + " - Sucursal: "  + dataJson[i].codsucursal + " - Razón Social: " + dataJson[i].razon_social + "<br><hr>"; 
            }
            jQuery("#msnModal").html(mensaje);
            jQuery("#modalscreen").modal();
        }
    });
}

function validarCamposObligatorios()
{
    var error = false;

    var nit = jQuery("#nit").val();
    if (nit.length<7){
        error = true;
        jQuery("#nit").css("border-color", "#e71b24");
    } else {
        jQuery("#nit").css("border-color", "#ced4da");
    }

    var digcode = jQuery("#digcode").val();
    if (digcode.length<1){
        error = true;
        jQuery("#digcode").css("border-color", "#e71b24");
    } else {
        jQuery("#digcode").css("border-color", "#ced4da");
    }


    var txtrazonsocial = jQuery("#txtrazonsocial").val();
    if (txtrazonsocial.length<2){
        error = true;
        jQuery("#txtrazonsocial").css("border-color", "#e71b24");
    } else {
        jQuery("#txtrazonsocial").css("border-color", "#ced4da");
    }
    

    var txttelefonofijo = jQuery("#txttelefonofijo").val(); 
    var txtcelular = jQuery("#txtcelular").val(); 

    if ((txttelefonofijo.length<2) && (txtcelular.length<2)) {
        error = true;
        jQuery("#txttelefonofijo").css("border-color", "#e71b24");
        jQuery("#txtcelular").css("border-color", "#e71b24");
    } else {
        jQuery("#txttelefonofijo").css("border-color", "#ced4da");
        jQuery("#txtcelular").css("border-color", "#ced4da");
    }


    var txtdireccionPrincipal = jQuery("#txtdireccionPrincipal").val();
    if (txtdireccionPrincipal.length<2){
        error = true;
        jQuery("#txtdireccionPrincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtdireccionPrincipal").css("border-color", "#ced4da");
    }

    var txtcorreoprincipal = jQuery("#txtcorreoprincipal").val();
    if (txtcorreoprincipal.length<2){
        error = true;
        jQuery("#txtcorreoprincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtcorreoprincipal").css("border-color", "#ced4da");
    }


    if($("#txtcorreoprincipal").val().indexOf('@', 0) == -1 || $("#txtcorreoprincipal").val().indexOf('.', 0) == -1) {
       error=true;
       jQuery("#txtcorreoprincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtcorreoprincipal").css("border-color", "#ced4da");

    }

    var txtcorreofacturacion = jQuery("#txtcorreofacturacion").val();
    if (txtcorreofacturacion.length>2){
        if($("#txtcorreofacturacion").val().indexOf('@', 0) == -1 || $("#txtcorreofacturacion").val().indexOf('.', 0) == -1) {
            error=true;
            jQuery("#txtcorreofacturacion").css("border-color", "#e71b24");
        } else {
            jQuery("#txtcorreofacturacion").css("border-color", "#ced4da");
     
        }
    }


    var txtplazodepago = jQuery("#txtplazodepago").val();
    if (txtplazodepago == ""){
        jQuery("#txtplazodepago").val("0");
    }

    return error;
}

init();
