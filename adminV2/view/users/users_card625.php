<?php

@session_start();
  
 
if ($_SESSION['coduser'] == "")
{
  header('Location: ../Login/index.php');
  exit();
}

$filevcardimage = "../../controller/images/vcardpage".$_SESSION['coduser'].".png";



$file_profile =  "images/IMGPERFIL_".$_SESSION['coduser'].".jpg";

if (file_exists($file_profile)) {
  $photo_profile = $file_profile;
} else {
  $photo_profile = "images/proelco-logo.webp";
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <title>Amethyst CRM | Usuarios </title>

  <!-- Bootstrap -->
  <link href="../../public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../../public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../../public/vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../../public/build/css/custom.min.css" rel="stylesheet">
  <link href="../../public/build/css/amethyst.css" rel="stylesheet">
  <link href="../../public/build/css/select2.min.css" rel="stylesheet">
  <link href="../../public/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <!-- Datatables -->

  <link href="../../public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../../public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../../public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../../public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">



</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <?php
        include '../menu/menu.php';
        ?>
      </div>

      <!-- top navigation -->
      <?php
      include '../menu/menusuperior.php';
      ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="x_panel">
              <div class="x_title">
                <h2>Administración de Perfil</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
          </div>
          <div class="row" style="display:none" id="imgcargando" name ="imgcargando">
                <div class="col-md-12 col-sm-12 text-center">
                    <img src="../images/loading.gif" style="width:180px">
                </div>
          </div>    
          <div class="clearfix"></div>
          <div class="row" id="main_form">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <form  id="frmtask" name="frmtask" action="#" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12">Usuario</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" id="txtUsuario" name="txtUsuario" required="required" class="form-control" readonly value="<?php echo $_SESSION['coduser']?>" onchange="ConsultarUsuario()">
                              <input type="hidden" id="lstperfiles" name="lstperfiles" readonly value="<?php echo $_SESSION['perfil']?>">
                            </div>
                        </div>
                      </div>

                      <div class="row">  
                          <div class="col-md-12 col-sm-12 col-xs-12 ">        
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">No.Identificación<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" id="txtID" name="txtID" required="required" class="form-control" onblur="">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre(s) <span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12 ">
                              <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control ">
                            </div>
                        </div>    
                      </div>  

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellido(s)<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" id="txtApellido" name="txtApellido" required="required" class="form-control"  onblur="">
                            </div>
                          </div>
                      </div>
                      
                      
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha de cumpleaños <span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="date" name="txtbday" id="txtbday" value="" class="form-control"/>
                            </div>
                        </div>
                      </div>

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 ">      
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="email" id="txtEmail" name="txtEmail" required="required" class="form-control ">
                            </div>
                          </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Organización<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" name="txtorganization" id="txtorganization" value="" class="form-control"/>
                            </div>
                        </div>
                      </div>

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Teléfono<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5">
                              <input type="text" id="txtphone" name="txtphone" required="required" class="form-control ">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Celular<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" name="txtcellphone" id="txtcellphone" value="" class="form-control"/>
                            </div>
                        </div>
                      </div>

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sitio Web<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" id="txturl" name="txturl" required="required" class="form-control" onblur="">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" name="txtAddress" id="txtAddress" value="" class="form-control"/>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ciudad<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <input type="text" name="txtCiudad" id="txtCiudad" value="" class="form-control"/>
                            </div>
                        </div>
                      </div>

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 "> 
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cargo<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="text" id="txtTitle" name="txtTitle" required="required" class="form-control ">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Notas<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <textarea class="form-control" name="txtNotes" id="txtNotes"></textarea>
                            </div>
                        </div>
                      </div>

                      <div class="row">        
                         <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña<span class="required"></span></label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <input type="password" id="txtpwd" name="txtpwd" required="required" class="form-control ">
                            </div>
                         </div>
                      </div>
                      <div class="row">   
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <div style="height:10px"></div>
                            <div class="item form-group">
                                
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="txtcamaracomercio">Foto de Perfil <span class="required"></span></label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <div action="form_upload.html" class="dropzone" id="txtcamaracomercio" name="txtcamaracomercio"></div>
                                  <input type="text" name="txtccname" id="txtccname" value="" class="form-control " readonly/>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                  <div style="border:1px solid #c2c2c2;  min-height: 150px;"> 
                                     <img src="" id="imgprofile" style="width:100%">
                                     
                                  </div>
                                  <input type="button" name="btndeleteimg" id="btndeleteimg" value="Borrar Imagen" class="btn btn-danger" style="width:100%"/>
                                </div>
                            </div>
                          </div>
                      </div>  
                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modelo de Firma Digital<span class="required"></span></label>
                            
                            <div class="col-md-5 col-sm-5 col-xs-12" id="divmodelofirma" style="display:none;background:#18344d">
                                <div style="background:#18344d; padding:5%"  id="divimagenfirma">
                                  <div class="row">
                                    <div class="col-md-7 col-sm-7 col-xs-12">  
                                        <img src="../menu/proelco-logo.webp" class="img-responsive" style="width:180px;">
                                        <p style="color:#FFF">
                                            </br>
                                            <label style="font-size:1.7em;" id="nameuser"><strong>Diego Alberto Hernandez Vargas</strong></label></br>
                                            <label style="font-size:1.5em;margin-top:-10px;" id="jobtitle"><strong>Ingeniero/a</strong></label></br>
                                            <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12" style="color:#FFF">
                                                <i class="fa fa-envelope" style="margin-bottom:0;font-size:1.2em"></i>&nbsp;<label id="lblemail" style="margin-bottom:0;font-size:1.2em" >dahernandez@desarrollaloya.com </label></br>
                                                <i class="fa fa-mobile"style="margin-bottom:0;font-size:1.2em"></i>&nbsp;<label id="lblcellphone" style="margin-bottom:0;font-size:1.2em">(+57) 3012550175 </label></br>
                                                <i class="fa fa-phone" style="margin-bottom:0;font-size:1.2em"></i>&nbsp;<label id="lblphone" style="margin-bottom:0;font-size:1.2em"> (+57) 3012550175 </label></br>
                                                <i class="fa fa-map-marker"style="margin-bottom:0;font-size:1.2em"></i>&nbsp;<label id="lbladdress" style="margin-bottom:0;font-size:1.2em"> (+57) 3012550175 </label></br>
                                                <i class="fa fa-globe"style="margin-bottom:0;font-size:1.2em"></i>&nbsp;<label id="lblurl" style="margin-bottom:0;font-size:1.2em"> (+57) 3012550175 </label></br>
                                                <label id="lblcity" style="margin-bottom:0;font-size:1.2em">&nbsp;&nbsp; Bogota </label></br>
                                             
                                              </div>
                                              <!--
                                              <div class="col-md-3 col-sm-3 col-xs-12">
                                                <br><br><br>
                                                  <img src=" ../../controller/images/url9.png" style="width:80%">
                                              </div>
                                              -->
                                            </div>

                                            
                                        </p>
                                    </div>    
                                    <div class="col-md-5 col-sm-5 col-xs-12">  
                                      <div style="background-color:#FFF;font-size:1.3em" class="text-center">
                                          </br>
                                           Usa tu lector de QR </br> Accede a mi Tarjeta Virtual</br>
                                          <img src="<?php echo $filevcardimage; ?>" style="width:90%" id="QRCardImg">
</br>
                                      </div>
                                    </div>  
                                  </div>  
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 col-sm-3 text-center col-xs-12 "></div>
                        <div class="col-md-6 col-sm-12 col-xs-12 ">
                            <br>
                            <input type="button" class="btn btn-warning" style="background-color:#145A32;color:#FFF;display:none" value="Generar Imagen Tarjeta" id="btndownloadcard">
                            <div id="img-out"></div>
                            <a id="btn-Convert-Html2Image" href="#" class="btn btn-success" style="display:none">Descargar Imagen</a>    

                            <input type="button" class="btn btn-warning" style="background-color:#145A32;color:#FFF;display:none" value="Generar Imagen de descarga" id="btnCapture">
                        </div>
                        <div class="col-md-3 col-sm-3 text-center col-xs-12 "></div>

                      </div>

                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 text-center col-xs-12 ">
                          <button class="btn btn-primary" type="reset" id="btnCancel">Cancelar</button>
                          <input type="button" class="btn btn-success" value="Guardar" id="btnsave">
                          <input type="button" class="btn btn-warning" value="Generar Codigos" id="btnqrcode">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div id="divimgcard"></div>
                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <label class="col-form-label col-md-12 col-sm-12 col-xs-12" for="first-name">Tarjeta de Contacto<span class="required"></span></label>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <a href="" id="linkvcard"><img src="" id="vcardimag" class="img-responsive" style="width:30%"></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 text-center ">
                            <label class="col-form-label col-md-12 col-sm-12 col-xs-12" for="first-name">QR de Contacto<span class="required"></span></label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div id="QRvCard">
                                  
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <label class="col-form-label col-md-12 col-sm-12 col-xs-12" for="first-name">QR de Sitio Web<span></span></label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="QRWebSite">
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                            <label class="col-form-label col-md-12 col-sm-12 col-xs-12" for="first-name">QR de Tarjeta Digital<span class="required"></span></label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                  <div id="QRWebvCard">
                                  
                                  </div>
                            </div>
                          </div>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Ventana Modal Mensajes - Begin -->
          <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalscreen">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel2">Confirmación</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <p id="msnModal"></p>
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                </div>
              </div>
            </div>
          </div>

          <!--Ventana Modal Mensajes . End Code. -->



        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Amethyst - CRM Developed By <a href="https://desarrollaloya.com">Desarróllalo YA!</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../../public/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="../../public/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../public/vendors/nprogress/nprogress.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../../public/build/js/custom.min.js"></script>

  <!-- Datatables -->
  <script src="../../public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../../public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../../public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../../public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../../public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../../public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../../public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../../public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../../public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../../public/vendors/dropzone/dist/min/dropzone.min.js"></script>

  <script src="../../public/build/js/html2canvas.js"></script>
  <!-- Custom js-->
  <script type="text/javascript" src="./users.js"></script>
  <script src="../../public/build/js/amethyst.js"></script>

  <!--Select-->
  <script src="../../public/build/js/select2.min.js"></script>

  <!--paso de div to jpg-->
  <script src="../../public/build/js/fileserver.js"></script>

  <script src="../../public/build/js/canvas2image.js"></script>

</body>

</html>