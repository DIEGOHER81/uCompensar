var ubicacion = "";
var ciudad = "";
var departamento = "";
var pais = "";

$(document).ready(function () {
    ConsultarInformacionEmpresa();

    const url = window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const id = params.get("id");

    ConsultarInformacionPropiedad(id);
    ConsultarCaracteristicasPropiedad(id);
    get_gallerymain(id);
    get_gallery(id);

    $('#facebookShare').on('click', function () {
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url), '_blank');
    });

    $('#twitterShare').on('click', function () {
        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(url), '_blank');
    });

    $('#pinterestShare').on('click', function () {
        window.open('https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(url), '_blank');
    });
    
    $('#VerMapa').on('click', function () {
        // Alternar la visibilidad del mapContainer
        $('#mapContainer').toggle();
        
        // Verificar si el mapContainer está visible después de alternar
        if ($('#mapContainer').is(':visible')) {
            // Si está visible, cargar el mapa
            loadMapScenario_detalle(ubicacion, ciudad, departamento, pais);
            jQuery("#fachevron").addClass("fa-chevron-up");
            jQuery("#fachevron").removeClass("fa-chevron-down");
              
        } else {
            jQuery("#fachevron").removeClass("fa-chevron-up");
            jQuery("#fachevron").addClass("fa-chevron-down");
        }
    });

});

function Mostrargaleria() {
    $('#myModal').modal('show');
}

function OcultarGaleria() {
    $('#myModal').modal('hide');
}

function MostrarDivhuespedes() {
    $("#dividhuespedes").toggle();
}

function get_gallerymain(idPropiedad) {
    var parametros = {
        "Opc": "ConsultarGalleriadetallepropiedad",
        "idPropiedad": idPropiedad
    };
    $.ajax({
        data: parametros,
        url: './adminV2/controller/propiedad.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            $("#divgallerymain").html(response);
        },
        error: function (error) {
            console.error('Error en la solicitud de galería principal:', error);
        }
    });
}

function get_gallery(idPropiedad) {
    var parametros = {
        "Opc": "ConsultarItemGalleryPrincipal",
        "idPropiedad": idPropiedad
    };
    $.ajax({
        data: parametros,
        url: './adminV2/controller/propiedad.php',
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            $("#divgallery").html(response);
        },
        error: function (error) {
            console.error('Error en la solicitud de galería:', error);
        }
    });
}

function ConsultarInformacionEmpresa() {
    var parametros = {
        "Opc": "ConsultarInformacionEmpresa",
    };
    $.ajax({
        data: parametros,
        url: './adminV2/controller/configuracion.controller.php',
        type: 'post',
        success: function (datos) {
            var dataJson = JSON.parse($.trim(datos));
            for (var i in dataJson) {
                $("#telcontacto").text(dataJson[i].dialphone);
                $("#emailcontacto").text(dataJson[i].email_contacto);
                $("#lnkpoliticadeprivacidad").attr("href", "./adminV2/view/parametrosbasicos/docsuploaded/" + dataJson[i].documentoprivacidad);
                $("#linkfacebook").attr('href', dataJson[i].facebook);
                $("#linktwitter").attr('href', dataJson[i].twitter);
                $("#linkyoutube").attr('href', dataJson[i].Youtube);
                $("#telwhatsapp").attr('href', 'https://wa.me/' + dataJson[i].whatsupphone);
            }
        },
        error: function (error) {
            console.error('Error en la solicitud de información de la empresa:', error);
        }
    });
}

async function ConsultarInformacionPropiedad(idPropiedad) {
    var parametros = {
        "Opc": "ConsultarPropiedadesporid",
        "idPropiedad": idPropiedad
    };

    try {
        const datos = await $.ajax({
            data: parametros,
            url: './adminV2/controller/propiedad.php',
            type: 'post'
        });

        var dataJson = JSON.parse($.trim(datos));
        //console.log(dataJson);
        for (var i in dataJson) {
            $("#tituloPropiedad").text(dataJson[i].titulo);
            $("#tituloPropiedadParrafo").text(dataJson[i].titulo);
            $("#txtdescripcionpropiedad").html(dataJson[i].descripcion);
            if (dataJson[i].Objetivo == 1) {
                if (dataJson[i].PrecioMes != "0")
                {
                    $("#Precio").html('$' + dataJson[i].PrecioMes + '<strong style=\'font-size:0.6em\'>/Mes</strong>');
                } 
                if (dataJson[i].PrecioDia != "0")
                {
                    $("#Precio_2").html('$' + dataJson[i].PrecioDia + '<strong style=\'font-size:0.6em\'>/Mes</strong>');
                }
                
            } else {
                $("#Precio").html('$' + dataJson[i].PrecioVenta);
            }
            $("#imgPrincipal").attr('src', './adminV2/view/peliculas/uploads/' + dataJson[i].url_foto_principal);
            if (dataJson[i].url_video != "") {
                $("#videopropiedad").attr('src', dataJson[i].url_video);
                $("#divVideoPropiedad").show();
            } else {
                $("#divVideoPropiedad").hide();
            }

            ubicacion = dataJson[i].ubicacion || "";
            ciudad = dataJson[i].nombreciudad || "";
            departamento = dataJson[i].nombredepartamento || "";
            pais = dataJson[i].nombrepais || "";
            
            // Obtener el valor actual del atributo href
            var currentHref = $("#telwhatsapp").attr('href');

            // Agregar el texto predeterminado al mensaje de WhatsApp
            var whatsappText = "Hola, estoy interesado en tu propiedad ("+dataJson[i].titulo+"). ¿Podrías proporcionarme más información?";
            var whatsappLink = currentHref + '?text=' + encodeURIComponent(whatsappText);

            // Establecer el nuevo valor del atributo href
            $("#telwhatsapp").attr('href', whatsappLink);
            $("#btnSolicitarInformacion").attr('href', whatsappLink);
        }

/*
        console.log("Valores de ubicacion, ciudad, departamento, pais:", ubicacion, ciudad, departamento, pais);
        await loadMapScenario_verasync_detail(ubicacion, ciudad, departamento, pais);
        
        // Llama a loadMapScenario después de que los datos estén disponibles
        console.log("Valores antes de llamar a loadMapScenario:", ubicacion, ciudad, departamento, pais);
        loadMapScenario(ubicacion, ciudad, departamento, pais);

         loadMapScenario_detalle(ubicacion, ciudad, departamento, pais);
        */
    } catch (error) {
        console.error('Error en la consulta de propiedades:', error);
    }
}

async function loadMapScenario_verasync_detail(address, codciudad, codDepartamento, codpais) {
    addresscomponent = address + "," + codciudad + "," + codDepartamento + "," + codpais;
    //console.log("loadMapScenario_verasync");
    //console.log(addresscomponent);
    
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

function loadMapScenario_detalle(address, codciudad, codDepartamento, codpais) {
    if (!address || !codciudad || !codDepartamento || !codpais) {
        console.error('Uno o más parámetros son nulos o indefinidos.');
        return;
    }

    var addresscomponent = address + "," + codciudad + "," + codDepartamento + "," + codpais;
    console.log("Load Map Scenario");
    console.log(addresscomponent);

    if (typeof Microsoft !== 'undefined') {
        try {
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
                    if (data && data.resourceSets && data.resourceSets.length > 0 && data.resourceSets[0].resources && data.resourceSets[0].resources.length > 0) {
                        var location = data.resourceSets[0].resources[0].point.coordinates;
                        var center = new Microsoft.Maps.Location(location[0], location[1]);
                        map.setView({ center: center });

                        var pin = new Microsoft.Maps.Pushpin(center);
                        map.entities.push(pin);
                    } else {
                        console.error('No se encontraron resultados de geocodificación para la dirección proporcionada.');
                    }
                })
                .catch(function (error) {
                    console.error('Error en la solicitud de geocodificación:', error);
                });
        } catch (error) {
            //console.error('Error en la carga del mapa:', error);
        }
    } else {
        console.error('Microsoft is not defined. La biblioteca de mapas podría no estar cargada correctamente.');
    }
}

function ConsultarCaracteristicasPropiedad(idPropiedad) {
    var parametros = {
        "Opc": "ConsultarCaracteristicaPropiedades",
        "idPropiedad": idPropiedad
    };
    $.ajax({
        data: parametros,
        url: './adminV2/controller/propiedad.php',
        type: 'post',
        success: function (response) {
            if ($.trim(response) != "<ul></ul>") {
                $("#lstCaracteristicasPropiedad").html(response);
                $("#divcaracteristicaspropiedad").show();
            }
        },
        error: function (error) {
            console.error('Error en la solicitud de características de la propiedad:', error);
        }
    });
}
