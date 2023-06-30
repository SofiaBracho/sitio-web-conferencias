<?php
    include_once 'funciones/sesiones.php';
    comprobar_nivel();
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    include_once 'templates/navegacion.php';
    include_once 'templates/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Crear Administrador <small>Llena el formulario para crear el administrador</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-10">
        <div class="card-header">
          <h3 class="card-title">Crear Administrador</h3>
        </div>

        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-admin.php" class="form-horizontal" id="guardar-registro">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="usuario" name="usuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nombre" name="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu nombre completo">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" name="password" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" name="password" class="col-sm-2 col-form-label">Repetir Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" name="repetir_password" class="form-control" id="repetir_password" placeholder="Contraseña">
                    </div>
                    <span id="resultado-password" class="help-block"></span>
                  </div>
                  <div class="form-group row">
                    <label for="nivel" name="nivel" class="col-sm-2 col-form-label">Nivel</label>
                    <div class="col-sm-10">
                      <select name="nivel" id="nivel" class="form-control">
                        <option selected value="0">0</option>
                        <option value="1">1</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-info" id="crear_registro_admin">Añadir</button>
                </div>
                <!-- /.card-footer -->
              </form>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

            


<?php
    include_once 'templates/footer.php';
?>