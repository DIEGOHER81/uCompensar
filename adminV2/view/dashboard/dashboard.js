var tabla;

function init(){}

$(document).ready(function(){
  Consultarnrodeusuarios();
  ConsultarPropiedades();
  ConsultarPropiedadesActivas();
  ConsultarPropiedadesArriendo();
  ConsultarPropiedadesVenta();
});

function ConsultarPropiedades(){

    var parametros = {
        "Opc" : "ConsultarPropiedades",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/dashboard.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            //alert(response);
            jQuery("#divPropiedadesRegistradas").html(response);
           
            

       }
    });

}

function ConsultarPropiedadesActivas(){

    var parametros = {
        "Opc" : "ConsultarPropiedadesActivas",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/dashboard.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            //alert(response);
            jQuery("#divPropiedadesActivas").html(response);
           
            

       }
    });

}

function ConsultarPropiedadesArriendo(){

    var parametros = {
        "Opc" : "ConsultarPropiedadesArriendo",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/dashboard.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            //alert(response);
            jQuery("#divPropiedadesArriendo").html(response);
           
            

       }
    });

}

function ConsultarPropiedadesVenta(){

    var parametros = {
        "Opc" : "ConsultarPropiedadesVenta",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/dashboard.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            //alert(response);
            jQuery("#divPropiedadesVenta").html(response);
           
            

       }
    });

}

function Consultarnrodeusuarios(){

    var parametros = {
        "Opc" : "ConsultarUsuarios",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/dashboard.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            //alert(response);
            jQuery("#divUsuariosRegistrados").html(response);
           
            

       }
    });

}

    

init();
