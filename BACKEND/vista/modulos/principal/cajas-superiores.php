<?php

$item = null;
$valor = null;
$orden = "id";

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$usuarios = count($usuarios);

$roles = ControladorRoles::ctrMostrarRoles($item, $valor);
$roles = count($roles);

$empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
$empleados = count($empleados);

$adelantos = ControladorAdelantos::ctrMostrarAdelantos($item, $valor);
$adelantos = count($adelantos);

$departamentos = ControladorDeps::ctrMostrarDeps($item, $valor);
$departamentos = count($departamentos);

$asistencias = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);
$asistencias = count($asistencias);

?>



<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo number_format($usuarios); ?></h3>

      <p>Usuarios</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion-android-people"></i>

    
    </div>
    
    <a href="usuario" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-orange-active">
    
    <div class="inner">
    
      <h3><?php echo number_format($roles); ?></h3>

      <p>Roles</p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-ios-cog"></i>
    
    </div>
    
    <a href="rol" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-teal-active">
    
    <div class="inner">
    
      <h3><?php echo number_format($empleados); ?></h3>

      <p>Empleados</p>
  
    </div>
    
    <div class="icon">
    
      <i class="fa fa-id-card-o" aria-hidden="true"></i>
    
    </div>
    
    <a href="empleados" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-green">
  
    <div class="inner">
    
      <h3><?php echo number_format($adelantos); ?></h3>

      <p>Adelantos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="adelanto-dinero" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-fuchsia">
  
    <div class="inner">
    
      <h3><?php echo number_format($departamentos); ?></h3>

      <p>Departamentos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-ios-briefcase"></i>
    
    </div>
    
    <a href="departamentos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-yellow">
  
    <div class="inner">
    
      <h3><?php echo number_format($asistencias); ?></h3>

      <p>Asistencias</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="asistencia-empleados" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>