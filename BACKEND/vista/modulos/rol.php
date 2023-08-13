<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Roles de usuario
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active"> <?php echo $_GET['ruta'] ?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarRol"> <i class="fa fa-plus"></i>
          
          Nuevo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Nombre de Rol</th>
             <th>Funciones</th>
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

            $roles = ControladorRoles::ctrMostrarRoles($item, $valor);

            foreach ($roles as $key => $value) {
             
              echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.$value["nomRol"].'</td>

                      <td class="text-uppercase">'.$value["desRol"].'</td>

                      <td>

                        <div class="btn-group">';

                        if($_SESSION["rol"] == "ADMINISTRADOR" || $_SESSION["rol"] == "EDITOR"){

                        echo '<button class="btn btn-warning  btn-flat btnEditarRol" idRol="'.$value["idRol"].'" data-toggle="modal" data-target="#modalEditarRol"><i class="fa fa-edit"></i> Editar</button>';
                        }

                          if($_SESSION["rol"] == "ADMINISTRADOR"){

                            echo '<button class="btn btn-danger   btn-flat btnEliminarRol" idRol="'.$value["idRol"].'"><i class="fa fa-times"></i> Eliminar</button>';

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

<div id="modalAgregarRol" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar rol</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoRol" placeholder="Ingresar rol" required>

              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea type="text" class="form-control input-lg" name="nuevaDesRol" placeholder="Describir funciones" required></textarea>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar rol</button>

        </div>

         <?php

          $crearRoles = new ControladorRoles();
          $crearRoles -> ctrCrearRol();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR rol
======================================-->

<div id="modalEditarRol" class="modal fade" role="dialog">
  
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
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarRol" id="editarRol" required>

                 <input type="hidden"  name="idRol" id="idRol" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea type="text" class="form-control input-lg" name="editarDesRol" id="editarDesRol" required></textarea>

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

          $editarRoles = new ControladorRoles();
          $editarRoles -> ctrEditarRol();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarRoles = new ControladorRoles();
  $borrarRoles -> ctrBorrarRol();

?>



