<?php
    include_once 'funciones/sesiones.php';
    comprobar_nivel();
    include_once 'funciones/funciones.php';
    $id = $_GET['id'];

    if(!filter_var($id, FILTER_VALIDATE_INT) ){
      die("Error!");
    }

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
            <h1>Editar Administrador <small>Llena el formulario para editar los datos</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-10">
        <div class="card-header">
          <h3 class="card-title">Editar Administrador</h3>
        </div>

        <?php
          $sql = "SELECT * FROM admins WHERE id_admin = $id ";
          $resultado = $conn->query($sql);
          $admin = $resultado->fetch_assoc();
        ?>

        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-admin.php" class="form-horizontal" id="guardar-registro">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="usuario" name="usuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="nombre" name="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu nombre completo" value="<?php echo $admin['nombre']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password" name="password" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
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