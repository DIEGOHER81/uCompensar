$(document).ready(function(){

    $(document).on('click', 'input[type="checkbox"]', function() {
        var idCheckbox = $(this).attr('id');
        var idValor = 'valor_' + idCheckbox;
        var valorInput = $('#' + idValor);
        if ($(this).is(':checked')) {
            valorInput.show();
        } else {
            valorInput.hide();
        }
    });


    jQuery("#lblCierre").on('click', function(){
       jQuery("#resultadoFiltros").hide()
    });
    

    ConsultarInformacionEmpresa();
    ConsultarPropiedadesInscritas();
    Consultarobjetivopropiedad();
    Consultartipopropiedad();
    ConsultarCaracteristicasGenerales();

    
    $( "#btnAplicarFiltro" ).on( "click", function() {
        RealizarBusqueda();
    } );

});

function RealizarBusqueda()
{
    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmFiltroBusqueda").serialize(),
        url: './adminV2/controller/filtrospropiedades.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#listadoPropiedadesfiltro').html("");

        },
        success: function(response) {
             jQuery("#listadoPropiedadesfiltro").html(response);
             jQuery("#resultadoFiltros").show();
             //console.log(response);        


        }

    })

}


function Consultarobjetivopropiedad()
{
    var parametros = {
        "Opc" : "ConsultarObjetivoslst",

        };
    jQuery.ajax({
        data:  parametros,
        url:    './adminV2/controller/objetivoPropiedad.php',
        type:  'post',
        beforeSend: function () {

        },
        success: function(response) {
            jQuery("#divlstobjetivopropiedad").html(response);
            
        }
    });
}



function Consultartipopropiedad()
{
    var parametros = {
        "Opc" : "ConsultarTipoPropiedades",

        };
    jQuery.ajax({
        data:  parametros,
        url:    './adminV2/controller/tiposPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {

        },
        success: function(response) {
            
            jQuery("#divlsttipopropiedad").html(response);
        }
    });
}



function ConsultarPropiedadesInscritas()
{
    var parametros = {
        "Opc" : "ConsultarPropiedades",

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
        "Opc" : "ConsultarInformacionEmpresa",

        };
    jQuery.ajax({
        data:  parametros,
        url:    './adminV2/controller/configuracion.controller.php',
        type:  'post',
        beforeSend: function () {

        },
        success: function(datos){
            var dataJson = eval(jQuery.trim(datos));
            for(var i in dataJson){
                jQuery("#telcontacto").text(dataJson[i].dialphone);
                jQuery("#emailcontacto").text(dataJson[i].email_contacto);
                jQuery("#acercadenosotros").html(dataJson[i].QuienesSomos);
                jQuery("#linkfacebook").attr('href', dataJson[i].facebook);
                jQuery("#linktwitter").attr('href', dataJson[i].twitter);
                jQuery("#linkyoutube").attr('href', dataJson[i].Youtube);
                jQuery("#telwhatsapp").attr('href', 'https://wa.me/'+  dataJson[i].whatsupphone)
                jQuery("#idpolitica").attr('href', './adminV2/view/parametrosbasicos/docsuploaded/'+  dataJson[i].documentoprivacidad)
            }
        }
    });
}

function ConsultarCaracteristicasGenerales()
{
    var parametros = {
        "Opc" : "ConsultarCarateristicas",

        };
    jQuery.ajax({
        data:  parametros,
        url:    './adminV2/controller/propiedad.php',
        type:  'post',
        beforeSend: function () {

        },
        success: function(datos){
            $('#divcaracteristicasfiltro').html(datos);
        }
    });

}

