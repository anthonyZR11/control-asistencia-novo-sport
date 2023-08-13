<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 col-lg-10">
        <div class="wrap d-md-flex">
          <div class="img">
          </div>
          <div class="login-wrap p-4 p-md-5">
            <div class="d-flex">
              <div class="w-100">
              <h3 class="mb-4"> <center>Inicio de sesión</center> </h3>
              </div>
            </div>
            <form method="post">
              <div class="form-group mb-3">
                <label class="label" for="name">Usuario</label>
                <input type="text" class="form-control" name="ingUsuario" placeholder="Ingresar usuario" required>
              </div>
              <div class="form-group mb-3">
                <label class="label" for="password">Contraseña</label>
                <input type="password" class="form-control"name="ingPassword" placeholder="Ingresar contraseña" required>
              </div>
              <div class="form-group">
                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Ingresar</button>
              </div>
              <div class="form-group d-md-flex">
                <div class="w-50 text-left">
                  <label class="checkbox-wrap checkbox-primary mb-0">Recordar contraseña
                      <input type="checkbox" checked="">
                      <span class="checkmark"></span>
                  </label>
                </div>
              </div>

               <?php

                  $login = new ControladorUsuarios();
                  $login -> ctrIngresoUsuario();
                  
                ?>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>