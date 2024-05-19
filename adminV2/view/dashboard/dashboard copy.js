var tabla;

function init(){}

$(document).ready(function(){
  ConsultarProximosEventos();
});

function ConsultarProximosEventos(){

    var parametros = {
        "Opc" : "ConsultarProximosEventos",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/agendamiento.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            jQuery("#divtablusuarios").html(response);
            jQuery("#tblusuariosadmon").DataTable(
            {
                "order": [[ 0, "desc" ]]
                ,dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 Registros', '25 Registros', '50 Registros', 'Mostrar Todo' ]
                ],
                buttons: [
                    //'copy', 'csv', 'excel', 'pdf', 'print'
                    { extend: 'pageLength', className: 'btn-success' },
                    { extend: 'copy', className: 'btn-outline-secondary' },
                    { extend: 'csv', className: 'btn-success' },
                    { extend: 'excel', className: 'btn-primary' },
                    { extend: 'pdf', className: 'btn-warning' },
                    { extend: 'print', className: 'btn-danger' },
                ]
            }

           );

       }
    });

}

init();
