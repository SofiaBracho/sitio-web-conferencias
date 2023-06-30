<?php include_once 'includes/templates/header.php' ?>


  <section class="seccion contenedor">

    <h2>Registro de usuarios</h2>

    <form id="registro" class="registro" action="pagar.php" method="post">
      
      <div id="datos_usuario" class="registro caja clearfix">
        <div class="campo">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre">
        </div>
        <div class="campo">
          <label for="apellido">Apellido:</label>
          <input type="text" id="apellido" name="apellido" placeholder="Tu apellido">
        </div>
        <div class="campo">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Tu email">
        </div>

        <div id="error"></div>

      </div> <!-- Datos Usuario -->

      <div class="paquetes" id="paquetes">
        <h3>Elige el numero de boletos</h3>

        <ul class="lista-precios clearfix">
          <li>
            <div class="tabla-precio">
              <h3>Pase por día (viernes)</h3>
              <p class="numero">30$</p>
              <ul>
                <li>Bocadillos gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <div class="orden">
                <label for="pase_dia">Boletos deseados: </label>
                <input type="number" min="0" id="pase_dia" name="boletos[un_dia][cantidad]" placeholder="0" size="3">
                <input type="hidden" value="30" name="boletos[un_dia][precio]"></input>
              </div>
            </div>
          </li>
          <li>
            <div class="tabla-precio">
              <h3>Todos los días</h3>
              <p class="numero">50$</p>
              <ul>
                <li>Bocadillos gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <div class="orden">
                <label for="pase_completo">Boletos deseados: </label>
                <input type="number" min="0" id="pase_completo" name="boletos[completo][cantidad]" placeholder="0" size="3">
                <input type="hidden" value="50" name="boletos[completo][precio]"></input>
              </div>            
            </div>
          </li>
          <li>
            <div class="tabla-precio">
              <h3>Pase por dos días</h3>
              <p class="numero">45$</p>
              <ul>
                <li>Bocadillos gratis</li>
                <li>Todas las conferencias</li>
                <li>Todos los talleres</li>
              </ul>
              <div class="orden">
                <label for="pase_dosdias">Boletos deseados: </label>
                <input type="number" min="0" id="pase_dosdias" name="boletos[2dias][cantidad]" placeholder="0" size="3">
                <input type="hidden" value="45" name="boletos[2dias][precio]"></input>
              </div>            
            </div>
          </li>
        </ul>
      </div> <!-- Paquetes -->

      <div id="eventos" class="eventos clearfix">
        <?php
          include_once 'includes/funciones/bd_conexion.php';
        
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

        <h3>Elige tus talleres</h3>
        <div class="caja">
          <?php foreach($eventos_dias as $dia => $eventos) { ?>
          <h4><?php echo $dia; ?></h4>
          <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
              <?php foreach($eventos['eventos'] as $categoria => $evento): ?>
              <div>
                <p><?php echo $categoria; ?></p>
                  <?php foreach($evento as $evento_dia) {?>
                <label>
                  <input type="checkbox" name="registro[]" id="<?php echo $evento_dia['id']; ?>" value="<?php echo $evento_dia['id']; ?>">
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
    
      <div id="resumen" class="resumen">
        <h3>Pago y extras</h3>
        <div class="caja clearfix">
          <div class="extras">
            <div class="orden">
              <label for="camisa_evento">Camisa del evento 10$ <small>(promoción 7% dto.)</small></label>
              <input type="number" min="0" id="camisa_evento" name="pedido_extras[camisas][cantidad]" size="3" placeholder="0">
              <input type="hidden" value="10" name="pedido_extras[camisas][precio]"></input>
            </div> <!-- .orden -->
            <div class="orden">
              <label for="etiquetas">Paquete de 10 etiquetas 2$ <small>(HTML5, CSS3, JS, etc)</small></label>
              <input type="number" min="0" id="etiquetas"  name="pedido_extras[etiquetas][cantidad]" size="3" placeholder="0">
              <input type="hidden" value="2" name="pedido_extras[etiquetas][precio]"></input>
            </div> <!-- .orden -->
            <div class="orden">
              <label for="regalo">-- Seleccione un regalo --</label>
              <br />
              <select id="regalo" name="regalo" required>
                <option value="">-- Seleccione un regalo --</option>
                <option value="2">Etiquetas</option>
                <option value="1">Pulsera</option>
                <option value="3">Pluma</option>
              </select>
            </div> <!-- .orden -->
    
            <input type="submit" class="button" id="calcular" value="Calcular">
    
          </div> <!-- .extras -->
    
          <div class="total">
            <p>Resumen:</p>
            <div id="lista-productos">
    
            </div>
            <p>Total:</p>
            <div id="suma-total">
    
            </div>
            <input type="hidden" id="total_pagar" name="total_pagar">
            <input type="submit" id="btnRegistro" name="submit" class="button" value="Pagar">
          </div> <!-- .total -->
        </div> <!-- .caja -->
      </div> <!-- .resumen -->

    </form>

  </section>

  

  <?php include_once 'includes/templates/footer.php' ?>