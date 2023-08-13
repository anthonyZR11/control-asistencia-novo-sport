<?php

if ($_SESSION["rol"] == "INVITADO") {

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

      <div class="box-header with-border">

        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarAdelanto"> <i class="fa fa-plus"></i>

          Nuevo

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas  tablas2" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th style="width:70px">Cod. Empleado</th>
              <th style="width:100px">Nombre Empleado</th>
              <th style="width:70px">Fecha de adelanto</th>
              <th style="width:70px">Cantidad de dinero</th>
              <th style="width:260px">Descripción</th>
              <?php if ($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR") {
                echo '<th>Acciones</th>';
              }
              ?>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $adelanto = ControladorAdelantos::ctrMostrarAdelantos2($item, $valor);

            foreach ($adelanto as $key => $value) {
              setlocale(LC_ALL, "es_ES");
              echo ' <tr>

                      <td>' . ($key + 1) . '</td>

                      <td class="text-uppercase">' . $value["docIdentEmpleado"] . '</td>

                      <td class="text-uppercase">' . $value["nomEmpleado"] . '</td>

                      <td class="text-uppercase">' . date('d M, Y', strtotime($value['fechaAdelanto'])) . '</td>

                      <td class="text-uppercase">S/. ' . $value["cantAdelanto"] . '</td>

                      <td class="text-uppercase">' . $value["descAdelanto"] . '</td>

                      <td>';

              if ($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR") {

                echo '<div class="btn-group">

                        <button class="btn btn-warning  btn-flat btnEditarAdelanto"  idAdelanto="' . $value["idAdelanto"] . '" data-toggle="modal" data-target="#modalEditarAdelanto"><i class="fa fa-edit"></i> Editar</button>';
              }
              if ($_SESSION["rol"] == "ADMINISTRADOR") {

                echo '<button class="btn btn-danger   btn-flat btnEliminarAdelanto" idAdelanto="' . $value["idAdelanto"] . '"  idEmpleado="' . $value["idEmpleado"] . '"><i class="fa fa-times"></i> Eliminar</button>';
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

<div id="modalAgregarAdelanto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form class="form-horizontal" role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar adelanto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label class="control-label col-sm-3">Doc. Identidad</label>
              <div class="col-sm-9">
                <select class="form-control select2" style="width: 100%;" required name="nuevoEmpAdelanto">
                  <option value="" selected disabled>BUSCAR EMPLEADO</option>
                  <?php
                  $item = null;
                  $valor = null;

                  $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                  foreach ($empleado as $key => $value) {
                    echo '<option value="' . $value["idEmpleado"] . '">' . $value["nomEmpleado"] . ' ' . $value["docIdentEmpleado"] . '</option>';
                  }

                  ?>
                </select>
              </div>
            </div>




            <div class="form-group">

              <label class="control-label col-sm-3">Cantidad:</label>

              <div class="col-sm-9 input-icon">

                <!--  <span class="input-group-addon"><i class="fa fa-th"></i></span>  -->


                <input type="number" step="0.01" class="form-control" name="nuevaCantAdelanto" placeholder="Ingresar cantidad dinero del adelanto" required>

                <i>S/.</i>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-3">Descripcion:</label>

              <div class="col-sm-9">

                <!-- <span class="input-group-addon"><i class="fa fa-th"></i></span>  -->

                <textarea type="text" class="form-control" name="nuevaDescAdelanto" placeholder="Ingresar descripcion del adelanto" required></textarea>

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

        $crearAdelanto = new ControladorAdelantos();
        $crearAdelanto->ctrCrearAdelanto();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR rol
======================================-->

<div id="modalEditarAdelanto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form class="form-horizontal" role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar adelanto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label class="control-label col-sm-3">Doc. Identidad</label>
              <div class="col-sm-9">
                <input type="text" class="form-control input-soles left" id="editarAdelanto" readonly>
              </div>
            </div>

            <input type="hidden" name="idAdelanto" id="idAdelanto">

            <div class="form-group">

              <label class="control-label col-sm-3">Cantidad:</label>

              <div class="col-sm-9 input-icon">

                <!--  <span class="input-group-addon"><i class="fa fa-th"></i></span>  -->

                <input type="number" step="0.01" class="form-control input-soles left" name="editarCantAdelanto" id="editarCantAdelanto" required>

                <i>S/.</i>

              </div>

            </div>

            <div class="form-group">

              <label class="control-label col-sm-3">Descripcion:</label>

              <div class="col-sm-9">

                <textarea type="text" class="form-control" name="editarDescAdelanto" id="editarDescAdelanto" required></textarea>

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

        $editarAdelanto = new ControladorAdelantos();
        $editarAdelanto->ctrEditarAdelanto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarAdelanto = new ControladorAdelantos();
$borrarAdelanto->ctrBorrarAdelanto();

?>