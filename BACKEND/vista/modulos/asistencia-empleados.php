<div class="content-wrapper">

  <section class="content-header">
    
    <h2>
      
     CONTROL DE ASISTENCIA
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active"><?php echo $_GET['ruta'] ?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarAsistencia"> <i class="fa fa-plus"></i>
          
          Nuevo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Doc. Identidad</th>
             <th>Nombre</th>
             <th>Fecha registro</th>
             <th>Hora de ingreso</th>
             <th>Hora de salida</th>
             <?php if($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR"){ 
             echo '<th>Acciones</th>';
           }
              ?>

           </tr> 

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $asistencia = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);

            foreach ($asistencia as $key => $value) {

              $status = ($value['estadoAsistencia'])?'<span class="badge bg-green pull-right">a tiempo</span>':'<span class="badge bg-red pull-right">tarde</span>';
             
              echo ' <tr>

                      <td>'.($key+1).'</td>
                      <td class="text-uppercase">'.$value["docIdentEmpleado"].'</td>
                      <td class="text-uppercase">'.$value["nomEmpleado"].' '.$value["apeEmpleado"].'</td>
                      <td class="text-uppercase">'.date('d M, Y', strtotime($value["fecAsistencia"])).'</td>
                      <td class="text-uppercase">'.date('h:i A', strtotime($value["ingAsistencia"])).' '.$status.'</td>
                      <td class="text-uppercase">'.date('h:i A', strtotime($value["salAsistencia"])).'</td>
                      <td>';

                      if($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR"){

                       echo '<div class="btn-group">

                        <button class="btn btn-warning  btn-flat btnEditarAsistencia" idAsistencia="'.$value["idAsistencia"].'" data-toggle="modal" data-target="#modalEditarAsistencia"><i class="fa fa-edit"></i> Editar</button>';
                        }

                          if($_SESSION["rol"] == "ADMINISTRADOR"){

                            echo '<button class="btn btn-danger   btn-flat btnEliminarAsistencia" idAsistencia="'.$value["idAsistencia"].'"><i class="fa fa-times"></i> Eliminar</button>';

                          }

                        echo '</div>  

                      </td>

                    </tr>';
            }

          ?>

          </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarAsistencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
                <label class="control-label col-sm-3">Empleados</label>
                <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" required name="idEmpleado">
                    <option value="" selected disabled>BUSCAR EMPLEADO</option>
                    <?php
                    $item = null;
                    $valor = null;

                    $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                    foreach ($empleado as $key => $value){
                      echo '<option value="'.$value["idEmpleado"].'">'.$value["nomEmpleado"].' '.$value["docIdentEmpleado"].'</option>';
                    }

                    ?>
                  </select>
                </div>
            </div>

            <br><br>


              <div class="form-group">
                <label class="control-label col-sm-3">Fecha asistencia:</label>

                <div class="col-sm-9 date">
                  <input type="text" class="form-control" name="nuevaFecAsistencia" id="datepicker" placeholder="11/04/2001" required>
                </div>
                <!-- /.input group -->
              </div>

                <br><br>


            <!-- ENTRADA PARA EL NOMBRE -->
              
            <div class="bootstrap-timepicker" id="tamHora5">

              <div class="form-group">

                <label>Hora Ingreso:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker5" name="nuevaIngAsistencia" required>

                </div>

              </div>
            </div>

             <div class="bootstrap-timepicker" id="tamHora6">

              <div class="form-group">

                <label >Hora Salida:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker6" name="nuevaSalAsistencia" required>

                </div>

              </div>
            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

         <?php

          $crearHorarios = new ControladorAsistencias();
          $crearHorarios -> ctrCrearAsistencia();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR rol
======================================-->

<div id="modalEditarAsistencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Asistencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
                <label class="control-label col-sm-3">Empleado:</label>
                  <div class="col-sm-9 ">
                    <input type="text" class="form-control" name="nomEmpleado" id="nomEmpleado" readonly>
                    <input type="text" name="idAsistencia" id="idAsistencia" required>
                  </div>
            </div>

            <br><br>


              <div class="form-group">
                <label class="control-label col-sm-3">Fecha asistencia:</label>

                <div class="col-sm-9 ">
                  <input type="text" class="form-control" name="editarFecAsistencia" id="datepicker4" placeholder="11/04/2001" required>
                </div>
                <!-- /.input group -->
              </div>

                <br><br>

            <!-- ENTRADA PARA EL NOMBRE -->
              
            <div class="bootstrap-timepicker" id="tamHora7">

              <div class="form-group">

                <label>Hora Ingreso:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker5" name="editarIngAsistencia" id="editarIngAsistencia" required>

                </div>

              </div>
            </div>

             <div class="bootstrap-timepicker" id="tamHora8">

              <div class="form-group">

                <label >Hora Salida:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker6" name="editarSalAsistencia" id="editarSalAsistencia" required>

                </div>

              </div>
            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarAsistencias = new ControladorAsistencias();
          $editarAsistencias -> ctrEditarAsistencia();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarAsistencias = new ControladorAsistencias();
  $borrarAsistencias -> ctrBorrarAsistencia();

?>



