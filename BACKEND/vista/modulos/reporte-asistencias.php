<?php 
  if($_SESSION["rol"] == "INVITADO" || $_SESSION["rol"] == "EDITOR"){

  echo '<script>

    window.location = "principal";

  </script>';

  return;

}
 ?>
<?php 

  if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

  }else{

  $fechaInicial = null;
  $fechaFinal = null;

  }

?>
<div class="content-wrapper">
  <section class="content-header">  
    <h1>     
      REPORTE ASISTENCIAS
    </h1>
    <ol class="breadcrumb">   
      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active"><?php echo $_GET['ruta'] ?></li>    
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <div class="input-group">

          <button type="button" class="btn btn-default" id="daterange-btn2">
           
            <span>
              <i class="fa fa-calendar"></i> 

              <?php

                if(isset($_GET["fechaInicial"])){

                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                
                }else{
                 
                  echo 'Rango de fecha';

                }

              ?>
            </span>

            <i class="fa fa-caret-down"></i>

          </button>

        </div>

        <div class="box-tools pull-right">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vista/modulos/descargar-reporte-asistencia.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vista/modulos/descargar-reporte-asistencia.php?reporte=reporte">';

        }         

        ?>

          <?php  

           if($_SESSION["rol"] == "admin"){ 
              echo '<button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>';
            }
           ?>

          </a>

        </div>
         
      </div>

      <div class="box-body">     
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">      
          <thead>
       <tr>                         
             <th>Id empleado</th>
             <th>Nombre empleado</th>
             <th>Apellido empleado</th>
             <th>Hora entrada</th>
             <th>Hora Salida</th>
             <th>Estado del ingreso</th>
      </tr> 
          </thead>
          <tbody>
            <?php

            $tabla = 'asistencia';
            $ventas = ModeloAsistencias::mdlRangoFechasAsistencias($tabla, $fechaInicial, $fechaFinal);
            foreach ($ventas as $key => $value) {   
             $status = ($value['estadoAsistencia'])?'<span class="badge bg-green pull-right">a tiempo</span>':'<span class="badge bg-red pull-right">tarde</span>';  
              echo ' <tr>
                      <td class="text-uppercase">'.$value['docIdentEmpleado'].'</td>
                      <td class="text-uppercase">'.$value['nomEmpleado'].'</td>
                      <td class="text-uppercase">'.$value['apeEmpleado'].'</td>
                      <td class="text-uppercase">'.date('h:i A', strtotime($value["ingAsistencia"])).'</td>
                      <td class="text-uppercase">'.date('h:i A', strtotime($value["salAsistencia"])).'</td>
                      <td class="text-uppercase">'.$status.'</td>
                      
                    </tr>';
            }

          ?>
          </tbody>
       </table>
      </div>
    </div>
  </section>
</div>


