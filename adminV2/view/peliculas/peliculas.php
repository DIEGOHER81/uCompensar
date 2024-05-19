<?php

@session_start();


if ($_SESSION['coduser'] == "") {
  header('Location: ../login/login.php');
  exit();
}

$idPropiedad = "";
if (isset($_GET['id'])) {
  $idPropiedad = $_GET['id'];
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

  <title>SAWPI</title>

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

  <!--calendario-->
  <link href="../../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
  <link href="../../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">

  <!-- include summernote css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />

  <!--Custom CSS Developed By Diego Hernández-->
  <link href="../../src/css/custom.css" rel="stylesheet">


  <script type="text/javascript" src="https://www.bing.com/api/maps/mapcontrol?callback=loadMapScenario" async defer></script>
  
  <style>
    #mapContainer {
      width: 100%;
      height: 400px;
    }
  </style>


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
              <div class="page-title">
                <div class="title_left">
                  <h2>Gestión Comercial / Administración de Películas</h2>
                </div>
              </div>
              <form method="post" action="" id="frmPropiedad" name="frmPropiedad">
                <!-- Especifícaciones de las propiedades -->
                <div class="x_panel">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2><i class="fa fa-bars"></i> <small>Especificaciónes generales de la película</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-2 col-sm-2 col-xs-12" for="first-name">ID Película<span class="required"></span></label>
                              <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="idPropiedad" name="idPropiedad" maxlength="100" class="form-control" readonly value="<?php echo $idPropiedad; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-2 col-sm-2 col-xs-12" for="first-name">Título de la Película<span class="required"></span></label>
                              <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="txttituloPropiedad" name="txttituloPropiedad" maxlength="100" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-2 col-sm-2 col-xs-12" for="first-name">Descripción de la Película<span class="required"></span></label>
                              <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea id='makeMeSummernote' name='DescripcionPropiedad' class="form-control"></textarea><br>
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="col-form-label col-md-6 col-sm-6 col-xs-12" for="first-name">Genero de Película<span class="required"></span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="divlsttipoPropiedad">
                                  <div id="lstTipoPropiedad">
                                    <select class="form-control"></select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Clasificación General<span class="required"></span></label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <div id="divlstObjetivoPropiedad">
                                  <select class="form-control" id="lstObjetivoPropiedad" name="lstObjetivoPropiedad">
                                    <option value="NA">Seleccione Objetivo...</option>
                                    <option value="5">Cartelera</option>
                                    <option value="6">Pronto</option>
                                    <option value="7">Cine Alternativo</option>
                                    <option value="8">Comida</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Estado Pelìcula<span class="required"></span></label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <div id="divlstestadoPropiedad">
                                  <select class="form-control" id="lstestadoPropiedad" name="lstestadoPropiedad">
                                    <option value="NA">Seleccione Estado...</option>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Moneda<span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="txtMoneda" name="txtMoneda" class="form-control">
                                  <option value="1">COP</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Precio Venta Boleta <span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="txtprecioVenta" name="txtprecioVenta" class="form-control" value="0">
                              </div>
                            </div>

                          </div>
                          <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Precio Preventa <span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="txtprecioDia" name="txtprecioDia" class="form-control" value="0">
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Precio Socio <span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="txtprecioMes" name="txtprecioMes" class="form-control" value="0">
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Precio Especial <span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="txtprecioDia-ta" name="txtprecioDia-ta" class="form-control" value="0">
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="col-form-label col-md-4 col-sm-4 col-xs-12" for="first-name">Precio Adultos Mayores <span class="required"></span></label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" id="txtprecioMes-ta" name="txtprecioMes-ta" class="form-control" value="0">
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ./ Especifícaciones de las propiedades -->
                                <!-- Características de las propiedades -->
                                <div class="x_panel">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2><i class="fa fa-bars"></i> <small>Características de la propiedad</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="divlstcaracteristicas">
                                      <select class="form-control" id="lstcaracteristicas" name="lstcaracteristicas" style="width:100%" multiselect>
                                        <option value='0'>Seleccione...</option>
                                      </select>
                                    </div>
                                    <br />
                                    <input type="text" id="txtvalorCaracteristica" name="txtvalorCaracteristica" required="required" style="width:100%" class="form-control" onblur="" placeholder="Valor Característica">
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item form-group">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-form-label col-md-12 col-sm-12 col-xs-12" for="first-name">Especificación Contractual de la característica(800 Caracteres) <span class="required"></span></label>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                          <textarea id='txtDescripcionContractual' name='txtDescripcionContractual' class="form-control" maxlength="800"></textarea><br>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <span class="btn btn-info btn btn-info principalColor" style="width: 100%;">
                                      <i class="fa fa-plus"></i>&nbsp;<input type="button" id="addproduct" name="addproduct" value="Agregar Característica" class="classBtn_withimg">
                                    </span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="tbllstCaracteristicas">
                                      <table id="tblCaracteristicas" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                          <th>Id</th>
                                          <th>Característica</th>
                                          <th>Valor</th>
                                          <th>Acciones</th>
                                        </thead>
                                        <tbody>
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
                </div>
                <!-- ./ Características de las propiedades -->
                <!-- Galeria de Fotos -->
                <div class="x_panel">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2><i class="fa fa-bars"></i> <small>Galería / SEO</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imagen Principal<span class="required"></span></label>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12">
                              <div class="dropzone" id="txtImagenPrincipal" name="txtImagenPrincipal"></div>
                              <input type="hidden" name="txtImagenPrincipalName" id="txtImagenPrincipalName" value="" class="form-control " readonly />
                              <button type="button" class="btn btn-info" style="width:100%" id="btnAdicionarImagenPrincipal" name="btnAdicionarImagenPrincipal"><i class="fa fa-cloud-upload"></i>&nbsp;Establecer Imagen Principal</button>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Galería de Fotos<span class="required"></span></label>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div id="divgallery"></div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12">
                              <div class="dropzone" id="txtGaleria" name="txtGaleria"></div>
                              <input type="hidden" name="txtGaleriaName" id="txtGaleriaName" value="" class="form-control " readonly />
                              <button type="button" class="btn btn-info" style="width:100%" id="btnAdicionartxtGaleria" name="btnAdicionartxtGaleria"><i class="fa fa-cloud-upload"></i>&nbsp;Agregar Galería de Fotos</button>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Url Video<span class="required">(Youtube) </span></label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="txtVideoPropiedad" name="txtVideoPropiedad" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="first-name">Etiquetas SEO<span class="required"> (Incluya las palabras separadas por una coma)</span></label>
                              <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="txtEtiquetasSeo" name="txtEtiquetasSeo" class="form-control">
                              </div>
                            </div>
                          </div>

                          <div class="item form-group">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ./ Galería de Fotos -->
                <div class="row" style="display:none" id="imgcargando2" name="imgcargando2">
                  <div class="col-md-12 col-sm-12 text-center">
                    <img src="../images/loading.gif" style="width:180px">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <span class="btn btn-info btn btn-info principalColor" style="background-color: #1F618D!important;">
                      <i class="fa fa-save"></i>&nbsp;<input type="button" id="btnsave" name="btnsave" value="Almacenar Información relacionada de la propiedad" class="classBtn_withimg">
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->
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
            <input type="button" class="btn btn-secondary" data-dismiss="modal"  id="closeAndRedirect" value="Close">
          </div>
        </div>
      </div>
    </div>
    <!--Ventana Modal Mensajes . End Code. -->

    <!--Ventana Modal imagen - Begin -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="" alt="Imagen grande" id="modalImage" class="img-fluid">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!--Ventana Modal imagen - end code -->


    <!-- footer content -->
    <footer>
      <div class="pull-right">
        CRM Developed By <a href="https://desarrollaloya.com">Desarróllalo YA! By Diego Hernández</a>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    <!--ventana modal -->
  </div>
  </div>

  <!-- jQuery -->
  <script src="../../vendors/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap -->
  <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="../../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../vendors/nprogress/nprogress.js"></script>

  <script src="../../vendors/moment/min/moment.min.js"></script>
  <script src="../../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
  <!-- Custom js-->
  <script type="text/javascript" src="propiedades.js"></script>

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

  <!-- include summernote js-->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


  <!--calendar-->










</body>

</html>