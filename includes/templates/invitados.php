<?php
      try {
        require_once('includes/funciones/bd_conexion.php');
        $sql = " SELECT * FROM invitados ";

        $resultado = $conn->query($sql);

      } catch (\Exception $e) {
        echo $e->getMessage();
      }
    ?>

    <section class="invitados contenedor seccion">
        <h2>Nuestros invitados</h2>
        <ul class="lista-invitados clearfix">

        <?php while($invitado = $resultado->fetch_assoc()) {    ?>

            
            <li>
                <div class="invitado">
                    <a class="invitado-info" href="#invitado<?php echo $invitado['invitado_id']; ?>">
                        <img src="img/invitados/<?php echo $invitado['url_imagen']; ?>" alt="Imagen invitado">
                        <p><?php echo $invitado['nombre_invitado'] . ' ' . $invitado['apellido_invitado']; ?></p>
                    </a>
                </div>
            </li>
            
            <div style="display: none;">
                <div class="invitado-info" id="invitado<?php echo $invitado['invitado_id']; ?>"> 
                    <h2><?php echo $invitado['nombre_invitado'] . ' ' . $invitado['apellido_invitado']; ?></h2>
                    <img src="img/invitados/<?php echo $invitado['url_imagen']; ?>" alt="Imagen invitado">
                    <p><?php echo $invitado['descripcion']; ?></p>
                </div>
            </div>
            
        <?php } ?>  
        
        </ul>
    </section> <!-- Invitados -->
    
    <?php
      $conn->close();
    ?>