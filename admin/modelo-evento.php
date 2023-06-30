<?php
include_once 'funciones/funciones.php';

if($_POST['registro'] == 'nuevo' ) {
    $titulo = $_POST['titulo_evento'];
    $categoria_id = (int) $_POST['categoria_evento'];
    $invitado_id = (int) $_POST['invitado'];
    //Obtener la fecha formateada
    $fecha = $_POST['fecha'];
    $fecha_formateada = date('Y-m-d', strtotime($fecha) );
    //Hora
    $hora = $_POST['hora'];
    $hora_formateada = date('H:i', strtotime($hora));
    
    try {
        $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv, editado) VALUES (?, ?, ?, ?, ?, NOW()) ");
        $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora_formateada, $categoria_id, $invitado_id);
        $stmt->execute();
        $evento_id = $stmt->insert_id;

        if($stmt->affected_rows) {
            $respuesta = array(
                'id_insertado' => $evento_id,
                'respuesta' => 'exito'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar' ) {
    $titulo = $_POST['titulo_evento'];
    $categoria_id = (int) $_POST['categoria_evento'];
    $invitado_id = (int) $_POST['invitado'];
    //Obtener la fecha formateada
    $fecha = $_POST['fecha'];
    $fecha_formateada = date('Y-m-d', strtotime($fecha) );
    //Hora
    $hora = $_POST['hora'];
    $hora_formateada = date('H:i', strtotime($hora));
    $id = (int) $_POST['id_registro'];
    try {
        $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE evento_id = ? ");
        $stmt->bind_param("sssiii", $titulo, $fecha_formateada, $hora_formateada, $categoria_id, $invitado_id, $id);
        $stmt->execute();

        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar' ) {
    $id = (int) $_POST['id'];
    
    try {
        
        $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}


?>