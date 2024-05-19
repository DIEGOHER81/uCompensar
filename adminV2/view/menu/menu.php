<?php

@session_start();


$file_profile =  "../users/images/IMGPERFIL_" . $_SESSION['coduser'] . ".jpg";

if (file_exists($file_profile)) {
  $photo_profile = $file_profile;
} else {
  $photo_profile = "../users/images/oso.png";
}

?>

<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      <!--<img src="../../public/images/img.jpg" alt="..." class="img-circle profile_img">-->
      <img style="border-radius:50%!important; width:50px; heigth:50px;" src='<?php echo $photo_profile; ?>' alt="..." class="img-circle profile_img img-responsive">
    </div>
    <div class="profile_info">
      <span>Bienvenido,</span>
      <h2><?php echo $_SESSION['user_name']; ?></h2>
    </div>
    <div class="clearfix"></div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="../dashboard/dashboard.php">Tablero de Control</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-cogs"></i>Configuración <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="../caracteristicas/caracteristicas.php">Características Adicionales</a></li>
                <li><a href="../tipospropiedad/tipospropiedad.php">Generos Peliculas</a></li>
                <li><a href="../objetivospropiedad/objetivospropiedad.php">Clasificación general</a></li>
                <li><a href="../users/users.php">Perfil usuario</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Gestión Comercial <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="../peliculas/relpeliculas.php">Relación de Peliculas</a></li>
              <li><a href="../peliculas/peliculas.php">Creación de Peliculas</a></li>
            </ul>
          </li>
        </ul>
    </div>
  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small style="text-align:center">
    <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../login/login.php" style="width:100%" >
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp; <small style="font-size:0.9em">Cerrar Sesión</small>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>