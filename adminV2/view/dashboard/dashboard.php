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

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <title>SAWPI | </title>

  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">

  <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

  <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

  <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <link href="../../build/css/custom.min.css" rel="stylesheet">

  <!-- Datatables -->

  <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../../build/css/custom.min.css" rel="stylesheet">
  <link href="../../build/css/amethyst.css" rel="stylesheet">

  <meta name="robots" content="index, nofollow">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <?php
        include '../menu/menu.php';
        ?>
      </div>

      <?php
      include '../menu/menusuperior.php';
      ?>


      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-3 col-sm-3">
            <div class="x_panel  carddashbord">
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <div class="row">
                    <div class="col-md-9 col-sm-9">
                      <div class="me-2">
                        <div class="display-5" id="divPropiedadesRegistradas">101.1K</div>
                        <div class="card-text">Prop. Registradas</div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <div class="icon-circle bg-primary text-white"><i class="fa fa-home"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="x_panel  carddashbord">
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <div class="row">
                    <div class="col-md-9 col-sm-9">
                      <div class="me-2">
                        <div class="display-5" id="divPropiedadesActivas">101.1K</div>
                        <div class="card-text">Prop. Activas</div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <div class="icon-circle bg-primary text-white" style="background-color:#298A08!important"><i class="fa fa-home"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-3">
            <div class="x_panel  carddashbord">
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <div class="row">
                    <div class="col-md-9 col-sm-9">
                      <div class="me-2">
                        <div class="display-5" id="divPropiedadesArriendo">101.1K</div>
                        <div class="card-text">Prop. Arriendo</div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <div class="icon-circle bg-primary text-white" style="background-color:#2A0A12!important"><i class="fa fa-home"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="col-md-3 col-sm-3">
            <div class="x_panel  carddashbord">
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <div class="row">
                    <div class="col-md-9 col-sm-9">
                      <div class="me-2">
                        <div class="display-5" id="divPropiedadesVenta">101.1K</div>
                        <div class="card-text">Prop. Venta</div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <div class="icon-circle bg-primary text-white" style="background-color:#B40404!important"><i class="fa fa-home"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-3 col-sm-3">
            <div class="x_panel  carddashbord">
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <div class="row">
                    <div class="col-md-9 col-sm-9">
                      <div class="me-2">
                        <div class="display-5" id="divUsuariosRegistrados">101.1K</div>
                        <div class="card-text">Usuarios Registrados</div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <div class="icon-circle bg-primary text-white" style="background-color:#298A08!important"><i class="fa fa-user"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <footer>
      <div class="pull-right">
        SAWPI - Software Inmobiliario Developed By <a href="https://desarrollaloya.com">Desarróllalo YA!</a>
      </div>
      <div class="clearfix"></div>
    </footer>

  </div>


  </div>

  </div>


  <script src="../../vendors/jquery/dist/jquery.min.js"></script>
  <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendors/fastclick/lib/fastclick.js"></script>
  <script src="../../vendors/nprogress/nprogress.js"></script>

  <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>

  <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>

  <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

  <script src="../../vendors/iCheck/icheck.min.js"></script>

  <script src="../../vendors/skycons/skycons.js"></script>

  <script src="../../vendors/Flot/jquery.flot.js"></script>
  <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
  <script src="../../vendors/Flot/jquery.flot.time.js"></script>
  <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
  <script src="../../vendors/Flot/jquery.flot.resize.js"></script>

  <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>

  <script src="../../vendors/DateJS/build/date.js"></script>

  <script src="../../vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="../../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

  <script src="../../vendors/moment/min/moment.min.js"></script>
  <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

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

  <script src="dashboard.js"></script>
</body>

</html>