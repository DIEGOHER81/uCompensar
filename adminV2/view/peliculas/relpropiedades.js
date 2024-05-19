var tabla;

function init(){}

$(document).ready(function(){

    ConsultarPropiedades();

});

function ConsultarPropiedades()
{
    var parametros = {
        "Opc" : "ConsultarPropiedadesxUsuario"
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/propiedad.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            jQuery('#imgcargando').hide();
            jQuery('#divlstPropiedades').html(response)
            jQuery("#tblPropiedadesrelacionadas").DataTable(
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
       }
    });

}


function ActualizarEstadoPropiedad(id, estado)
{

  
    var parametros = {
        "Opc" : "ActualizarEstadoPropiedad",
        "id":id,
        "estado":estado
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/propiedad.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando').hide();
            ConsultarPropiedades();
       }
    });

}


function ConfirmDialogDelete(idPropiedad) {
    $('<div></div>').appendTo('body')
        .html('<div><h6>¿Desea eliminar la propiedad ' + idPropiedad+' ? </h6></div>')
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
                eliminar(idPropiedad);
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


function eliminar(idPropiedad){

    var parametros = {
        "Opc" : "EliminarPropiedad",
        "id": idPropiedad
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/propiedad.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
    
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando').hide();
            ConsultarPropiedades();


       }
    });

}



init();
