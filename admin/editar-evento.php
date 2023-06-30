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
            <h1>Editar Evento <small>Llena el formulario para editar el evento</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-8">
        <div class="card-header">
          <h3 class="card-title">Editar Evento</h3>
        </div>

        <?php
            try {
                $sql = "SELECT * FROM eventos WHERE evento_id = $id";
                $resultado = $conn->query($sql);
                $evento = $resultado->fetch_assoc();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-evento.php" class="form-horizontal" id="guardar-registro">
                <div class="card-body">
                  <div class="form-group">
                    <label for="titulo_evento" name="titulo_evento" class="col-sm-4 col-form-label">Título del Evento:</label>
                    <div class="col-sm-12">
                      <input type="text" name="titulo_evento" class="form-control" id="titulo_evento" placeholder="Título Evento" value="<?php echo $evento['nombre_evento']; ?>">
                    </div>
                  </div>
                  <!-- Date -->
                  <div class="form-group col-sm-12">
                    <label for="fecha" name="fecha">Fecha:</label>
                      <div class="input-group date" id="fecha" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="fecha" data-target="#fecha" value="<?php echo(date('d-m-Y', strtotime($evento['fecha_evento']))); ?>" />
                          <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  <!-- /.form group -->

                  <!-- time Picker -->
                  <div class="bootstrap-timepicker col-sm-12">
                    <div class="form-group">
                      <label>Hora:</label>
                      <?php
                        $hora = $evento['hora_evento'];
                        $hora_formato = date('h:i a', strtotime($hora));
                      ?>

                      <div class="input-group date" id="hora" data-target-input="nearest">
                        <input name="hora" type="text" class="form-control datetimepicker-input" data-target="#hora" value="<?php echo $hora_formato; ?>"/>
                        <div class="input-group-append" data-target="#hora" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                        </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                  <!-- /time Picker -->

                  <div class="form-group">
                    <label for="categoria_evento" class="col-sm-4 col-form-label">Categoría:</label>
                    <div class="col-sm-12">
                      <select name="categoria_evento" class="form-control seleccion">
                        <option value="0">- Seleccione -</option>
                        <?php 
                          try {
                            $sql = "SELECT * FROM categoria_evento";
                            $resultado = $conn->query($sql);
                            while($cat_evento = $resultado->fetch_assoc() ) { 
                                if($evento['id_cat_evento'] == $cat_evento['id_categoria']) { ?>
                                    <option value="<?php echo $cat_evento['id_categoria']; ?>" selected>
                                        <?php echo $cat_evento['cat_evento']; ?>
                                    </option>
                            <?php } else { ?>
                                    <option value="<?php echo $cat_evento['id_categoria']; ?>">
                                        <?php echo $cat_evento['cat_evento']; ?>
                                    </option>
                            <?php }
                            }
                          } catch (Exception $e) {
                            echo 'Error:' . $e->getMessage();
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="invitado" class="col-sm-4 col-form-label">Invitado:</label>
                    <div class="col-sm-12">
                      <select name="invitado" class="form-control seleccion">
                        <option value="0">- Seleccione -</option>
                        <?php 
                          try {
                            $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
                            $resultado = $conn->query($sql);
                            while($invitado = $resultado->fetch_assoc() ) { 
                                if($evento['id_inv'] == $invitado['invitado_id'] ){ ?>
                                    <option value="<?php echo $invitado['invitado_id']; ?>" selected>
                                        <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?>
                                    </option>
                            <?php } else { ?>
                                    <option value="<?php echo $invitado['invitado_id']; ?>">
                                        <?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?>
                                    </option>
                            <?php   }
                            }
                            $conn->close();
                          } catch (Exception $e) {
                            echo 'Error:' . $e->getMessage();
                          }
                        ?>
                      </select>
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
    }
?>