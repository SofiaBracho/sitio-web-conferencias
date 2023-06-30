<?php
include_once 'funciones/funciones.php';

if($_POST['registro'] == 'nuevo' ) {
    /*$respuesta = array(
        'post' => $_POST,
        'files' => $_FILES
    );
    die(json_encode($respuesta));*/

    $nombre = $_POST['nombre_invitado'];
    $apellido = $_POST['apellido_invitado'];
    $descripcion = $_POST['descripcion'];

    $directorio = "../img/invitados/";
    
    if(!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
    
    if(move_uploaded_file($_FILES['imagen-invitado']['tmp_name'], $directorio . $_FILES['imagen-invitado']['name'])) {
        $imagen_url = $_FILES['imagen-invitado']['name'];
        $imagen_resultado = "Se subió correctamente";
    } else {
        $respuesta = array(
            "error" => error_get_last()
        );
    }

    try {
        $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $descripcion, $imagen_url);
        $stmt->execute();
        $invitado_id = $stmt->insert_id;

        if($stmt->affected_rows) {
            $respuesta = array(
                'id_insertado' => $invitado_id,
                'respuesta' => 'exito',
                'imagen_resultado' => $imagen_resultado
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
    $nombre = $_POST['nombre_invitado'];
    $apellido = $_POST['apellido_invitado'];
    $descripcion = $_POST['descripcion'];
    $id_registro = $_POST['id_registro'];

    $directorio = "../img/invitados/";

    if(!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
    
    if(move_uploaded_file($_FILES['imagen-invitado']['tmp_name'], $directorio . $_FILES['imagen-invitado']['name'])) {
        $imagen_url = $_FILES['imagen-invitado']['name'];
        $imagen_resultado = "Se subió correctamente";
    } else {
        $respuesta = array(
            "error" => error_get_last()
        );
    }

    try {
        if($_FILES['imagen-invitado']['size'] > 0) {
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ? WHERE invitado_id = ? ");
            $stmt->bind_param("ssssi", $nombre, $apellido, $descripcion, $imagen_url, $id_registro);
        } else {
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ? WHERE invitado_id = ? ");
            $stmt->bind_param("sssi", $nombre, $apellido, $descripcion, $id_registro);
        }

        $estado = $stmt->execute();

        if($estado == true) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
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
        
        $stmt = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ? ");
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