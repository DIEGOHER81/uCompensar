<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Películas</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <!--Custom CSS Developed By Diego Hernández-->
    <link href="../../src/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" style="background-image:url('../../images/background.jpg'); background-size: cover;">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form" style="background-color:#FFF!important;padding:3%;border-radius:10px">
          <section class="login_content">
            <form id="formingreso" name="formingreso" method="post" action="">
              <h1>SENSA CINE</h1>
                <label style="font-size:0.9em!important;color:#0B3861">
                  Sistema de administración Web para Cinemas
                </label>
            
              <div>
                <input type="text" class="form-control" placeholder="Cód Usuario" required="" id="txtcoduser" name="txtcoduser">
              </div>
              <div>
                    <div class="password-input-container">
                      <input type="password" class="form-control" placeholder="Contraseña" required="" id="pwdlogin" name="pwdlogin">
                      <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></i>
                      <i class="toggle-password fa fa-eye-slash" onclick="togglePasswordVisibility()"></i>
                    </div>


              </div>
              <div id="divlstperfiles">
                <select id="lstperfiles" name="lstperfiles" class="form-control">
                    <option value="NA">Seleccione Perfil...</option>
                    <option value="2">Propietario</option>
                </select>    
              </div>
              <br>
              <div>
                  <img src="../images/loading.gif" style="width:90px;display:none" id="imgcargando" name ="imgcargando">
              </div>  
              <div>
                <input type="hidden" class="form-control" required="" id="txtActionIngreso" name="txtActionIngreso"/>            
                <span class="btn btn-info btn btn-info principalColor">
                    <i class="fa fa-rocket"></i>&nbsp;<input type="button" id="btnIngresar" name="btnIngresar" value = "Ingresar" class="classBtn_withimg">
                </span>  


              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">¿Eres nuevo?
                  <a href="#signup" class="to_register"> Crear cuenta </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2024 Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form" style="background-color:#FFF!important;padding:3%;border-radius:10px">
          <section class="login_content">
          <form id="formregistro" name="formregistro" method="post" action="">
              <h1>Registro</h1>
              <div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <input type="text" class="form-control" placeholder="Cod. Usuario" required=""  id="RegistroCodUser" name="RegistroCodUser"/>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <input type="text" class="form-control" placeholder="Identificación" required=""  id="RegistroIdusuario" name="RegistroIdusuario"/>
                    </div>
                </div>
                

              </div>
              <div>
                <input type="text" class="form-control" placeholder="Nombres" required="" id="RegistroNombres" name="RegistroNombres"/>
                <input type="text" class="form-control" placeholder="Apellidos" required="" id="RegistroApellidos" name="RegistroApellidos"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Correo" required="" id="RegistroCorreo" name="RegistroCorreo"/>
              </div>
              <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <input type="phone" class="form-control" placeholder="Celular" required="" id="RegistroCelular" name="RegistroCelular"/>
                    </div>
              </div>
              <br>
              <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <input type="password" class="form-control" placeholder="Password" required="" id="RegistroContraseña" name="RegistroContraseña"/>
                        <i class="toggle-password-register fa fa-eye" onclick="togglePasswordVisibility_register()"></i>
                        <i class="toggle-password-register fa fa-eye-slash" onclick="togglePasswordVisibility_register()"></i>
                    </div>
              </div>
              <div class="clearfix">
              <br>
              </div>
              <div>
                  <img src="../images/loading.gif" style="width:90px;display:none" id="imgcargandoRegistro" name ="imgcargandoRegistro">
              </div>  
              <div>
                <input type="hidden" class="form-control" required="" id="txtActionRegistro" name="txtActionRegistro"/>            
                <!--<button class="btn btn-info principalColor" id="btnRegistro"><i class="fa fa-arrow-circle-o-right"></i>&nbsp;Generar Registro</button>-->
                <span class="btn btn-info btn btn-info principalColor">
                    <i class="fa fa-arrow-circle-o-right"></i>&nbsp;<input type="button" id="btnRegistro" value = "Generar Registro" class="classBtn_withimg">
                </span>  
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">¿Ya tienes cuenta ?
                  <a href="#signin" class="to_register"> Ingresar </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2024 Todos los derechos reservados.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>


    <!--Ventana Modal Mensajes - Begin -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalscreen">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel2">Confirmación</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <p id="msnModal"></p>
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close" id="btnclose">
            </div>
          </div>
        </div>
      </div>

      <!--Ventana Modal Mensajes . End Code. -->
  </body>
</html>




  <!-- jQuery -->
  <script src="../../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="../../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../vendors/nprogress/nprogress.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../../build/js/custom.min.js"></script>


<script src="../login/index.js"></script>