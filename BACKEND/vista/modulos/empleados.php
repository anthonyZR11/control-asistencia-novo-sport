<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Empleados

    </h1>

    <ol class="breadcrumb">

      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active"><?php echo $_GET['ruta'] ?></li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregaEmpleado"><i class="fa fa-plus"></i>

          Nuevo

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Doc. Identidad:</th>
              <th>Foto:</th>
              <th>Nombre Completo:</th>
              <th>Departamento:</th>
              <th>Horario (L-D):</th>
              <th>Registrado desde:</th>
              <?php if ($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR") {
                echo '<th style="width:157px">Acciones</th>';
              }
              ?>
            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

            foreach ($empleados as $key => $value) {

              echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["docIdentEmpleado"] . '</td>';


              if ($value["fotoEmpleado"] != "") {

                echo '<td><img src="' . $value["fotoEmpleado"] . '" class="img-thumbnail" width="40px" style="padding:0px !important;"></td>';
              } else {

                echo '<td><img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" style="padding:0px !important;"></td>';
              }

              echo '<td>' . $value["nomEmpleado"] . '&nbsp;' . $value["apeEmpleado"] . '</td>';

              echo '<td>' . $value["nomDepartamento"] . '</td>';

              // echo '<td></td>';

              echo '<td>' . date('h:i A', strtotime($value['horaIngreso'])) . ' - ' . date('h:i A', strtotime($value['horaSalida'])) . '</td>';

              echo '<td>' . $value["fecIngEmpleado"] . '</td>
                  <td>

                    <div class="btn-group">';

              if ($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR") {

                echo '<button class="btn btn-warning btn-flat btnEditarEmpleado" idEmpleado="' . $value["idEmpleado"] . '" data-toggle="modal" data-target="#modalEditarEmpleado"><i class="fa fa-pencil"></i> Editar</button>';
              }

              if ($_SESSION["rol"] == "ADMINISTRADOR") {
                echo '<button class="btn btn-danger btn-flat btnEliminarEmpleado" idEmpleado="' . $value["idEmpleado"] . '" fotoEmpleado="' . $value["fotoEmpleado"] . '" docEmpleado="' . $value["docIdentEmpleado"] . '"><i class="fa fa-times"></i> Eliminar</button>';
              }

              echo  '</div>  

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

<div id="modalAgregaEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="nuevoDocIdentEmpleado" id="nuevoDocIdentEmpleado" placeholder="Ingresa numero de doc. de identidad" minlength="8" maxlength="12" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="nuevoNomEmpleado" placeholder="Ingresar nombres" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="nuevoApeEmpleado" placeholder="Ingresar apellidos" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control " name="nuevoGenEmpleado">
                  <option value="" selected disabled="disabled">Genero</option>
                  <option value="1">MASCULINO</option>
                  <option value="0">FEMENINO</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label>Fecha de Nacimiento:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="nuevaFecNacEmpleado" id="datepicker" placeholder="11/04/2001" required>
              </div>
              <!-- /.input group -->
            </div>



            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" class="form-control" name="nuevoEmailEmpleado" id="nuevoEmailEmpleado" placeholder="Ingresar correo electronico" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="nuevoCelEmpleado" data-inputmask='"mask": "+51(###)###-###"' placeholder="ingresar celular" data-mask required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <textarea type="text" class="form-control" name="nuevaDirEmpleado" placeholder="Ingresar direccion del domicilio" required></textarea>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control" name="nuevoIdDepartamento">
                  <option value="">Selecionar Departamento</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $deps = ControladorDeps::ctrMostrarDeps($item, $valor);
                  foreach ($deps as $key => $value) {
                    echo '<option value="' . $value["idDepartamento"] . '">' . $value["nomDepartamento"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control " name="nuevoIdHorario">
                  <option value="">Selecionar Horario</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $horarios = ControladorHorarios::ctrMostrarHorarios($item, $valor);
                  foreach ($horarios as $key => $value) {
                    echo '<option value="' . $value["idHorario"] . '">' . date('h:i A', strtotime($value['horaIngreso'])) . ' - ' . date('h:i A', strtotime($value['horaSalida'])) . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFotoUsuario" name="nuevaFotoEmpleado">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Empleado</button>

        </div>

        <?php

        $crearEmpleado = new ControladorEmpleados();
        $crearEmpleado->ctrCrearEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="editarDocIdentEmpleado" id="editarDocIdentEmpleado" readonly>
                <input type="hidden" class="form-control " name="idEmpleado" id="idEmpleado" readonly>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="editarNomEmpleado" id="editarNomEmpleado" placeholder="Ingresar nombres" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="editarApeEmpleado" id="editarApeEmpleado" placeholder="Ingresar apellidos" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control " name="editarGenEmpleado">
                  <option value="" id="editarGenEmpleado" disabled selected></option>
                  <option value="1">MASCULINO</option>
                  <option value="0">FEMENINO</option>

                </select>


              </div>
            </div>


            <div class="form-group">
              <label>Fecha de Nacimiento:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="editarFecNacEmpleado" id="datepicker3" placeholder="11/04/2001" required>
              </div>
              <!-- /.input group -->
            </div>



            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" class="form-control " name="editarEmailEmpleado" id="editarEmailEmpleado" placeholder="Ingresar correo electronico" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control " name="editarCelEmpleado" id="editarCelEmpleado" placeholder="Ingresar celular de contacto" required>
              </div>
            </div>


            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <textarea type="text" class="form-control " name="editarDirEmpleado" id="editarDirEmpleado" placeholder="Ingresar direccion del domicilio" required></textarea>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control " name="editarIdDepartamento">
                  <option value="" id="editarIdDepartamento" disabled></option>
                  <?php
                  $item = null;
                  $valor = null;
                  $deps = ControladorDeps::ctrMostrarDeps($item, $valor);
                  foreach ($deps as $key => $value) {
                    echo '<option value="' . $value["idDepartamento"] . '">' . $value["nomDepartamento"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control " name="editarIdHorario">
                  <option value="" id="editarIdHorario" disabled></option>
                  <?php
                  $item = null;
                  $valor = null;
                  $horarios = ControladorHorarios::ctrMostrarHorarios($item, $valor);
                  foreach ($horarios as $key => $value) {
                    echo '<option value="' . $value["idHorario"] . '">' . date('h:i A', strtotime($value['horaIngreso'])) . ' - ' . date('h:i A', strtotime($value['horaSalida'])) . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFotoEmpleado">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php

        $editarEmpleado = new ControladorEmpleados();
        $editarEmpleado->ctrEditarEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorEmpleados();
$borrarUsuario->ctrBorrarEmpleado();

?>