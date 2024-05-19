var tabla;

function init(){}

$(document).ready(function(){

    ConsultarDatos();

    $( "#btnSaveInformation" ).click(function() {
        if (jQuery("#txtDescripcion").val()!=""){
            Save_Information();
        } else {
            jQuery("#myModalLabel2").css({"color":"#610B0B","font-weigth":"bold"});
            jQuery("#myModalLabel2").text("ERROR");
            jQuery("#msnModal").html("No ha ingresado la descripción del tipo de entrega");
            jQuery("#modalscreen").modal();
        }

    });


});


function ConfirmDialogDelete(idtipo) {
    $('<div></div>').appendTo('body')
        .html('<div><h6>¿Desea eliminar el tipo de propiedad ' + idtipo+' ? </h6></div>')
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
                eliminar(idtipo);
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



function eliminar(idtipo)
{
    
    var parametros = {
        "Opc" : "EliminarTipos",
        "idtipo": idtipo
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/tiposPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            jQuery("#myModalLabel2").css({"color":"#088A08","font-weigth":"bold"});
            jQuery("#myModalLabel2").text("Confirmación");
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            ConsultarDatos();
            
       }
    });


}

function ConsultarDatos(){
    
    var parametros = {
        "Opc" : "ConsultarTipos",
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/tiposPropiedad.controller.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
            jQuery("#divlsttipospropiedad").html(response);
            jQuery("#tbltipospropiedad").DataTable(
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




function Save_Information()
{

    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmtipopropiedad").serialize(),
        url: '../../controller/tiposPropiedad.controller.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#imgcargando').show();

        },
        success: function(response) {
            jQuery("#myModalLabel2").css({"color":"#610B0B","font-weigth":"bold"});
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando').hide();
            ConsultarDatos();

            


        }

    })
}


init();
