<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      DEPARTAMENTOS
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="principal"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active"><?php echo $_GET['ruta'] ?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarDep"> <i class="fa fa-plus"></i>
          
          Nuevo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Nombre departamento</th>
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

            $deps = ControladorDeps::ctrMostrarDeps($item, $valor);

            foreach ($deps as $key => $value) {
             
              echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.$value["nomDepartamento"].'</td>

                      <td>';

                      if($_SESSION["rol"] == "admin" || $_SESSION["rol"] == "EDITOR"){

                      echo '<div class="btn-group">

                        <button class="btn btn-warning btnEditarDep" idDep="'.$value["idDepartamento"].'" data-toggle="modal" data-target="#modalEditarDep"><i class="fa fa-edit"></i> Editar</button>';  
                        }

                          if($_SESSION["rol"] == "admin"){

                            echo '<button class="btn btn-danger btnEliminarDep" idDep="'.$value["idDepartamento"].'"><i class="fa fa-times"></i> Eliminar</button>';

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

<div id="modalAgregarDep" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Departamento</h4>

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

                <input type="text" class="form-control input-lg" name="nuevoDep" placeholder="Ingresa nombre del departamento" required>

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

          $crearDeps = new ControladorDeps();
          $crearDeps -> ctrCrearDep();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR rol
======================================-->

<div id="modalEditarDep" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar</h4>

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

                <input type="text" class="form-control input-lg" name="editarDep" id="editarDep" required>

                 <input type="hidden"  name="idDep" id="idDep" required>

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

          $editarDeps = new ControladorDeps();
          $editarDeps -> ctrEditarDep();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarDeps = new ControladorDeps();
  $borrarDeps -> ctrBorrarDep();

?>



