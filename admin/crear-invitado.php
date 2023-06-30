<?php
    include_once 'funciones/sesiones.php';
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
            <h1>Crear Invitado <small>Llena el formulario para añadir un invitado</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-8">
        <div class="card-header">
          <h3 class="card-title">Crear Invitado</h3>
        </div>

        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-invitado.php" class="form-horizontal" id="guardar-registro-archivo" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre_invitado" name="nombre_invitado" class="col-form-label">Nombre:</label>
                      <input type="text" name="nombre_invitado" class="form-control" id="nombre_invitado" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="apellido_invitado" name="apellido_invitado" class="col-form-label">Apellido:</label>
                      <input type="text" name="apellido_invitado" class="form-control" id="apellido_invitado" placeholder="Apellido">
                  </div>
                  <div class="form-group">
                      <label for="descripcion">Biografía:</label>
                      <textarea class="form-control" name="descripcion" id="descripcion" rows="10" placeholder="Descripción"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="imagen_invitado">Imagen:</label>
                    <input class="form-control" type="file" id="imagen_invitado" name="imagen-invitado">
                    <p class="help-block">Selecciona la imagen del invitado</p>
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-info">Añadir</button>
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