<?php 
  if($_SESSION["rol"] == "INVITADO" || $_SESSION["rol"] == "EDITOR"){

  echo '<script>

    window.location = "principal";

  </script>';

  return;

}
 ?>
<div class="content-wrapper">
  <section class="content-header">  
    <h1>     
      Horario Empleados
    </h1>
    <ol class="breadcrumb">   
      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active"><?php echo $_GET['ruta'] ?></li>    
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <?php  if($_SESSION["rol"] == "ADMINISTRADOR"){ 
      echo '<div class="box-header with-border"> 
        <a class="btn btn-success btn-flat" href="vista/modulos/descargar-reporte-horario.php"> <i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
      </div>';
    }
      ?>
      <div class="box-body">     
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">      
          <thead>
       <tr>                         
             <th>Id empleado</th>
             <th>Nombre empleado</th>
             <th>Apellido empleado</th>
             <th>Departamento empleado</th>
             <th>Horario Empleado</th>
      </tr> 
          </thead>
          <tbody>
            <?php
            $item = null;
            $valor = null;
            $horarios = ControladorHorarios::ctrMostrarHorarioEmpleados($item, $valor);
            foreach ($horarios as $key => $value) {     
              echo ' <tr>
                      <td class="text-uppercase">'.$value['docIdentEmpleado'].'</td>
                      <td class="text-uppercase">'.$value['nomEmpleado'].'</td>
                      <td class="text-uppercase">'.$value['apeEmpleado'].'</td>
                      <td class="text-uppercase">'.$value['nomDepartamento'].'</td>
                      <td>'.date('h:i A', strtotime($value['horaIngreso'])).' - '.date('h:i A', strtotime($value['horaSalida'])).'</td>
                    </tr>';
            }

          ?>
          </tbody>
       </table>
      </div>
    </div>
  </section>
</div>


