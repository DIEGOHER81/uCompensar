var tabla;

function init() { }

$(document).ready(function () {

    // Declarar variables globales para Dropzones
    var myDropzone_lista;
    var myDropzone_DocumentosLegales;

    $('#closeAndRedirect').on('click', function () {
        window.location.href = 'relpropiedades.php';
        // Redirige a la página deseada después de cerrar la ventana modal
        /*
        if (myDropzone_lista.getQueuedFiles().length === 0 && myDropzone_DocumentosLegales.getQueuedFiles().length === 0) {
            window.location.href = 'relpropiedades.php';
        } else {
            // Si aún hay archivos en cola, mostrar un mensaje de advertencia o manejar el caso según sea necesario
            alert("Por favor, espere a que todas las imágenes se carguen completamente.");
        }
        */
        
        // Esperar a que Dropzone haya completado el procesamiento de los archivos
        /*
        myDropzone_lista.on("queuecomplete", function() {
            myDropzone_DocumentosLegales.on("queuecomplete", function() {
                // Verificar si todas las imágenes se han subido correctamente antes de continuar con el proceso de guardado
                if (myDropzone_lista.getQueuedFiles().length === 0 && myDropzone_DocumentosLegales.getQueuedFiles().length === 0) {
                    // Si no hay archivos en cola, llamar a la función de guardado
                    window.location.href = 'relpropiedades.php';
                } else {
                    // Si aún hay archivos en cola, mostrar un mensaje de advertencia o manejar el caso según sea necesario
                    alert("Por favor, espere a que todas las imágenes se carguen completamente.");
                }
            });
        });
        */
        
    });


    //Documentación disponible en: https://programacion.net/articulo/como_integrar_el_plugin_fullcalendar_de_jquery_con_bootstrap-_php_y_mysql_1679

    ConsultarTipoPropiedades();
    consultarPaises();
    if (jQuery("#idPropiedad").val() != "") {
        ConsultarInformacionPropiedad(jQuery("#idPropiedad").val())
        get_gallery(jQuery("#idPropiedad").val())
    }


    var calendar = $('#calendar').fullCalendar({  // assign calendar
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        editable: true,
        selectable: true,
        allDaySlot: false,
        displayEventTime: false,
        lang: 'es',
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },


        events: consultarEventos(), // request to load current events


        eventClick: function (event, jsEvent, view) {  // when some one click on any event
        },

        select: function (start, end, jsEvent) {  // click on empty time slot

        },
        eventDrop: function (event, delta) { // event drag and drop
        },
        eventResize: function (event) {  // resize to increase or decrease time of event
        },


        dayClick: function (date) {

        },
        eventRender: function (event, element, view) {
            element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">' + event.description + '</span></div>');
        }
        /*
        eventRender: function(event, element) {
         //$(element).tooltip({title: event.loc ,placement:'bottom' });  
             $(element).tooltip({title: event.description,container: "body"});  
                          
         }*/

    });

    $('#submitButton').on('click', function (e) { // add event submit
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doSubmit(); // send to form submit function
    });

    $('#deleteButton').on('click', function (e) { // delete event clicked
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doDelete(); //send data to delete function
    });

    $('#btnAddObservation').on('click', function (e) { // delete event clicked
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        //var note = $('#txtobservaciones').val();
        //if (note != "")
        //{
        //    doObservation(note); //send data to Add note function
        //}

    });

    $('#btnHistorial').on('click', function (e) { // delete event clicked
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        cadena = "historialevento.php?cod=" + $('#codevent').val();
        window.open(cadena, "_self");

    });




    function doObservation(note) {  // delete event 


    }




    function doDelete() {  // delete event 
    }
    function doSubmit() { // add event
    }

    function consultarEventos() {
        var parametros = {
            "Opc": 'FindEventsforUser'
        };
        jQuery.ajax({
            type: 'post',
            url: '../../controller/agendamiento.php',
            data: parametros,
            async: true,
            success: function (datos) {
                //alert(datos);
                var dataJson = eval(jQuery.trim(datos))

                for (var i in dataJson) {
                    $("#calendar").fullCalendar('renderEvent',
                        {
                            id: dataJson[i].id,
                            title: '',
                            start: dataJson[i].start,
                            end: dataJson[i].end,
                            description: 'Disponible'
                        },
                        true);
                }

            }
        });
    }

    function ClearForm() {
        console.log("limpiando Formulario")
    }

    function FindEventById(idEvent) {
    }

    // eventos de calendario - fin

    $('#makeMeSummernote').summernote({
        height: 200,
    });

    $('#txtDescripcionContractual').summernote({
        height: 200,
    });

    $('#addproduct').click(function () {
        //AddRowCaracteristica(jQuery('#lstcaracteristicas option:selected').val(),jQuery('#lstcaracteristicas option:selected').html(), jQuery("#txtvalorCaracteristica").val(), jQuery("#txtDescripcionContractual").val());
        AddRowCaracteristica();
    });


    $('#btnAddContacto').click(function () {
        AddRowContacto(jQuery('#txtNombreContacto').val(), jQuery('#txtEmpresaContacto').val(), jQuery('#txtTelefonoContacto').val());
    });



    $('#btnAddFecha').click(function () {
        AddRowFecha(jQuery('#txtFecInicial').val(), jQuery('#txtFecFinal').val());
    });





    //Disabling autoDiscover
    Dropzone.autoDiscover = false;

    $(function () {
        //Dropzone class
        myDropzone_lista = new Dropzone("#txtImagenPrincipal", {
            url: "upload.php",
            paramName: "file",
            dictDefaultMessage: "Arrastre el archivo (Imagen), o presione clic sobre esta área para seleccionar uno",
            maxFilesize: 20,//Tamaño dado en MB
            maxFiles: 1,   // Maximum Number of Files
            //acceptedFiles: "application/pdf",
            acceptedFiles: "image/jpeg,image/png,image/jpg",
            autoProcessQueue: false,
            addRemoveLinks: true,
            //acceptedFiles: ".jpeg,.jpg,.png,.gif",

            accept: function (file, done) {
                jQuery("#txtImagenPrincipalName").val(file.name);
                done();
            },

            removedfile: function () {
                jQuery("#txtImagenPrincipalName").val("");
            },
            init: function () {

                this.on("removedfile", function (file) {
                    file.previewElement.remove();
                    jQuery("#txtImagenPrincipal").addClass('dz-clickable'); // remove cursor
                    jQuery("#txtImagenPrincipal")[0].addEventListener('click', this.listeners[1].events.click);
                });

                this.on('maxfilesreached', function () {
                    jQuery("#txtImagenPrincipal").removeClass('dz-clickable'); // remove cursor
                    jQuery("#txtImagenPrincipal")[0].removeEventListener('click', this.listeners[1].events.click);
                });
            }





        });

        $('#btnsave').click(function () {
            //if (validarCamposObligatorios() == false){
            //myDropzone_lista.processQueue();
            //}
        });

    });

    $(function () {
        //Dropzone class
        var filenames = "";
        myDropzone_DocumentosLegales = new Dropzone("#txtGaleria", {
            url: "upload.php",
            paramName: "file",
            dictDefaultMessage: "Arrastre el archivo (Imagen), o presione clic sobre esta área para seleccionar uno",
            maxFilesize: 20,
            maxFiles: 30,
            //acceptedFiles: "application/pdf",
            acceptedFiles: "image/jpeg,image/png,image/jpg",
            autoProcessQueue: false,
            parallelUploads: 30,
            addRemoveLinks: true,
            //acceptedFiles: ".jpeg,.jpg,.png,.gif",

            accept: function (file, done) {
                if (filenames.length == 0) {
                    filenames = file.name;
                } else {
                    filenames = filenames + '?' + file.name;
                }

                jQuery("#txtGaleriaName").val(filenames);
                done();
            },

            removedfile: function () {
                jQuery("#txtGaleriaName").val("");
            },
            init: function () {

                this.on("removedfile", function (file) {
                    file.previewElement.remove();
                    jQuery("#txtGaleria").addClass('dz-clickable'); // remove cursor
                    jQuery("#txtGaleria")[0].addEventListener('click', this.listeners[1].events.click);
                });


                this.on('maxfilesreached', function () {
                    jQuery("#txtGaleria").removeClass('dz-clickable'); // remove cursor
                    jQuery("#txtGaleria")[0].removeEventListener('click', this.listeners[1].events.click);
                });
            }
        });

        $('#btnsave').click(function () {
            //if (validarCamposObligatorios() == false){
            // myDropzone_DocumentosLegales.processQueue();
            //}

        });

    });


    $("#btnsave").click(function () {
        
        jQuery("#btnsave").prop( "disabled", true );
        myDropzone_lista.processQueue();
        myDropzone_DocumentosLegales.processQueue();
        // Verificar si todas las imágenes se han subido correctamente antes de continuar con el proceso de guardado
        /*
        if (myDropzone_lista.getQueuedFiles().length === 0 && myDropzone_DocumentosLegales.getQueuedFiles().length === 0) {
            // Si no hay archivos en cola, llamar a la función de guardado
            console.log("Entre a procesar la imagen")
            SavePropiedad();
        } else {
            // Si aún hay archivos en cola, mostrar un mensaje de advertencia o manejar el caso según sea necesario
            alert("Por favor, espere a que todas las imágenes se carguen completamente.");
        }
        */
        //SavePropiedad();
        
          // Esperar a que Dropzone haya completado el procesamiento de los archivos
        myDropzone_lista.on("queuecomplete", function() {
            myDropzone_DocumentosLegales.on("queuecomplete", function() {
                // Verificar si todas las imágenes se han subido correctamente antes de continuar con el proceso de guardado
                if (myDropzone_lista.getQueuedFiles().length === 0 && myDropzone_DocumentosLegales.getQueuedFiles().length === 0) {
                    // Si no hay archivos en cola, llamar a la función de guardado
                    SavePropiedad();
                } else {
                    // Si aún hay archivos en cola, mostrar un mensaje de advertencia o manejar el caso según sea necesario
                    alert("Por favor, espere a que todas las imágenes se carguen completamente.");
                }
            });
        });
    });

    /*jQuery("#btnAdicionarContacto").prop("disabled","");*/


});

function consultarPaises() {

    var parametros = {
        "Opc": "ConsultarPaisesLstforproperties"
    };

    jQuery.ajax({
        data: parametros,
        url: '../../controller/paises.controller.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            jQuery("#divlstpaises").html(response);
        }
    });
}

/*
  Version 1
function AddRowCaracteristica(idCarcateristica, vlrcaracteristica, valor, aspectocontractual){
    var nrofilas =  $("#tblCaracteristicas tr").length;
    var cadenainsertar = idCarcateristica + '?' + valor + '?' + aspectocontractual ; 
    var htmlTags = '<tr id=\''+nrofilas+ '\'>'+
        '<td>' + idCarcateristica + '</td>'+
        '<td>' + vlrcaracteristica + '</td>'+
        '<td>' + valor + '</td>'+
        '<td>' + aspectocontractual + '</td>'+
        '<td><button type=\'button\' class=\'btn btn-danger\' onClick=\'deleterowCaracteristica('+nrofilas+')\'><i class=\'fa fa-trash\'></i></button>'+
            '<input type=\'hidden\' class=\'form-control\' value=\''+cadenainsertar+'\' id=\''+'txtcaracteristica'+nrofilas+'\' name=\'informacioncaracteristica[]\'>' 
        '</td>'+
      '</tr>';
      
    jQuery('#tblCaracteristicas tbody').append(htmlTags);

   

}*/

function AddRowCaracteristica() {
    var selectedOptions = jQuery('#lstcaracteristicas option:selected');

    selectedOptions.each(function () {
        var idCaracteristica = jQuery(this).val();
        var vlrcaracteristica = jQuery(this).text();
        var valor = jQuery("#txtvalorCaracteristica").val();
        var aspectocontractual = jQuery("#txtDescripcionContractual").val();

        var nrofilas = $("#tblCaracteristicas tr").length;
        var cadenainsertar = idCaracteristica + '?' + valor + '?' + aspectocontractual;

        var htmlTags = '<tr id=\'' + nrofilas + '\'>' +
            '<td>' + idCaracteristica + '</td>' +
            '<td>' + vlrcaracteristica + '</td>' +
            '<td>' + valor + '</td>' +
            '<td>' + aspectocontractual + '</td>' +
            '<td><button type=\'button\' class=\'btn btn-danger\' onClick=\'deleterowCaracteristica(' + nrofilas + ')\'><i class=\'fa fa-trash\'></i></button>' +
            '<input type=\'hidden\' class=\'form-control\' value=\'' + cadenainsertar + '\' id=\'' + 'txtcaracteristica' + nrofilas + '\' name=\'informacioncaracteristica[]\'>' +
            '</td>' +
            '</tr>';

        jQuery('#tblCaracteristicas tbody').append(htmlTags);
    });
}


function deleterowCaracteristica(t) {
    $("#tblCaracteristicas tr#" + t).remove();
}


function AddRowContacto(nombrecontacto, EmpresaContacto, txtTelefonoContacto) {
    var nrofilas = $("#tblContactos tr").length;
    if (EmpresaContacto == "") {
        EmpresaContacto = "NA"
    }
    var cadenainsertar = nombrecontacto + '?' + EmpresaContacto + '?' + txtTelefonoContacto;
    var htmlTags = '<tr id=\'' + nrofilas + '\'>' +
        '<td>' + nrofilas + '</td>' +
        '<td>' + nombrecontacto + '</td>' +
        '<td>' + EmpresaContacto + '</td>' +
        '<td>' + txtTelefonoContacto + '</td>' +
        '<td><button type=\'button\' class=\'btn btn-danger\' onClick=\'deleterowContacto(' + nrofilas + ')\'><i class=\'fa fa-trash\'></i></button>' +
        '<input type=\'hidden\' class=\'form-control\' value=\'' + cadenainsertar + '\' id=\'' + 'txtcontacto' + nrofilas + '\' name=\'informacioncontacto[]\'>'
    '</td>' +
        '</tr>';

    jQuery('#tblContactos tbody').append(htmlTags);



}

function deleterowContacto(t) {
    $("#tblContactos tr#" + t).remove();
}


// Dueños de lsa canchas

function AddRowFecha(FechaInicial, FechaFinal) {
    var nrofilas = $("#tblFechas tr").length;
    var cadenainsertar = FechaInicial + '?' + FechaFinal;
    var htmlTags = '<tr id=\'' + nrofilas + '\'>' +
        '<td>' + nrofilas + '</td>' +
        '<td>' + FechaInicial + '</td>' +
        '<td>' + FechaFinal + '</td>' +
        '<td><button type=\'button\' class=\'btn btn-danger\' onClick=\'deleterowFecha(' + nrofilas + ')\'><i class=\'fa fa-trash\'></i></button>' +
        '<input type=\'hidden\' class=\'form-control\' value=\'' + cadenainsertar + '\' id=\'' + 'txtFecha' + nrofilas + '\' name=\'informacionFecha[]\'>'
    '</td>' +
        '</tr>';

    jQuery('#tblFechas tbody').append(htmlTags);



}

function deleterowFecha(t) {
    $("#tblFechas tr#" + t).remove();
}



function ConsultarCiudadesPorDepartamento(idDepartamento) {
    var parametros = {
        "Opc": "SearchCitiesbyCountry",
        "idPais": jQuery("#lstpais").val(),
        "idDepartamento": idDepartamento
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/ciudad.controller.php',
        type: 'post',
        beforeSend: function () {
        },
        success: function (response) {
            jQuery('#divlstCiudad').html(response)
        }
    });

}

function consultarDepartamentosporPais(idPais) {

    var parametros = {
        "Opc": "ConsultarDepartamentos",
        "idPais": idPais
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/departamentos.controller.php',
        type: 'post',
        beforeSend: function () {
            //jQuery('#imgcargando').show();
        },
        success: function (response) {
            //jQuery('#imgcargando').hide();
            jQuery('#divlstdepartamentos').html(response)
        }
    });

}


async function consultarDepartamentosporPais_verasync(idPais) {
    return new Promise((resolve, reject) => {
        var parametros = {
            "Opc": "ConsultarDepartamentos",
            "idPais": idPais
        };

        jQuery.ajax({
            data: parametros,
            url: '../../controller/departamentos.controller.php',
            type: 'post',
            beforeSend: function () {
                // Puedes realizar alguna acción antes de la llamada asíncrona si es necesario
            },
            success: function (response) {
                // Puedes realizar alguna acción después de la llamada asíncrona si es necesario
                jQuery('#divlstdepartamentos').html(response);
                resolve(response); // Resolvemos la Promesa con la respuesta
            },
            error: function (error) {
                // En caso de error, rechazamos la Promesa
                reject(error);
            }
        });
    });
}


async function ConsultarCiudadesPorDepartamento_verasync(idDepartamento) {

    return new Promise((resolve, reject) => {
        var parametros = {
            "Opc": "SearchCitiesbyCountry",
            "idPais": jQuery("#lstpais").val(),
            "idDepartamento": idDepartamento
        };

        jQuery.ajax({
            data: parametros,
            url: '../../controller/ciudad.controller.php',
            type: 'post',
            beforeSend: function () {
                // Puedes realizar alguna acción antes de la llamada asíncrona si es necesario
            },
            success: function (response) {
                // Puedes realizar alguna acción después de la llamada asíncrona si es necesario
                jQuery('#divlstCiudad').html(response)
                resolve(response); // Resolvemos la Promesa con la respuesta
            },
            error: function (error) {
                // En caso de error, rechazamos la Promesa
                reject(error);
            }
        });
    });

}


function ConsultarTipoPropiedades() {


    var parametros = {
        "Opc": "ConsultarTipoPropiedadesComercial"
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/tiposPropiedad.controller.php',
        type: 'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
        success: function (response) {
            jQuery('#imgcargando').hide();
            jQuery('#lstTipoPropiedad').html(response)
        }
    });

}


function ConsultarCaracteristicasRelacionadas(codtipoPropiedad) {

    var parametros = {
        "Opc": "ConsultarCaracteristicasRelacionadas",
        "codtipoPropiedad": codtipoPropiedad
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/caracteristicasPropiedad.controller.php',
        type: 'post',
        beforeSend: function () {
            //jQuery('#imgcargando').show();
        },
        success: function (response) {
            //jQuery('#imgcargando').hide();
            jQuery('#tbllstCaracteristicas').html(response)
            ConsultarCaracteristicasRelacionadaslst(codtipoPropiedad);
            ConsultarCostosporTipoPropiedad(codtipoPropiedad);
        }
    });
}

function ConsultarCostosporTipoPropiedad(codtipoPropiedad) {
    var parametros = {
        "Opc": "ConsultarCostosporTiposdePropiedades",
        "codtipoPropiedad": codtipoPropiedad
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/costos.controller.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            jQuery('#divlstCostosPropiedad').html(response)
        }
    });

}

function get_gallery(idPropiedad) {
    var parametros = {
        "Opc": "ConsultarItemGallery",
        "idPropiedad": idPropiedad
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/propiedad.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            jQuery("#divgallery").html(response);

        }
    });

}

function TraerValorCosto(idCosto) {

    var parametros = {
        "Opc": "ConsultarValorpordefecto",
        "idCosto": idCosto
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/costos.controller.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (datos) {

            var dataJson = eval(jQuery.trim(datos));
            for (var i in dataJson) {
                jQuery("#txtCostoServicio").val(dataJson[i].valorCosto);
            }
        }
    });


}


function ConsultarCaracteristicasRelacionadaslst(codtipoPropiedad) {

    var parametros = {
        "Opc": "ConsultarCaracteristicasRelacionadaslstMS",
        "codtipoPropiedad": codtipoPropiedad
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/caracteristicasPropiedad.controller.php',
        type: 'post',
        beforeSend: function () {
            //jQuery('#imgcargando').show();
        },
        success: function (response) {
            //jQuery('#imgcargando').hide();
            jQuery('#divlstcaracteristicas').html(response)
        }
    });
}

function concatenarfila(idrep, fila, valor) {
    let cadenainsertar = idrep + '?' + valor;
    jQuery("#txtcaracteristica" + fila).val(cadenainsertar);

}


function recorrer_tablaCaracteristicas() {
    var controlfila = 1;
    // Recorrer las filas de la tabla
    $("#tblMedicamentos tbody tr").each(function () {
        // Recorrer las celdas de la fila
        //var col=0
        $(this).find("td").each(function () {
            // Acceder al contenido de la celda
            //console.log(col);
            //console.log($(this).text());
            //col++;
        });
        concatenarfilaCaracteristicas(controlfila)
        controlfila++;
    });

}


function concatenarfilaCaracteristicas(rownum) {
    var idCaracteristica = $("#tblCaracteristicas tbody tr").eq(rownum - 1).find("td:first").text();
    var valorCaracteristica = jQuery("#txtvalor-" + rownum).val();
    //var valorControlTexto = $("#tblCaracteristicas tbody tr").eq(filaNumero - 1).find("td:eq(2) input[type='text']").val();
    var valorcontractual = jQuery("#txtMemoCaracteristicas-" + rownum).val();

    var Cadena = ""
    if (valorCaracteristica == "") {
        valorCaracteristica = "0";
    }
    if (valorcontractual == "") {
        valorcontractual = "NA";
    }

    Cadena = idCaracteristica + "?" + valorCaracteristica + "?" + valorcontractual;
    jQuery("#txtcaracteristica" + rownum).val(Cadena);


}

async function loadMapScenario_verasync(address) {
    var codciudad = jQuery('#lstCiudad option:selected').html();
    var codDepartamento = jQuery('#lstdepartamentos option:selected').html();
    var codpais = jQuery('#lstpais option:selected').html();
    addresscomponent = address + "," + codciudad + "," + codDepartamento + "," + codpais;
    console.log(addresscomponent);

    var map = new Microsoft.Maps.Map('#mapContainer', {
        credentials: 'ArHfSmWHol4F5nGnPP3z7Nug88sBbye7Pl4QO0KBmDwX1Z3ePgCWiua0YZAXtAFi',
        zoom: 12
    });

    try {
        var geocodeRequest = "https://dev.virtualearth.net/REST/v1/Locations?query=" +
            encodeURIComponent(addresscomponent) +
            "&key=ArHfSmWHol4F5nGnPP3z7Nug88sBbye7Pl4QO0KBmDwX1Z3ePgCWiua0YZAXtAFi";

        var response = await fetch(geocodeRequest);
        var data = await response.json();

        if (data.resourceSets.length > 0 && data.resourceSets[0].resources.length > 0) {
            var location = data.resourceSets[0].resources[0].point.coordinates;
            var center = new Microsoft.Maps.Location(location[0], location[1]);
            map.setView({ center: center });

            var pin = new Microsoft.Maps.Pushpin(center);
            map.entities.push(pin);
        }
    } catch (error) {
        console.error('Error en la carga del mapa:', error);
    }
}


function loadMapScenario(address) {
    var codciudad = jQuery('#lstCiudad option:selected').html();
    var codDepartamento = jQuery('#lstdepartamentos option:selected').html();
    var codpais = jQuery('#lstpais option:selected').html();
    addresscomponent = address + "," + codciudad + "," + codDepartamento + "," + codpais;
    console.log(addresscomponent);
    var map = new Microsoft.Maps.Map('#mapContainer', {
        credentials: 'ArHfSmWHol4F5nGnPP3z7Nug88sBbye7Pl4QO0KBmDwX1Z3ePgCWiua0YZAXtAFi',
        zoom: 12
    });

    var geocodeRequest = "https://dev.virtualearth.net/REST/v1/Locations?query=" + encodeURIComponent(addresscomponent) + "&key=ArHfSmWHol4F5nGnPP3z7Nug88sBbye7Pl4QO0KBmDwX1Z3ePgCWiua0YZAXtAFi";
    fetch(geocodeRequest)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.resourceSets.length > 0 && data.resourceSets[0].resources.length > 0) {
                var location = data.resourceSets[0].resources[0].point.coordinates;
                var center = new Microsoft.Maps.Location(location[0], location[1]);
                map.setView({ center: center });

                var pin = new Microsoft.Maps.Pushpin(center);
                map.entities.push(pin);
            }
        });
}

function ConfirmDialogDelete(codcliente) {
    $('<div></div>').appendTo('body')
        .html('<div><h6>¿Desea eliminar el cliente ' + codcliente + ' ? </h6></div>')
        .dialog({
            modal: true,
            title: 'Borrar',
            zIndex: 10000,
            autoOpen: true,
            width: '350px',
            resizable: false,
            buttons: {
                Si: function () {
                    // $(obj).removeAttr('onclick');                                
                    // $(obj).parents('.Parent').remove();

                    //$('body').append('<h1>Confirm Dialog Result: <i>Si</i></h1>');

                    $(this).dialog("close");
                    eliminar(codcliente);
                },
                No: function () {
                    // $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

                    $(this).dialog("close");
                }
            },
            close: function (event, ui) {
                $(this).remove();
            }
        });
};


function eliminar(codcliente) {

    var parametros = {
        "Opc": "DeleteCliente",
        "idCliente": codcliente
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
        success: function (response) {
            jQuery('#imgcargando').hide();
            ConsultarClientes();

        }
    });
}


function editar(codcliente) {

    jQuery("#main_form").show(1000, "swing");
    jQuery("#txtaction").val("EditProduct");


    var parametros = {
        "Opc": "FindProduct",
        "idProduct": codcliente
    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
        success: function (datos) {

            jQuery('#imgcargando').hide();
            var dataJson = eval(jQuery.trim(datos));
            for (var i in dataJson) {

                if (dataJson[i].cliente_lead == "S") {
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

                if (dataJson[i].estado == "A") {
                    /*
                        jQuery("#stateActive").prop('checked', 'checked');
                        jQuery("#idstateinactive").attr('checked', true);
                        jQuery("#lblstateactive").addClass('active focus')
                    */
                    jQuery("#stateActive").click();
                } else {
                    jQuery("#idstateinactive").click();
                }

                jQuery("#digcode").val(dataJson[i].coddigver);
                jQuery("#txtsigla").val(dataJson[i].sigla);


            }

            jQuery("#codcliente").css('background-color', '#c2c2c2');
            jQuery("#codcliente").prop('readonly', true);
            jQuery("#NuevaCotizacion").attr("href", "../cotizacion/cotizacion.php?cod=" + codcliente);
            jQuery("#NuevaCotizacion").show();
            jQuery("#Nuevatarea").attr("href", "../tareas/tareas.php?cod=" + codcliente);
            jQuery("#Nuevatarea").show();
            jQuery("#btnImprimirCliente").prop("disabled", false);
            jQuery("#btnAdicionarContacto").prop("disabled", false);


        }
    });
}


function SavePropiedad() {

    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmPropiedad").serialize(),
        url: '../../controller/propiedad.php',
        type: 'post',
        beforeSend: function () {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#imgcargando2').show();

        },
        success: function (response) {
            //console.log(response);
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando2').hide();



        }

    })
}

function imprimir(codcliente) {

    cadena = "tcpdf/examples/getrptcliente.php?idcliente=" + codcliente;
    window.open(cadena);

}

function CleanForm() {
    jQuery("#chkclientelead").prop("checked", "");
    jQuery("#lstcomercial").val("");
    jQuery("#codcliente").css('background-color', '#FFFFFF');
    jQuery("#codcliente").prop('readonly', true);
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

function ConsultarClientes() {

    var parametros = {
        "Opc": "ConsultarTodoslosclientes",

    };
    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
        success: function (response) {

            jQuery("#divtblclientes").html(response);
            jQuery("#tblclientes").DataTable(
                {
                    "order": [[1, "desc"]]
                    , dom: 'Bfrtip',
                    responsive: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 Registros', '25 Registros', '50 Registros', 'Mostrar Todo']
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

function ConsultarDatos() {

    var parametros = {
        "Opc": "ConsultarCiudades",
    };


    jQuery.ajax({
        data: parametros,
        url: '../../controller/ciudad.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {

            jQuery("#divlstsucursal").html(response);
            jQuery("#lstciudades").select2();


        }
    });

}


function ConsultarConsecutivo() {

    var parametros = {
        "Opc": "ConsultarConsecutivo",
    };


    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            jQuery("#codcliente").val(response);
        }
    });

}

function ConsultarComerciales() {
    var parametros = {
        "Opc": "ConsultarComerciales",
    };


    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            jQuery("#divlstComercial").html(response);
        }
    });

}

function ConsultarDigitoVerificacion(nit) {

    var parametros = {
        "Opc": "ConsultarDigitoVerificacion",
        "nit": nit
    };


    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            jQuery("#digcode").val(response);
            ConsultarClientexNit(nit);
        }
    });

}

function ConsultarClientexNit(nit) {

    var parametros = {
        "Opc": "FindClient",
        "nit": nit
    };


    jQuery.ajax({
        data: parametros,
        url: '../../controller/clientes.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            var dataJson = eval(jQuery.trim(response));
            var mensaje = "El nit ingresado tiene los siguientes datos relacionados: <br><hr>";
            for (var i in dataJson) {
                mensaje = mensaje + " Código: " + dataJson[i].codigo + " - Sucursal: " + dataJson[i].codsucursal + " - Razón Social: " + dataJson[i].razon_social + "<br><hr>";
            }
            jQuery("#msnModal").html(mensaje);
            jQuery("#modalscreen").modal();
        }
    });
}

function validarCamposObligatorios() {
    var error = false;

    var nit = jQuery("#nit").val();
    if (nit.length < 7) {
        error = true;
        jQuery("#nit").css("border-color", "#e71b24");
    } else {
        jQuery("#nit").css("border-color", "#ced4da");
    }

    var digcode = jQuery("#digcode").val();
    if (digcode.length < 1) {
        error = true;
        jQuery("#digcode").css("border-color", "#e71b24");
    } else {
        jQuery("#digcode").css("border-color", "#ced4da");
    }


    var txtrazonsocial = jQuery("#txtrazonsocial").val();
    if (txtrazonsocial.length < 2) {
        error = true;
        jQuery("#txtrazonsocial").css("border-color", "#e71b24");
    } else {
        jQuery("#txtrazonsocial").css("border-color", "#ced4da");
    }


    var txttelefonofijo = jQuery("#txttelefonofijo").val();
    var txtcelular = jQuery("#txtcelular").val();

    if ((txttelefonofijo.length < 2) && (txtcelular.length < 2)) {
        error = true;
        jQuery("#txttelefonofijo").css("border-color", "#e71b24");
        jQuery("#txtcelular").css("border-color", "#e71b24");
    } else {
        jQuery("#txttelefonofijo").css("border-color", "#ced4da");
        jQuery("#txtcelular").css("border-color", "#ced4da");
    }


    var txtdireccionPrincipal = jQuery("#txtdireccionPrincipal").val();
    if (txtdireccionPrincipal.length < 2) {
        error = true;
        jQuery("#txtdireccionPrincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtdireccionPrincipal").css("border-color", "#ced4da");
    }

    var txtcorreoprincipal = jQuery("#txtcorreoprincipal").val();
    if (txtcorreoprincipal.length < 2) {
        error = true;
        jQuery("#txtcorreoprincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtcorreoprincipal").css("border-color", "#ced4da");
    }


    if ($("#txtcorreoprincipal").val().indexOf('@', 0) == -1 || $("#txtcorreoprincipal").val().indexOf('.', 0) == -1) {
        error = true;
        jQuery("#txtcorreoprincipal").css("border-color", "#e71b24");
    } else {
        jQuery("#txtcorreoprincipal").css("border-color", "#ced4da");

    }

    var txtcorreofacturacion = jQuery("#txtcorreofacturacion").val();
    if (txtcorreofacturacion.length > 2) {
        if ($("#txtcorreofacturacion").val().indexOf('@', 0) == -1 || $("#txtcorreofacturacion").val().indexOf('.', 0) == -1) {
            error = true;
            jQuery("#txtcorreofacturacion").css("border-color", "#e71b24");
        } else {
            jQuery("#txtcorreofacturacion").css("border-color", "#ced4da");

        }
    }


    var txtplazodepago = jQuery("#txtplazodepago").val();
    if (txtplazodepago == "") {
        jQuery("#txtplazodepago").val("0");
    }

    return error;
}

function bigimage(imgcontrol) {

    var imageUrl = jQuery(imgcontrol).attr('src');
    $('#modalImage').attr('src', imageUrl);
    jQuery("#imageModal").modal()

}

async function ConsultarInformacionPropiedad(idPropiedad) {
    let departamento = 0;
    let ciudad = 0;
    let ubicacion = "";

    var parametros = {
        "Opc": "ConsultarPropiedadesporid",
        "idPropiedad": idPropiedad
    };

    try {
        const datos = await new Promise((resolve, reject) => {
            jQuery.ajax({
                data: parametros,
                url: '../../controller/propiedad.php',
                type: 'post',
                beforeSend: function () {

                },
                success: function (response) {
                    resolve(response);
                },
                error: function (error) {
                    reject(error);
                }
            });
        });

        var dataJson = eval(jQuery.trim(datos));
        console.log(datos);

        for (var i in dataJson) {
            jQuery("#txttituloPropiedad").val(dataJson[i].titulo);
            jQuery("#makeMeSummernote").summernote('code', dataJson[i].descripcion);
            jQuery("#txtdescripcionpropiedad").html(dataJson[i].descripcion);
            jQuery("#lstObjetivoPropiedad").val(dataJson[i].Objetivo);
            jQuery("#lstestadoPropiedad").val(dataJson[i].codEstado);
            jQuery("#imgPrincipal").attr('src', './adminV2/view/propiedades/uploads/' + dataJson[i].url_foto_principal);
            jQuery("#lstselectTipoPropiedad").val(dataJson[i].codtipo);
            jQuery("#txtprecioVenta").val(dataJson[i].PrecioVenta);
            jQuery("#txtprecioDia").val(dataJson[i].PrecioDia);
            jQuery("#txtprecioMes").val(dataJson[i].PrecioMes);
            jQuery("#txtprecioDia-ta").val(dataJson[i].preciodiata);
            jQuery("#txtprecioMes-ta").val(dataJson[i].preciomesta);


            // Ahora utilizamos await para esperar la respuesta de la función asíncrona
            departamento = await consultarDepartamentosporPais_verasync(dataJson[i].pais);
            jQuery("#lstpais").val(dataJson[i].pais);
            ciudad = dataJson[i].ciudad;
            ubicacion = dataJson[i].ubicacion

            // Consultamos las ciudades por departamento
            await ConsultarCiudadesPorDepartamento_verasync(dataJson[i].departamento);

            jQuery("#address").val(dataJson[i].ubicacion)
            jQuery("#txtbarrio").val(dataJson[i].barrio)
            jQuery("#txtSector").val(dataJson[i].sector)
            jQuery("#txtVideoPropiedad").val(dataJson[i].url_video)
            jQuery("#txtEtiquetasSeo").val(dataJson[i].seo)


        }

        //console.table(departamento, ciudad);

        jQuery("#lstdepartamentos").val(dataJson[i].departamento);
        jQuery("#lstCiudad").val(ciudad);
        await loadMapScenario_verasync(ubicacion);
    } catch (error) {
        console.error('Error en la consulta de propiedades:', error);
    }
}

init();
