$(document).ready(function(){
    ConsultarPerfiles();

    jQuery("#btnIngresar").click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        RealizarIngreso();
    });


    jQuery("#btnRegistro").click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        RealizarRegistro();
    });

    jQuery("#btnclose").click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        console.log("voy a redireccionar");
        window.location.href = "login.php";
    });
    
    

/*
    jQuery("#btnRegistro").one('click',function() {
        console.log("dos veces el click");
        RealizarRegistro();
    });
*/

});

function togglePasswordVisibility() {
    const passwordInput = document.getElementById('pwdlogin');
    const eyeIcons = document.getElementsByClassName('toggle-password');
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcons[0].style.display = 'none'; // Mostrar el ícono del ojo abierto
      eyeIcons[1].style.display = 'block'; // Ocultar el ícono del ojo cerrado
    } else {
      passwordInput.type = 'password';
      eyeIcons[0].style.display = 'block'; // Mostrar el ícono del ojo abierto
      eyeIcons[1].style.display = 'none'; // Ocultar el ícono del ojo cerrado
    }
  }
  
function togglePasswordVisibility_register() {
    const passwordInput = document.getElementById('RegistroContraseña');
    const eyeIcons = document.getElementsByClassName('toggle-password-register');
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcons[0].style.display = 'none'; // Mostrar el ícono del ojo abierto
      eyeIcons[1].style.display = 'block'; // Ocultar el ícono del ojo cerrado
    } else {
      passwordInput.type = 'password';
      eyeIcons[0].style.display = 'block'; // Mostrar el ícono del ojo abierto
      eyeIcons[1].style.display = 'none'; // Ocultar el ícono del ojo cerrado
    }
  }  
  

function ConsultarPerfiles(){

    var parametros = {
        "Opc" : "ConsultarPerfilesActivos",

        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/login.php',
        type:  'post',
        beforeSend: function () {

        },
       success: function(response){
            jQuery("#divlstperfiles").html(response);
       }
    });

}


function RealizarRegistro()
{

    console.log("Process: Save a User");
    jQuery("#txtActionRegistro").val("RealizarRegistro");      
    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#formregistro").serialize(),
        url: '../../controller/login.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            jQuery('#imgcargando').show();
                

        },
        success: function(response) {
                jQuery("#txtActionRegistro").val("");
                jQuery("#msnModal").html(response);
                jQuery("#modalscreen").modal();
                //window.location.href = "login.php";
        }

    })
}



function RealizarIngreso()
{
    jQuery("#txtActionIngreso").val("RealizarIngreso");   
    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#formingreso").serialize(),
        url: '../../controller/login.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            jQuery('#imgcargando').show();
            

        },
        success: function(response) {
              if (response == "OK") {
                  window.location.href = "../dashboard/dashboard.php";
              } else {
                  jQuery("#msnModal").html(response);
                  jQuery("#modalscreen").modal();
              }

              jQuery('#imgcargando').hide();


        }

    })
}

