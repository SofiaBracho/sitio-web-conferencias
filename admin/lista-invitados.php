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
            <h1>Lista de Invitados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
              <li class="breadcrumb-item active">Lista de Invitados</li>
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
                <h3 class="card-title">Administra los Invitados aquí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Biografía</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      try {
                        $sql = 'SELECT * FROM invitados';
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }

                      while($invitado = $resultado->fetch_assoc() ) { ?>
                        <tr>
                          <td><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?></td>
                          <td><?php echo $invitado['descripcion']; ?></td>
                          <td><img src="../img/invitados/<?php echo $invitado['url_imagen'] ?>" alt="Imagen invitado" width="150px"></td>
                          <td>
                            <a href="editar-invitado.php?id=<?php echo $invitado['invitado_id']; ?>" class="btn bg-orange btn-flat margin">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="<?php echo $invitado['invitado_id']; ?>" data-tipo="invitado" class="btn bg-maroon btn-flat margin borrar_registro">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Biografía</th>
                      <th>Imagen</th>
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