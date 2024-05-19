<?php

@session_start();


if ($_SESSION['coduser'] == "") {
  header('Location: ../Login/login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Peliculas</title>

  <!-- Bootstrap -->
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../../build/css/custom.min.css" rel="stylesheet">
  <link href="../../build/css/amethyst.css" rel="stylesheet">

  <link href="../../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <!-- Datatables -->

  <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <!-- include summernote css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!--Custom CSS Developed By Diego Hernández-->
  <link href="../../src/css/custom.css" rel="stylesheet">


  




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
          <div class="page-title">
            <div class="title_left">

            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row" style="display:none" id="imgcargando" name="imgcargando">
            <div class="col-md-12 col-sm-12 text-center">
              <img src="../images/loading.gif" style="width:180px">
            </div>
          </div>
          <div class="row hideform2" id="main_form">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa fa-bars"></i> <small>Configuración / Características generales Pelìcula</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <form id="frmCaracteristicas" name="frmCaracteristicas" method="post" action="">
                          <div class="row">        
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Descripción<span class="required"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" id="txtDescripcion" name="txtDescripcion" required="required" class="form-control ">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Genero<span class="required"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <div id="lstTipoPropiedad">
                                      <select class="form-control"></select>
                                  </div>  
                                
                                </div>
                            </div>
                          </div>
                          <div class="row">        
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <br />
                                <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado<span class="required"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div id="divstate" class="btn-group" data-toggle="buttons">
                                      <label class="btn btn-yes active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" id="lblstateactive">
                                          <input type="radio" name="state" value="A" class="join-btn" id="stateActive"> &nbsp; Activo &nbsp;
                                      </label>
                                      <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" id="lblstateinactive">
                                          <input type="radio" name="state" value="I" class="join-btn" id="idstateinactive"> Inactivo
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <br />
                                <label class="col-form-label col-md-5 col-sm-5 col-xs-12" for="first-name">Característica Base<span class="required"></span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div id="divstate" class="btn-group" data-toggle="buttons">
                                      <label class="btn btn-yes btn-yes active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" id="lblstateactive">
                                          <input type="radio" name="base" value="S" class="join-btn" id="stateActive"> &nbsp; Si &nbsp;
                                      </label>
                                      <label class="btn btn-danger" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" id="lblstateinactive">
                                          <input type="radio" name="base" value="N" class="join-btn" id="idstateinactive"> No
                                      </label>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">        
                              <div class="col-md-12 col-sm-12 col-xs-12 text-center">    
                                  <br />    
                                  <span class="btn btn-info btn btn-info principalColor" style="width:100%;background-color: #1F618D!important;">
                                      <i class="fa fa-save"></i>&nbsp;<input type="button" id="btnsave" name="btnsave" value = "Almacenar Información" class="classBtn_withimg" >
                                  </span>  
                              </div>
                          </div>
                        </form>  
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="x_panel">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2><i class="fa fa-bars"></i> <small>Relación de Características</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div id="divtblCaracteristicas">
                            <table id="tblCaracteristicas" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Genero</th>
                                <th>Estado</th>
                                <th>¿Es Base?</th>
                                <th>Acciones</th>
                              </thead>
                              <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
            SAWPI - Software Inmobiliario Developed By <a href="https://desarrollaloya.com">Desarróllalo YA!</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
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
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar" id="btnclose">
            </div>
          </div>
        </div>
      </div>

      <!--Ventana Modal Mensajes . End Code. -->
  </div>

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

  <!-- Datatables -->
  <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


  <script src="../../vendors/dropzone/dist/min/dropzone.min.js"></script>

  <!-- Custom js-->
  <script type="text/javascript" src="caracteristicas.js"></script>
  <script src="../../build/js/jquery-ui.min.js"></script>


</body>

</html>