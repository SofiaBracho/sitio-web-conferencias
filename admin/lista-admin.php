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
          <div class="col-sm-6">
            <h1>Lista de Administradores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
              <li class="breadcrumb-item active">Lista de Administradores</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Maneja los usuarios aquí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      try {
                        $sql = 'SELECT id_admin, usuario, nombre FROM admins';
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }

                      while($admin = $resultado->fetch_assoc() ) { ?>
                        <tr>
                          <td><?php echo $admin['usuario']; ?></td>
                          <td><?php echo $admin['nombre']; ?></td>
                          <td>
                            <a href="editar-admin.php?id=<?php echo $admin['id_admin']; ?>" class="btn bg-orange btn-flat margin">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="<?php echo $admin['id_admin']; ?>" data-tipo="admin" class="btn bg-maroon btn-flat margin borrar_registro">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include_once 'templates/footer.php';
?>