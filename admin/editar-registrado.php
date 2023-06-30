<?php
    $id = $_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT)) {
        die('Error');
    }

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
            <h1>Editar Registro <small>Llena el formulario para editar el registro de usuario</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
        $sql = "SELECT * FROM registrados WHERE id_registrado = $id ";
        $resultado = $conn->query($sql);
        $registrado = $resultado->fetch_assoc();

        $pedido = $registrado['pases_articulos'];
        $boletos = json_decode($pedido, true);

        $talleres = json_decode($registrado['talleres_registrados'], true);
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info col-sm-10">
        <div class="card-header">
          <h3 class="card-title">Editar Registro</h3>
        </div>

        <!-- form start -->
        <form name="guardar-registro" method="post" action="modelo-registro.php" class="form-horizontal editar-registrado" id="guardar-registro">
            <div class="card-body">
              <div class="form-group">
                <label for="nombre" name="nombre" class="col-form-label">Nombre:</label>
                  <input value="<?php echo $registrado['nombre_registrado']; ?>" type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
              </div>

              <div class="form-group">
                <label for="apellido" name="apellido" class="col-form-label">Apellido:</label>
                  <input value="<?php echo $registrado['apellido_registrado']; ?>" type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido">
              </div>

              <div class="form-group">
                <label for="email" name="email" class="col-form-label">Email:</label>
                  <input value="<?php echo $registrado['email_registrado']; ?>" type="email" name="email" class="form-control" id="email" placeholder="Email">
              </div>

              <div id="error"></div>
              
              <div class="form-group">
                <div class="paquetes" id="paquetes">
                    <div class="card-header with-border">
                        <h3 class="card-title">Elige el numero de boletos</h3>
                    </div>

                    <ul class="lista-precios clearfix row">
                        <li class="col-md-4">
                            <div class="tabla-precio text-center">
                            <h3>Pase por día (viernes)</h3>
                            <p class="numero">30$</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dia">Boletos deseados: </label>
                                <input value="<?php echo $boletos['pase_dia']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_dia" name="boletos[un_dia][cantidad]" placeholder="0" size="3">
                                <input type="hidden" value="30" name="boletos[un_dia][precio]"></input>
                            </div>
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="tabla-precio text-center">
                            <h3>Todos los días</h3>
                            <p class="numero">50$</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_completo">Boletos deseados: </label>
                                <input value="<?php echo $boletos['pase_completo']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_completo" name="boletos[completo][cantidad]" placeholder="0" size="3">
                                <input type="hidden" value="50" name="boletos[completo][precio]"></input>
                            </div>            
                            </div>
                        </li>
                        <li class="col-md-4">
                            <div class="tabla-precio text-center">
                            <h3>Pase por dos días</h3>
                            <p class="numero">45$</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dosdias">Boletos deseados: </label>
                                <input value="<?php echo $boletos['pase_dosdias']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_dosdias" name="boletos[2dias][cantidad]" placeholder="0" size="3">
                                <input type="hidden" value="45" name="boletos[2dias][precio]"></input>
                            </div>            
                            </div>
                        </li>
                    </ul>
                </div> <!-- Paquetes -->
              </div> <!-- form-group -->

              <div class="form-group">
                <div class="card-header with-border">
                    <h3 class="card-title">Elige los eventos</h3>
                </div>

                <div id="eventos" class="eventos clearfix">
                    <?php
                    include_once '../includes/funciones/bd_conexion.php';
                    
                    try {
                        $sql = " SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                        $sql .= " FROM eventos ";
                        $sql .= " JOIN categoria_evento ";
                        $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                        $sql .= " JOIN invitados ";
                        $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                        $sql .= " ORDER BY eventos.fecha_evento, categoria_Evento.cat_evento, eventos.hora_evento ";

                        $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                        echo 'Error: ' . $e->getMessage();
                    }

                    while($eventos = $resultado->fetch_assoc() ) {
                        //Establecer la fecha como un día de la semana
                        $fecha = $eventos['fecha_evento'];
                        setlocale(LC_TIME, 'spanish');
                        $dia_semana = utf8_encode(strftime("%A", strtotime($fecha)));
                        //Seleccionar la categoría
                        $categoria = $eventos['cat_evento'];

                        //Crear un nuevo arreglo personalizado
                        $dia = array(
                        'nombre_evento' => $eventos['nombre_evento'],
                        'hora' => $eventos['hora_evento'],
                        'id' => $eventos['evento_id'],
                        'nombre_invitado' => $eventos['nombre_invitado'],
                        'apellido_invitado' => $eventos['apellido_invitado']
                        );
                        //Formatear el arreglo para ordenarlo por las llaves
                        $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                    }
                    // echo '<pre>';
                    //    var_dump($eventos_dias);
                    //  echo '</pre>';
                    ?>

                    <div class="caja">
                    <?php foreach($eventos_dias as $dia => $eventos) { ?>
                        <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix row">
                            <h4 class="col-md-12 nombre-dia"><?php echo $dia; ?></h4>
                            
                            <?php foreach($eventos['eventos'] as $categoria => $evento): ?>
                            <div class="col-md-4">
                                <p><?php echo $categoria; ?></p>
                                <?php foreach($evento as $evento_dia) {?>
                                <label>
                                    <input <?php echo (in_array($evento_dia['id'], $talleres['eventos']) ? 'checked' : ''); ?> type="checkbox" name="registro_evento[]" id="<?php echo $evento_dia['id']; ?>" value="<?php echo $evento_dia['id']; ?>">
                                    <time><?php echo $evento_dia['hora']; ?></time>
                                    <?php echo $evento_dia['nombre_evento']; ?>
                                    <br>
                                    <span class="autor"><?php echo $evento_dia['nombre_invitado'] . ' ' . $evento_dia['apellido_invitado']; ?></span>
                                </label>
                                <?php } //foreach ?>
                            </div>
                            <?php endforeach; ?>
                        </div> <!-- #contenido-dia -->
                    <?php } //foreach ?>
                    </div> <!-- .caja -->
                </div> <!-- #eventos -->
              </div> <!-- form-group -->

              <div class="form-group">
                <div id="resumen" class="resumen">
                    <div class="card-header with-border">
                        <h3 class="card-title">Pagos y Extras</h3>
                    </div>
                    <div class="caja clearfix row">
                        <div class="extras col-md-6">
                            <div class="orden">
                            <label for="camisa_evento">Camisa del evento 10$ <small>(promoción 7% dto.)</small></label>
                            <input value="<?php echo (isset($boletos['camisas'] ) ? $boletos['camisas']['cantidad'] : '' ); ?>" type="number" class="form-control" min="0" id="camisa_evento" name="pedido_extras[camisas][cantidad]" size="3" placeholder="0">
                            <input type="hidden" value="10" name="pedido_extras[camisas][precio]"></input>
                            </div> <!-- .orden -->
                            <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas 2$ <small>(HTML5, CSS3, JS, etc)</small></label>
                            <input value="<?php echo (isset($boletos['etiquetas'] ) ? $boletos['etiquetas']['cantidad'] : '' ); ?>" type="number" class="form-control" min="0" id="etiquetas"  name="pedido_extras[etiquetas][cantidad]" size="3" placeholder="0">
                            <input type="hidden" value="2" name="pedido_extras[etiquetas][precio]"></input>
                            </div> <!-- .orden -->
                            <div class="orden">
                            <label for="regalo">-- Seleccione un regalo --</label>
                            <br />
                            <select class="seleccion" id="regalo" name="regalo" required>
                                <option value="">-- Seleccione un regalo --</option>
                                <option value="2" <?php echo ($registrado['regalo'] == 2) ? 'selected' : '' ?>>Etiquetas</option>
                                <option value="1" <?php echo ($registrado['regalo'] == 1) ? 'selected' : '' ?>>Pulsera</option>
                                <option value="3" <?php echo ($registrado['regalo'] == 3) ? 'selected' : '' ?>>Pluma</option>
                            </select>
                            </div> <!-- .orden -->
                    
                            <br>
                            <input type="submit" class="button btn-success" id="calcular" value="Calcular">
                    
                        </div> <!-- .extras -->
                    
                        <div class="total col-md-6">
                            <p>Resumen:</p>
                            <div id="lista-productos">

                            </div>
                            <br>
                            <p>Total ya Pagado: <?php echo '$' . (float) $registrado['total_pagado'] * $registrado['pagado']; ?> </p>
                            <p>Total:</p>
                            <div id="suma-total">
                                
                            </div>
                        </div> <!-- .total -->
                    </div> <!-- .caja -->
                </div> <!-- .resumen -->
              </div> <!-- form group -->                   

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <input type="hidden" id="total_pagar" name="total_pagar">
              <input type="hidden" id="total_descuento" name="total_descuento" value="total_descuento">
              <input type="hidden" name="registro" value="actualizar">
              <input type="hidden" name="id_registrado" value="<?php echo $registrado['id_registrado']; ?>">
              <input type="hidden" name="fecha_registro" value="<?php echo $registrado['fecha_registro']; ?>">
              <button type="submit" class="btn btn-info" id="btnRegistro">Guardar</button>
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