<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">

        <?php
        $item = 'idUsuario';
        $valor = $_SESSION['id'];
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        if ($respuesta["fotoUsuario"] != "") {
          echo '<img src="' . $respuesta["fotoUsuario"] . '" class="img-circle user-image">';
        } else {
          echo '<img src="vista/img/usuarios/default/anonymous.png" class="img-circle user-image">';
        }
        ?>

      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION["nombre"]; ?>&nbsp;- <?php echo $_SESSION["rol"]; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="active">
        <a href="principal">
          <i class="fa fa-dashboard"></i> <span>Menu Principal</span>
        </a>
      </li>

      <li class="header">Menu de administración</li>
      <?php if ($_SESSION["rol"] === "admin"): ?>
        <li class>
          <a href="usuario">
            <i class="fa fa-users" aria-hidden="true"></i> <span>Usuarios</span>
          </a>
        </li>
        <li class>
          <a href="rol">
            <i class="fa fa-cogs" aria-hidden="true"></i> <span>Roles</span>
          </a>
        </li>
      <?php endif; ?>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-id-card-o" aria-hidden="true"></i>
          <span>Empleados</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="empleados"><i class="fa fa-circle-o"></i> Lista de empeleados</a></li>
          <?php if ($_SESSION["rol"] === "admin"): ?>
            <li><a href="adelanto-dinero"><i class="fa fa-circle-o"></i> Adelanto de dinero</a></li>
          <?php endif; ?>
          <li><a href="horario"><i class="fa fa-circle-o"></i> Horarios</a></li>
        </ul>
      </li>

      <?php if ($_SESSION["rol"] === "admin"): ?>
      <li class>
        <a href="departamentos">
          <i class="fa fa-briefcase" aria-hidden="true"></i> <span>Departamentos</span>
        </a>
      </li>
      <?php endif; ?>
      <li class>
        <a href="asistencia-empleados">
          <i class="fa fa-calendar" aria-hidden="true"></i> <span>Asistencias</span>
        </a>
      </li>

      <?php if ($_SESSION["rol"] === "admin") {

        echo '<li class="header">REPORTES</li>
        <li class>
          <a href="reporte-horarios">
            <i class="fa fa-print" aria-hidden="true"></i> <span>Control Horarios</span>
          </a>
        </li>
        <li class>
          <a href="reporte-asistencias">
            <i class="fa fa-print" aria-hidden="true"></i> <span>Control asistencias</span>
          </a>
        </li>';
      }
      ?>

      <li class="header">Menu de ayuda</li>

      <li class>
        <a href="ayuda">
          <i class="fa fa-question-circle" aria-hidden="true"></i> <span>Ayuda</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow"> PDF </small>
          </span>
        </a>
      </li>
    </ul>
  </section>
</aside>