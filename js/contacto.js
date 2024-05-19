$(document).ready(function(){
    ConsultarInformacionEmpresa();
});

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
            console.log(datos);
            for(var i in dataJson){
                jQuery("#telcontacto").text(dataJson[i].dialphone);
                jQuery("#emailcontacto").text(dataJson[i].email_contacto);
                jQuery("#telcontactoformulario").text(dataJson[i].dialphone);
                jQuery("#emailcontactoformulario").text(dataJson[i].email_contacto);
                jQuery("#oficinaformulario").text(dataJson[i].oficinacentral);
            }
        }
    });
}