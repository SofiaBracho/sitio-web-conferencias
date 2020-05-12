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
        <h3>Elige tus talleres</h3>
        <div class="caja">
          <div id="viernes" class="contenido-dia clearfix">
            <h4>Viernes</h4>
              <div>
                <p>Talleres:</p>
                <label><input type="checkbox" name="registro[]" id="taller_01" value="taller_01"><time>10:00</time>Responsive Web Design</label>
                <label><input type="checkbox" name="registro[]" id="taller_02" value="taller_02"><time>12:00</time>Flexbox</label>
                <label><input type="checkbox" name="registro[]" id="taller_03" value="taller_03"><time>14:00</time>HTML5 y CSS3</label>
                <label><input type="checkbox" name="registro[]" id="taller_04" value="taller_04"><time>17:00</time>Drupal</label>
                <label><input type="checkbox" name="registro[]" id="taller_05" value="taller_05"><time>19:00</time>WordPress</label>
              </div>
              <div>
                <p>Conferencias</p>
                  <label><input type="checkbox" name="registro[]" id="conferencia_01" value="conferencia_01"><time>10:00</time>Como ser Freelancer</label>
                  <label><input type="checkbox" name="registro[]" id="conferencia_02" value="conferencia_02"><time>17:00</time>Tecnologías del Futuro</label>
                  <label><input type="checkbox" name="registro[]" id="conferencia_03" value="conferencia_03"><time>19:00</time>Seguridad en la Web</label>
              </div>
              <div>
                <p>Seminarios</p>
                <label><input type="checkbox" name="registro[]" id="seminario_01" value="seminario_01"><time>10:00</time>Diseño UI y UX para la Web</label>
              </div>
          </div> <!-- #viernes -->
    
          <div id="sabado" class="contenido-dia clearfix">
            <h4>Sábado</h4>
              <div>
                <p>Talleres</p>
                <label><input type="checkbox" name="registro[]" id="taller_06" value="taller_06"><time>10:00</time>Angular js</label>
                <label><input type="checkbox" name="registro[]" id="taller_07" value="taller_07"><time>10:00</time>PHP y MySQL</label>
                <label><input type="checkbox" name="registro[]" id="taller_08" value="taller_08"><time>10:00</time>JavaScript Avanzado</label>
                <label><input type="checkbox" name="registro[]" id="taller_09" value="taller_09"><time>10:00</time>SEO en Google</label>
                <label><input type="checkbox" name="registro[]" id="taller_10" value="taller_10"><time>10:00</time>De photoshopt a HTML5 y CSS3</label>
                <label><input type="checkbox" name="registro[]" id="taller_11" value="taller_11"><time>10:00</time>PHP Medio y Avanzado</label>
              </div>
              <div>
                <p>Conferencias</p>
                <label><input type="checkbox" name="registro[]" id="conferencia_04" value="conferencia_04"><time>10:00</time>Crear tienda Online</label>
                <label><input type="checkbox" name="registro[]" id="conferencia_05" value="conferencia_05"><time>10:00</time>Crear negocio rentable</label>
              </div>
              <div>
                <p>Seminarios</p>
                <label><input type="checkbox" name="registro[]" id="seminario_02" value="seminario_02"><time>10:00</time>Diseño UI y UX para móviles</label>
              </div>
          </div> <!-- #sábado -->
    
          <div id="domingo" class="contenido-dia clearfix">
            <h4>Domingo</h4>
              <div>
                <p>Talleres</p>
                <label><input type="checkbox" name="registro[]" id="taller_12" value="taller_12"><time>10:00</time>Angular JS</label>
                <label><input type="checkbox" name="registro[]" id="taller_13" value="taller_13"><time>10:00</time>Preprocesadores</label>
                <label><input type="checkbox" name="registro[]" id="taller_14" value="taller_14"><time>10:00</time>Vue JS</label>
              </div>
              <div>
                <p>Conferencias</p>
                <label><input type="checkbox" name="registro[]" id="conferencia_06" value="conferencia_06"><time>10:00</time>SASS</label>
                <label><input type="checkbox" name="registro[]" id="conferencia_07" value="conferencia_07"><time>10:00</time>Bootstrap</label>
              </div>
              <div>
                <p>Seminarios</p>
                <label><input type="checkbox" name="registro[]" id="seminario_03" value="seminario_03"><time>10:00</time>Como emprender en tecnología</label>
              </div>
          </div> <!-- #domingo -->
    
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