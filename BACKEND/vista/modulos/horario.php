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

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarHorario"> <i class="fa fa-plus"></i>
          
          Nuevo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Hora de ingreso</th>
             <th>Hora de salida</th>
             <?php if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "EDITOR"){ 
             echo '<th>Acciones</th>';
           }
              ?>

           </tr> 

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $horarios = ControladorHorarios::ctrMostrarHorarios($item, $valor);

            foreach ($horarios as $key => $value) {
             
              echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.date('h:i A', strtotime($value["horaIngreso"])).'</td>

                      <td class="text-uppercase">'.date('h:i A', strtotime($value["horaSalida"])).'</td>

                      <td>

                        <div class="btn-group">';

                        if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "EDITOR"){

                       echo '<button class="btn btn-warning  btn-flat btnEditarHora" idHora="'.$value["idHorario"].'" data-toggle="modal" data-target="#modalEditarHora"><i class="fa fa-edit"></i> Editar</button>';
                        
                        }

                          if($_SESSION["rol"] == "admin"){

                            echo '<button class="btn btn-danger   btn-flat btnEliminarHora" idHora="'.$value["idHorario"].'"><i class="fa fa-times"></i> Eliminar</button>';

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

<div id="modalAgregarHorario" class="modal fade" role="dialog">
  
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

            <!-- ENTRADA PARA EL NOMBRE -->
              
            <div class="bootstrap-timepicker" id="tamHora1">

              <div class="form-group">

                <label>Hora Ingreso:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker1" name="nuevaHoraIn" required>

                </div>

              </div>
            </div>

             <div class="bootstrap-timepicker" id="tamHora2">

              <div class="form-group">

                <label>Hora Salida:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker2" name="nuevaHoraSal" required>

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

          $crearHorarios = new ControladorHorarios();
          $crearHorarios -> ctrCrearHorario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR rol
======================================-->

<div id="modalEditarHora" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar rol</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="bootstrap-timepicker" id="tamHora3">

              <div class="form-group">

                <label>Hora Ingreso:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker3" name="editarHoraIn" id="editarHoraIn" required>
                  <input type="hidden"  name="idHorario" id="idHorario" required>

                </div>

              </div>

            </div>


            <div class="bootstrap-timepicker" id="tamHora4">

              <div class="form-group">

                <label>Hora Salida:</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="text" class="form-control timepicker4" name="editarHoraSal" id="editarHoraSal" required>

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

          $editarHorarios = new ControladorHorarios();
          $editarHorarios -> ctrEditarHorario();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarHorarios = new ControladorHorarios();
  $borrarHorarios -> ctrBorrarHorario();

?>



