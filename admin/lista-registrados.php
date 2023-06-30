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
          <div class="col-sm-6">
            <h1>Lista de Registrados</h1>
            <small></small>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin-area.php">Inicio</a></li>
              <li class="breadcrumb-item active">Lista de Registrados</li>
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
                <h3 class="card-title">Maneja los registros de usuarios aquí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Fecha de Registro</th>
                      <th>Artículos</th>
                      <th>Eventos</th>
                      <th>Regalo</th>
                      <th>Compra</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      try {
                        $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados";
                        $sql .= " JOIN regalos ";
                        $sql .= " ON registrados.regalo = regalos.id_regalo ";
                        $resultado = $conn->query($sql);
                      } catch (Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }
                      
                      while($registrado = $resultado->fetch_assoc() ) { ?>
                        <tr>
                            <td>
                                <?php echo $registrado['nombre_registrado'] . ' ' . $registrado['apellido_registrado']; 
                                    $pagado = $registrado['pagado'];

                                    if($pagado) {
                                        echo '<span class="badge bg-green">Pagado</span>';
                                    } else {
                                        echo '<span class="badge bg-red">No Pagado</span>';
                                    }                            
                                ?>
                            </td>                          
                            <td><?php echo $registrado['email_registrado']; ?></td>
                            <td><?php echo $registrado['fecha_registro']; ?></td>
                            <td>
                              <?php
                                //Convertirlo a Array
                                $articulos = json_decode($registrado['pases_articulos'], true);

                                //Crear llaves mas legibles
                                $llaves_articulos = array(
                                  'pase_dia' => 'Pase 1 día',
                                  'pase_completo' => 'Pase completo',
                                  'pase_dosdias' => 'Pase dos días',
                                  'camisas' => 'Camisas',
                                  'etiquetas' => 'Etiquetas'
                                );

                                foreach ($articulos as $llave => $articulo) {
                                  if($articulo['cantidad'] > 0) {
                                    echo $articulo['cantidad'] . ' ' . $llaves_articulos[$llave] . '<br>';
                                  }
                                }
                              ?>                              
                            </td>
                            <td>
                              <?php
                                //Convertir a Array
                                $eventos = json_decode($registrado['talleres_registrados'], true);
                                //Convertir a string separando cada elemento
                                $eventos = implode("', '", $eventos['eventos']);

                                $sql_eventos = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN ('$eventos') ";
                                $resultado_eventos = $conn->query($sql_eventos);

                                while ($talleres = $resultado_eventos->fetch_assoc()) {
                                  echo $talleres['nombre_evento'] . ' ' . $talleres['fecha_evento'] . ' ' . $talleres['hora_evento'] . '<br>';
                                }
                               
                              ?>
                            </td>
                            <td><?php echo $registrado['nombre_regalo']; ?></td>
                            <td>$ <?php echo (float) $registrado['total_pagado']; ?></td>
                            <td>
                            <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado']; ?>" class="btn bg-orange btn-flat margin">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registro" class="btn bg-maroon btn-flat margin borrar_registro">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Fecha de Registro</th>
                      <th>Artículos</th>
                      <th>Eventos</th>
                      <th>Regalo</th>
                      <th>Compra</th>
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