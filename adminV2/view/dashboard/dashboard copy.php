
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
  <title>Amethyst CRM | </title>

  <link href="../../public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="../../public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link href="../../public/vendors/nprogress/nprogress.css" rel="stylesheet">

  <link href="../../public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <link href="../../public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

  <link href="../../public/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

  <link href="../../public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <link href="../../public/build/css/custom.min.css" rel="stylesheet">
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

      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/img.jpg" alt="">John Doe
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="javascript:;"> Profile</a>
                  <a class="dropdown-item" href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                  <a class="dropdown-item" href="javascript:;">Help</a>
                  <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
              <li role="presentation" class="nav-item dropdown open">
                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <div class="text-center">
                      <a class="dropdown-item">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>


      <div class="right_col" role="main">

        <div class="row" style="display: inline-block;">
          <div class="tile_count">
            <div class="col-md-4 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Clientes</span>
              <div class="count">2500</div>
              <span class="count_bottom"><i class="green">4% </i> de la última semana</span>
            </div>
            <div class="col-md-4 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Promedio tiempo cotización</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> de la última semana</span>
            </div>
            <div class="col-md-4 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Citas Asignadas</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> De la última semana</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Resumen de transacciones <small>Progreso Semanal</small></h2>
                <div class="filter">
                  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>August 1, 2021 - August 6, 2021</span> <b class="caret"></b>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="col-md-9 col-sm-12 ">
                  <div class="demo-container" style="height:280px">
                    <div id="chart_plot_02" class="demo-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" width="1122" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 898px; height: 280px;"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 81px; text-align: center;">08/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 166px; text-align: center;">10/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 250px; text-align: center;">12/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 335px; text-align: center;">14/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 420px; text-align: center;">16/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 504px; text-align: center;">18/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 589px; text-align: center;">20/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 674px; text-align: center;">22/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 758px; text-align: center;">24/08/21</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 74px; top: 265px; left: 843px; text-align: center;">26/08/21</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 247px; left: 12px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 206px; left: 6px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 165px; left: 6px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 124px; left: 6px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 83px; left: 6px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 42px; left: 0px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 0px; text-align: right;">120</div></div></div><canvas class="flot-overlay" width="1122" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 898px; height: 280px;"></canvas><div class="legend"><div style="position: absolute; width: 73px; height: 17px; top: -17px; right: 23px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:-17px;right:23px;;font-size:smaller;color:#3f3f3f"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(150,202,89);overflow:hidden"></div></div></td><td class="legendLabel">Email Sent&nbsp;&nbsp;</td></tr></tbody></table></div></div>
                  </div>
                  <div class="tiles">
                    <div class="col-md-4 tile">
                      <span>Total Citas</span>
                      <h2>231,809</h2>
                      <span class="sparkline11 graph" style="height: 160px;"><canvas width="198" height="40" style="display: inline-block; width: 198px; height: 40px; vertical-align: top;"></canvas></span>
                    </div>
                    <div class="col-md-4 tile">
                      <span>Total Ingresos</span>
                      <h2>$231,809</h2>
                      <span class="sparkline22 graph" style="height: 160px;"><canvas width="200" height="40" style="display: inline-block; width: 200px; height: 40px; vertical-align: top;"></canvas></span>
                    </div>
                    <div class="col-md-4 tile">
                      <span>Total Clientes</span>
                      <h2>231,809</h2>
                      <span class="sparkline11 graph" style="height: 160px;"><canvas width="198" height="40" style="display: inline-block; width: 198px; height: 40px; vertical-align: top;"></canvas></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 ">
                  <div>
                    <div class="x_title">
                      <h2>Top Usuarios</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <ul class="list-unstyled top_profiles scroll-view">
                      <li class="media event">
                        <a class="pull-left border-aero profile_thumb">
                          <i class="fa fa-user aero"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Angie Martinez</a>
                          <p><strong>$2300. </strong> Promedio de Ventas </p>
                          <p> <small>12 Ventas Diarias</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-green profile_thumb">
                          <i class="fa fa-user green"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Sergio Grimaldo</a>
                          <p><strong>$2300. </strong> Promedio de Ventas </p>
                          <p> <small>12 Ventas Diarias</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-blue profile_thumb">
                          <i class="fa fa-user blue"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Diego Hernández</a>
                          <p><strong>$2300. </strong> Promedio de Ventas </p>
                          <p> <small>12 Ventas Diarias</small>
                          </p>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-md-4 col-sm-4 ">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Top de Ventas ($)</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>Fusible de Hilo</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>123k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>Modem ENFORA</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>53k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>Cable de datos Unitronic</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>23k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>Punta Captadora</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>3k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>Conector</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>1k</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 ">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
              <div class="x_title">
                <h2>Productos más Vendidos</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table class="" style="width:100%">
                  <tr>
                    <th style="width:37%;">
                      <p>Top 5</p>
                    </th>
                    <th>
                      <div class="col-lg-7 col-md-7 col-sm-7 ">
                        <p class="">Producto</p>
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5 ">
                        <p class="">Porcentaje</p>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                    </td>
                    <td>
                      <table class="tile_info">
                        <tr>
                          <td>
                            <p><i class="fa fa-square blue"></i>Fusible de Hilo</p>
                          </td>
                          <td>30%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square green"></i>Modem ENFORA </p>
                          </td>
                          <td>10%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square purple"></i>Cable de Datos Unitronic </p>
                          </td>
                          <td>20%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square aero"></i>Punta Captadora </p>
                          </td>
                          <td>15%</td>
                        </tr>
                        <tr>
                          <td>
                            <p><i class="fa fa-square red"></i>Conector de perforación Acometida </p>
                          </td>
                          <td>30%</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 ">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>% de Conexión</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="quick-list">
                    <li><i class="fa fa-calendar-o"></i><a href="#">Perfil de conexión</a>
                    </li>
                    <li><i class="fa fa-bars"></i><a href="#">Opción más utilizada</a>
                    </li>
                    <li><i class="fa fa-bar-chart"></i><a href="#">Usuario de Conexión</a> </li>
                  </ul>
                  <div class="sidebar-widget">
                    <h4>Profile Completion</h4>
                    <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                    <div class="goal-wrapper">
                      <span id="gauge-text" class="gauge-value pull-left">0</span>
                      <span class="gauge-value pull-left">%</span>
                      <span id="goal-text" class="goal-value pull-right">100%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-4 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Actividades Recientes <small>por Sesión</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="dashboard-widget-content">
                  <ul class="list-unstyled timeline widget">
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a>Agendamiento de Urbaser</a>
                          </h2>
                          <div class="byline">
                            <span>13 hours ago</span> Por  <a>Sergio Grimaldo</a>
                          </div>
                          <p class="excerpt">Se realizo nuevo acercamiento con el departamento Comercial de la compañía, para la compra de medidores y ... <a>Leer Más...</a>
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a>Agendamiento de Urbaser</a>
                          </h2>
                          <div class="byline">
                            <span>13 hours ago</span> Por  <a>Sergio Grimaldo</a>
                          </div>
                          <p class="excerpt">Se realizo nuevo acercamiento con el departamento Comercial de la compañía, para la compra de medidores y ... <a>Leer Más...</a>
                          </p>
                        </div>
                      </div>
                    </li>

                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a>Agendamiento de Urbaser</a>
                          </h2>
                          <div class="byline">
                            <span>13 hours ago</span> Por  <a>Sergio Grimaldo</a>
                          </div>
                          <p class="excerpt">Se realizo nuevo acercamiento con el departamento Comercial de la compañía, para la compra de medidores y ... <a>Leer Más...</a>
                          </p>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="block">
                        <div class="block_content">
                          <h2 class="title">
                            <a>Agendamiento de Urbaser</a>
                          </h2>
                          <div class="byline">
                            <span>13 hours ago</span> Por  <a>Sergio Grimaldo</a>
                          </div>
                          <p class="excerpt">Se realizo nuevo acercamiento con el departamento Comercial de la compañía, para la compra de medidores y ... <a>Leer Más...</a>
                          </p>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Listado de Tareas</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="">
                    <ul class="to_do">
                      <li>
                        <p>
                          <input type="checkbox" class="flat"> Realizar nuevo agendamiento con Sergio Grimaldo  </p>
                        </li>
                        <li>
                          <p>
                            <input type="checkbox" class="flat"> Realizar cotización con Colombia Hosting</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Enviar los archivos de interface</p>
                            </li>
                            <li>
                              <p>
                                <input type="checkbox" class="flat"> Realizar proceso de Administrativos de compras</p>
                              </li>

                            </ul>
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
                Amethyst - CRM Developed By  <a href="https://desarrollaloya.com">Desarróllalo YA!</a>
              </div>
              <div class="clearfix"></div>
            </footer>

          </div>
        </div>

        <script src="../../public/vendors/jquery/dist/jquery.min.js"></script>

        <script src="../../public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="../../public/vendors/fastclick/lib/fastclick.js"></script>

        <script src="../../public/vendors/nprogress/nprogress.js"></script>

        <script src="../../public/vendors/Chart.js/dist/Chart.min.js"></script>

        <script src="../../public/vendors/gauge.js/dist/gauge.min.js"></script>

        <script src="../../public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

        <script src="../../public/vendors/iCheck/icheck.min.js"></script>

        <script src="../../public/vendors/skycons/skycons.js"></script>

        <script src="../../public/vendors/Flot/jquery.flot.js"></script>
        <script src="../../public/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../../public/vendors/Flot/jquery.flot.time.js"></script>
        <script src="../../public/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../../public/vendors/Flot/jquery.flot.resize.js"></script>

        <script src="../../public/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../../public/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../../public/vendors/flot.curvedlines/curvedLines.js"></script>

        <script src="../../public/vendors/DateJS/build/date.js"></script>

        <script src="../../public/vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../../public/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../../public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

        <script src="../../public/vendors/moment/min/moment.min.js"></script>
        <script src="../../public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="../../public/build/js/custom.min.js"></script>
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"67a502c94e32180b","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.7.0","si":10}'></script>
      </body>
      </html>
