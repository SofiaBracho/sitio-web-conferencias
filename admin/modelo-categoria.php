<?php
include_once 'funciones/funciones.php';

if($_POST['registro'] == 'nuevo' ) {
    $categoria = $_POST['categoria'];
    $icono = $_POST['icono'];
    
    try {
        $stmt = $conn->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?, ?)");
        $stmt->bind_param("ss", $categoria, $icono);
        $stmt->execute();
        $categoria_id = $stmt->insert_id;

        if($stmt->affected_rows) {
            $respuesta = array(
                'id_insertado' => $categoria_id,
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
    $categoria = $_POST['categoria'];
    $icono = $_POST['icono'];
    $id = $_POST['id_registro'];

    try {
        $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ? ");
        $stmt->bind_param("ssi", $categoria, $icono, $id);
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
        
        $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ? ");
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