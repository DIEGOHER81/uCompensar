var tabla;

function init(){}

$(document).ready(function(){

    ConsultarDatos();

    $( "#btnSaveInformation" ).click(function() {
        if (jQuery("#txtDescripcion").val()!=""){
            SaveObjetivo();
        } else {
            jQuery("#msnModal").html("Revise por favor la información de los campos indicados");
            jQuery("#modalscreen").modal();
        }

    });


});


function ConsultarDatos(){
    
    var parametros = {
        "Opc" : "ConsultarObjetivos",
    };


    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/objetivoPropiedad.php',
        type:  'post',
        beforeSend: function () {
        
        },
       success: function(response){
    
            jQuery("#divtblobjetivos").html(response);
            jQuery("#tblObjetivos").DataTable(
                {
                    "order": [[ 0, "desc" ]]
                    ,dom: 'lfrtip',
                    //,dom: 'flpt',
                    //,"dom": '<"wrapper"flpt>',
                    responsive:true,
                    lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10', '25', '50', 'Mostrar Todo' ]
                    ],
                    buttons: [
                    ]
                }
    
            );


       }
    });

}


function SaveObjetivo()
{

    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmObjetivos").serialize(),
        url: '../../controller/objetivoPropiedad.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#imgcargando').show();

        },
        success: function(response) {
            
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            jQuery('#imgcargando').hide();
            ConsultarDatos();
        }

    })
}

function ConfirmDialogDelete(idtipo) {
    $('<div></div>').appendTo('body')
        .html('<div><h6>¿Desea eliminar el objetivo de propiedad ' + idtipo+' ? </h6></div>')
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


function eliminar(id){

    var parametros = {
        "Opc" : "DeleteObjetivo",
        "id":id
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/objetivoPropiedad.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(response){
            jQuery('#imgcargando').hide();
            ConsultarDatos();
            
       }
    });
}



init();
