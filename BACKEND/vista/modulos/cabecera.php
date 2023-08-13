 
 <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
              
                $item = 'idUsuario';
                $valor = $_SESSION['id'];
                $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
             
                if($respuesta["fotoUsuario"] != ""){
                    echo '<img src="'.$respuesta["fotoUsuario"].'" class="img-circle user-image">';
                }else{
                  echo '<img src="vista/img/usuarios/default/anonymous.png" class="img-circle user-image">';
                }

              ?>
              <span class="hidden-xs"><b><?php  echo $_SESSION["nombre"]; ?></b> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                
                  <?php
                  if($_SESSION["foto"] != ""){
                    echo '<img src="'.$respuesta["fotoUsuario"].'" class="img-circle">';
                  }else{
                    echo '<img src="vista/img/usuarios/default/anonymous.png" class="img-circle">';
                  }
                  ?>
                  <p>
                    <small><b>Usuario: </b> <?php  echo $_SESSION["nomUsuario"]; ?></small>
                    <small><b>Rol: </b><?php  echo $_SESSION["rol"]; ?></small>
                  </p>
              </li>
    
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-primary btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="salir" class="btn btn-danger btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>								