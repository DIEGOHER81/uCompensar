$(document).ready(function(){
    ConsultarInformacionEmpresa();
    ConsultarPropiedadesInscritas();
});

function ConsultarPropiedadesInscritas()
{
    var parametros = {
        "Opc" : "ConsultarPropiedadesCatalogo",

        };
    jQuery.ajax({
        data:  parametros,
        url:    './adminV2/controller/propiedad.php',
        type:  'post',
        beforeSend: function () {

        },
        success: function(response) {
            jQuery("#divlstPropiedades").html(response);
        }
    });
}

function ConsultarInformacionEmpresa()
{
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