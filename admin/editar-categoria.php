<?php
    $id = $_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT)) {
        die('Error!');
    } else {
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
            <h1>Editar Categoría <small>Llena el formulario para editar la categoría de evento</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-10">
        <div class="card-header">
          <h3 class="card-title">Editar Categoría</h3>
        </div>

        <?php
            $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id";
            $resultado = $conn->query($sql);
            $categoria = $resultado->fetch_assoc();
        ?>

        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-categoria.php" class="form-horizontal" id="guardar-registro">
            <div class="card-body">
              <div class="form-group">
                <label for="categoria" name="categoria" class="col-sm-4 col-form-label">Nombre:</label>
                <div class="col-sm-12">
                  <input type="text" name="categoria" class="form-control" id="categoria" placeholder="Categoría" value="<?php echo $categoria['cat_evento'] ?>">
                </div>
              </div>
              
              <div class="form-group col-sm-12">
                <label for="icono">Icono:</label>
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="fa fa-address-book"></i>
                    </div>
                  </div>
                  <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria['icono'] ?>">
                </div>
              </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
              <input type="hidden" name="registro" value="actualizar">
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
    }
?>