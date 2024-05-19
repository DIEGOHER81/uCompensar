function init(){}

$(document).ready(function(){

    ConsultarPerfiles();
    ConsultarUsuario(jQuery("#txtUsuario").val())

    jQuery("#btnsave").click(function() {
             SaveTask();
    });


    jQuery("#btndeleteimg").click(function() {
        $("#imgprofile").attr('src','images/oso.png');
        $("#txtccname").val("");
    });


    jQuery("#btnCapture").click(function() {
        //doCapture();
        doCapture_opennewwindows();
    });


    jQuery("#btndownloadcard").click(function() {
        html2canvas($("#divmodelofirma"), {
            onrendered: function(canvas) {

               
                //canvas.height = window.innerHeight;
                theCanvas = canvas;
                canvas.toBlob(function(blob) {
                    saveAs(blob, "imagen.jpg",'image/jpeg',1); 
                });

                /*
                theCanvas = canvas;

       
                let imagedata = theCanvas.toDataURL("image/png");
                //jQuery("#divimgcard").appendChild(canvas);
                var newData = imagedata.replace('/^data:image/png/', "data:application/octet-stream");
                $("#btn-Convert-Html2Image").attr("download", "your_image.png").attr("href", newData);        
                //document.body.appendChild(canvas);
               */
              /*
                var canvasWidth = canvas.width;
                // canvas height
                var canvasHeight = canvas.height;
                $('.toCanvas').after(canvas);
                var img = Canvas2Image.convertToImage(canvas, canvasWidth, canvasHeight);
                $(".toPic").after(img);
                Canvas2Image.saveAsImage(canvas, canvasWidth, canvasHeight, 'png', f);
               */
                
            }
        });
    });

   

    jQuery("#btnqrcode").click(function() {
        createQR(1,6); //Codigo QrVCard
        createQR(2,5); //QR WebSite Card
        createQR(3,4); // WebSite
        jQuery("#vcardimag").attr('src', "vcardimg.webp");
        jQuery("#linkvcard").attr('href', "../../controller/vcard.php?u=" + btoa(jQuery("#txtUsuario").val()));
        create_imageofcard(jQuery("#txtUsuario").val());
        //jQuery("#btndownloadcard").show();
        jQuery("#btnCapture").show();
        //atob decode
    });

    jQuery("#btndownloadcard").click(function() {
       // jQuery("#btn-Convert-Html2Image").show();   
        //atob decode
    });
    
    //Disabling autoDiscover
    Dropzone.autoDiscover = false;

    $(function() {
        //Dropzone class
        var myDropzone_rut = new Dropzone("#txtcamaracomercio", {
            url: "upload.php",
            paramName: "file",
            dictDefaultMessage: "Arrastre el archivo (imagen), o presione clic para seleccionar uno. Tamaño recomendado Imagen 512 x 512 pixeles",
            maxFilesize: 2,//Tamaño dado en MB
            maxFiles: 1,   // Maximum Number of Files
            //acceptedFiles: "image/*",
            acceptedFiles: ".jpg",
            autoProcessQueue: false,
            addRemoveLinks:true,
            //acceptedFiles: ".jpeg,.jpg,.png,.gif",
    
            accept: function(file, done) {
                jQuery("#txtccname").val(file.name);
                done();
            }, 
    
            removedfile:function(){
                jQuery("#txtccname").val("");
            },
            init: function () {
    
                this.on("removedfile", function (file) {
                    file.previewElement.remove();
                    jQuery("#txtccname").addClass('dz-clickable'); // remove cursor
                    jQuery("#txtccname")[0].addEventListener('click', this.listeners[1].events.click);
                });
    
                this.on('maxfilesreached', function() {
                    jQuery("#txtccname").removeClass('dz-clickable'); // remove cursor
                    jQuery("#txtccname")[0].removeEventListener('click', this.listeners[1].events.click);
                });
            }
    
            
    
            
    
        });
        
        $('#btnsave').click(function(){           
                myDropzone_rut.processQueue();
        });
        
      });
});

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


function doCapture(){
   
  window.scrollTo(0,0);

  html2canvas(document.getElementById("divmodelofirma")).then(function(canvas){

//    console.log(canvas.toDataURL("image/jpeg",0.9));
    

    var ajax = new XMLHttpRequest();
    ajax.open("POST", "save-capture.php", true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("image=" + canvas.toDataURL("image/jpeg",0.9));

    ajax.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            console.log(responseText)
        }
    }


  });
}


function doCapture_opennewwindows(){

    window.scrollTo(0,0);

 

    html2canvas(document.getElementById("divmodelofirma")).then(function(canvas){
  
        //console.log(canvas.toDataURL("image/jpeg",0.9));
        const base64ImageData = canvas.toDataURL("image/jpeg",1);
        const contentType = 'image/jpeg';
        //console.log("Diego");
        //console.log(base64ImageData.substr(23));

        const byteCharacters =atob(base64ImageData.substr(23))
        const byteArrays = [];
        
        for (let offset = 0; offset < byteCharacters.length; offset += 1024) {
            const slice = byteCharacters.slice(offset, offset + 1024);
        
            const byteNumbers = new Array(slice.length);
            for (let i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
        
            const byteArray = new Uint8Array(byteNumbers);
        
            byteArrays.push(byteArray);
        }
        const blob = new Blob(byteArrays, {type: contentType});
        const blobUrl = URL.createObjectURL(blob);
        
        window.open(blobUrl, '_blank');
  
  
    });


   
}

function generateImage(){
    console.log('Entre');
    var bgcolor = '#18344d';
    var txtcolor = 'FFF';
    var anchoimagen = '450';
    var altoimagen = '220';
    var text = 'DIEGO HERNANDEZ';


    //var qstring = $('#bcol').val()+'_'+$('#tcol').val()+'_'+$('#img_width').val()+'_'+$('#img_height').val();
    var qstring = bgcolor +'_'+txtcolor+'_'+anchoimagen+'_'+altoimagen;
    var URL = 'createimage.php?s='+qstring+'&t='+text;
    $('.dynImage').attr('src', URL);
 //  $("#testimg").html(URL);

}




function SaveTask()
{

    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmtask").serialize(),
        url: '../../controller/adminuser.php',
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

            ConsultarUsuario(jQuery("#txtUsuario").val());
        }

    })
}


function ConsultarUsuario(coduser){

    var parametros = {
        "Opc" : "ConsultarUsuario",
        "usercode":coduser
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/adminuser.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(datos){
            jQuery('#imgcargando').hide();
            var dataJson = eval(jQuery.trim(datos));
                for(var i in dataJson){
                     
                    jQuery("#txtID").val(dataJson[i].identificacion);
                    jQuery("#txtNombre").val(dataJson[i].Nombres);
                    jQuery("#txtApellido").val(dataJson[i].Apellidos);
                    jQuery("#txtbday").val(dataJson[i].Birthday);
                    jQuery("#txtEmail").val(dataJson[i].email);
                    jQuery("#txtorganization").val(dataJson[i].Empresa);
                    jQuery("#txtphone").val(dataJson[i].telefono);
                    jQuery("#txtcellphone").val(dataJson[i].celular);
                    jQuery("#txturl").val(dataJson[i].url);
                    jQuery("#txtAddress").val(dataJson[i].direccion);
                    jQuery("#txtCiudad").val(dataJson[i].Ciudad);
                    jQuery("#txtTitle").val(dataJson[i].cargo);
                    jQuery("#txtNotes").val(dataJson[i].notas);
                    jQuery("#txtpwd").val(dataJson[i].pwduser);

                    ValidarArchivo(coduser);

                    /*
                    if (dataJson[i].estado == "A"){
                        /*
                            jQuery("#stateActive").prop('checked', 'checked');
                            jQuery("#idstateinactive").attr('checked', true);
                            jQuery("#lblstateactive").addClass('active focus')
                        */
                     /*   jQuery("#stateActive").click();
                    }else {
                        jQuery("#idstateinactive").click();
                    }

                    */


               }
       }
    });
}


function create_imageofcard(coduser){
    var parametros = {
        "Opc" : "ConsultarUsuario",
        "usercode":coduser
        };
    jQuery.ajax({
        data:  parametros,
        url:    '../../controller/adminuser.php',
        type:  'post',
        beforeSend: function () {
            jQuery('#imgcargando').show();
        },
       success: function(datos){
            jQuery('#imgcargando').hide();
            var dataJson = eval(jQuery.trim(datos));
                for(var i in dataJson){
                     
                    jQuery("#nameuser").text(dataJson[i].NombreCompleto);
                    jQuery("#jobtitle").text(dataJson[i].cargo);
                    jQuery("#lblemail").text(dataJson[i].email);
                    jQuery("#lblcellphone").text(dataJson[i].celular);
                    jQuery("#lblphone").text(dataJson[i].telefono);
                    jQuery("#lbladdress").text(dataJson[i].direccion);
                    jQuery("#lblcity").text(dataJson[i].Ciudad);
                    jQuery("#lblurl").text(dataJson[i].url);
               }
            
            jQuery("#QRCardImg").attr('src', '../../controller/images/vcardpage'+coduser+'.png');
            jQuery("#divmodelofirma").show();   
           
            
       }
    });

}


function ValidarArchivo(coduser){
    let cadena = "images/IMGPERFIL_" + coduser+".jpg";

    if (coduser != "") {
        $.ajax({
            url: cadena,
            type: 'HEAD',
            error: function() 
            {
                $("#imgprofile").attr('src','images/oso.png');
            },
            success: function() 
            {
                //jQuery('#linkfactura').prop("href", cadena+jQuery.trim(nrocotizacion[1]));
                //window.open(cadena);
                $("#imgprofile").attr('src',cadena);
                $("#txtccname").val(coduser);
               
            }
        });
    } else {
        $("#imgprofile").attr('src','images/oso.png');
    }

}


function createQR(control,textcontrol)
{
    var parametros = {
        "Opc" : "CreateQRText",
        "textQR" :textcontrol
        };
    
    
        jQuery.ajax({
            data:  parametros,
            url:    '../../controller/QRGenerate.php',
            type:  'post',
            beforeSend: function () {
            
            },
        success: function(response){
            if (control == 1)
            {
               //jQuery("#QRWebSite").attr("src", "url.png");
               jQuery("#QRvCard").html(response);
            }
            if (control == 2){
                jQuery("#QRWebvCard").html(response);
             }
           
            if (control == 3)
             {
                //jQuery("#QRWebSite").attr("src", "url.png");
                jQuery("#QRWebSite").html(response);
             }

            
    
        }
        });

}

function Actualizar(){

  
    jQuery.ajax({
        dataType: 'html',
        cache: false,
        data: jQuery("#frmtask").serialize(),
        url: '../../controller/adminuser.php',
        type: 'post',
        beforeSend: function() {
            /*blind,bounce,clip,drop,explode,fold,highlight,puff,pulsate,scale,shake,size,slide*/
            /*jQuery('#imgcargando').show();*/
            jQuery('#imgcargando').show();
        },
        success: function(response) {
            jQuery("#msnModal").html(response);
            jQuery("#modalscreen").modal();
            //jQuery('#imgcargando').hide();
        }

    })

  }

init();
